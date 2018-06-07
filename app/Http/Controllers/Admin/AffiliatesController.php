<?php

namespace App\Http\Controllers\Admin;

use App\Retailer;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Auth;
use Log;

class AffiliatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     * Returns all unarchived affiliates.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $retailers = Retailer::where('status', '=', 'affiliate')
            ->where('archived', '=', 0)
            ->get();

        return view('admin.affiliates.affiliates')->with(compact('retailers'));
    }


    /**
     * Returns Add Affiliate view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.affiliates.add_affiliate');
    }

    /**
     * Store a newly created affiliate storage.
     *
     *  * Request must contain:
     *  * name - affiliate's name (required, min. 3 characters),
     *  * url - affiliates website url (required, regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/),
     *  * file  - affiliate's picture
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     *  On Success: return message 'Affiliate [affiliate name] was successfully added.'
     *
     *  On Error: error message 'Something went wrong! Please try again later.'
     *
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => array('required', 'min:3'),
            'url' => array('required', 'regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/'),
            'logo' => array('file')
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $bag = $validator->getMessageBag();

            $errorBag = new ViewErrorBag();
            $errorBag->put('default', $bag);

            $request->session()->flash('errors', $errorBag);
            $request->session()->flash('name', $request->input('name'));
            $request->session()->flash('url', $request->input('url'));

            return response()->json([], 422);
        }

        try {
            $response = $retailer = DB::transaction(function () use ($request) {
                $response = null;

                $retailers = Retailer::where('name', '=', $request->input('name'))
                    ->whereStatus('affiliate')
                    ->get();

                if ($retailers->isEmpty()) {
                    /*Upload retailer's logo*/
                    $destinationPath = public_path() . '/uploads/logos';
                    $retailerLogo = hash('sha256', mt_rand()) . '.' . $request->file('logo')->getClientOriginalExtension();
                    $request->file('logo')->move($destinationPath, $retailerLogo);

                    /*Add retailer*/
                    $retailer = new Retailer();
                    $retailer->name = $request->input('name');
                    $retailer->website = strpos($request->input('url'), 'http') === 0 ? $request->input('url') : 'http://' . $request->input('url');
                    $retailer->status = 'affiliate';
                    $retailer->logo = '/uploads/logos/' . $retailerLogo;
                    $retailer->user()->associate(Auth::user());
                    $retailer->save();

                    /*Archive all senders of other users*/
                    $retailers = Retailer::whereName($request->input('name'))
                        ->where('status', '<>', 'affiliate')
                        ->orWhere('website', '=', $request->input('url'))
                        ->where('status', '<>', 'affiliate')
                        ->get();
                    foreach ($retailers as $retailer) {
                        $retailer->archived = 1;
                        $retailer->save();
                    }
                } else {
                    $response = [
                        'type' => 'exists',
                        'name' => $retailers->first()->name
                    ];
                }

                return $response;
            });

            if ($response) {
                $bag = new MessageBag();
                $bag->add('retailerExists', 'Affiliate ' . $response['name'] . ' already exists.');

                $errorBag = new ViewErrorBag();
                $errorBag->put('default', $bag);

                $request->session()->flash('errors', $errorBag);
                return response()->json([], 400);
            }

            $message = 'Affiliate ' . $request->input('name') . ' was successfully added.';
            $request->session()->flash('success', $message);
            return response()->json([], 200);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');

            $errorBag = new ViewErrorBag();
            $errorBag->put('default', $bag);

            $request->session()->flash('errors', $errorBag);

            return response()->json([], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified affiliate.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retailer = Retailer::findOrFail($id);
        return view('admin.affiliates.edit_affiliate')->with(compact('retailer'));
    }

    /**
     * Update the specified affiliate in storage.
     *
     *  * Request must contain:
     *  * name - affiliate's name (required, min. 3 characters),
     *  * url - affiliates website url (required, regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/),
     *  * file  - affiliate's picture (optional)
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     *  On Success: return message 'Affiliate [affiliate name] was successfully updated.'
     *
     *  On Error: error message 'Something went wrong! Please try again later.'
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => array('required', 'min:3'),
            'url' => array('required', 'regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/'),
            'logo' => array('file')
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $bag = $validator->getMessageBag();

            $errorBag = new ViewErrorBag();
            $errorBag->put('default', $bag);

            $request->session()->flash('errors', $errorBag);
            $request->session()->flash('name', $request->input('name'));
            $request->session()->flash('url', $request->input('url'));

            return response()->json([], 422);
        }

        try {
            $retailer = Retailer::findOrFail($id);

            DB::transaction(function () use ($retailer, $request) {
                $retailer->name = $request->input('name');
                $retailer->website = strpos($request->input('url'), 'http') === 0 ? $request->input('url') : 'http://' . $request->input('url');
                $retailer->status = 'affiliate';

                if ($request->input('changeLogo') == 'on') {
                    /*Upload retailer's logo*/
                    $destinationPath = public_path() . '/uploads/logos';
                    $retailerLogo = hash('sha256', mt_rand()) . '.' . $request->file('logo')->getClientOriginalExtension();
                    $request->file('logo')->move($destinationPath, $retailerLogo);

                    $retailer->logo = '/uploads/logos/' . $retailerLogo;
                }

                $retailer->save();
            });

            $message = 'Affiliate ' . $retailer->name . ' was successfully updated.';
            $request->session()->flash('success', $message);
            return response()->json([], 200);
        } catch (\Exception $e) {
            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');

            $errorBag = new ViewErrorBag();
            $errorBag->put('default', $bag);

            $request->session()->flash('errors', $errorBag);

            return response()->json([], 400);
        }
    }

    /**
     * Remove the specified affiliate from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     *  On Success: redirect 'admin/affiliates' with success message 'Retailer [retailer name] was successfully delete.'
     *
     *  On Error: redirect to 'admin/invoices' with error 'Something went wrong! Please try again later.'
     */
    public function destroy($id)
    {
        $retailer = Retailer::findOrFail($id);

        try {
            DB::transaction(function () use ($retailer) {
                $retailer->archived = 1;
                $retailer->save();
            });

            return redirect('admin/affiliates')->with(
                'success',
                'Retailer ' . $retailer->name . ' was successfully delete.'
            );
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/invoices')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

}
