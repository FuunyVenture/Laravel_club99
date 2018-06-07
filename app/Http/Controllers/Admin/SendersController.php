<?php

namespace App\Http\Controllers\Admin;

use App\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Log;

use App\Http\Controllers\Controller;

class SendersController extends Controller
{
    /**
     * Display a listing of the senders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.senders.senders');
    }

    /**
     * Show the form for creating a new sender.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.senders.add_sender');
    }

    /**
     * Store a newly created sender in storage.
     *
     *  * Request must contain:
     *  * name - name of sender (required, min:3)
     *  * url - url of sender (required, regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/)
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect to 'admin/senders' with success message 'Sender [sender name]  was successfully added'
     *
     * Om Error: if sender already exists redirect to 'admin/senders' with error message 'Retailer [sender name] already exists'
     * else return error message 'Something went wrong! Please try again later.'
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => array('required', 'min:3'),
            'url' => array('regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/')
        ));

        $oldRetailer = Retailer::whereHas('user', function($query) {
            $query->where('id', '=', Auth::user()->id);
        })->where('name', '=', $request->input('name'))->first();
        if($oldRetailer) {
            $message = 'Sender ' . $oldRetailer->name . ' already exists.';

            $bag = new MessageBag();
            $bag->add('retailerExists', $message);
            return redirect('admin/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        } else if($request->has('url')) {
            $website = (strpos($request->input('url'), 'http://') === 0 || strpos($request->input('url'), 'https://') === 0) ? $request->input('url') : 'http://' . $request->input('url');

            $oldRetailer = Retailer::whereHas('user', function($query) {
                $query->where('id', '=', Auth::user()->id);
            })->where('website', '=', $website)->first();
            if($oldRetailer) {
                $message = 'Website address ' . $website . ' already exists for sender ' . $oldRetailer->name .'.';

                $bag = new MessageBag();
                $bag->add('retailerExists', $message);
                return redirect('admin/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
            }
        }

        try {
            DB::transaction(function () use ($request) {
                $retailer = new Retailer();
                $retailer->name = $request->input('name');
                if($request->has('url')) {
                    $retailer->website = (strpos($request->input('url'), 'http://') === 0 || strpos($request->input('url'), 'https://') === 0) ? $request->input('url') : 'http://' . $request->input('url');
                }
                $retailer->user()->associate(Auth::user());
                $retailer->save();
            });

            $message = 'Sender ' . $request->input('name') . ' was successfully added.';
            return redirect('admin/senders')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
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
     * Show the form for editing the specified sender.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $retailer = Retailer::findOrFail($id);
        return view('admin.senders.edit_sender')->with(compact('retailer'));
    }

    /**
     * Update the specified resource in storage.
     *
     *  * Request must contain:
     *  * name - name of sender (required, min:3)
     *  * url - url of sender (required, regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/)
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect to 'admin/senders' with success message 'Sender [sender name]  was successfully updated'
     *
     * Om Error: if sender already exists redirect to 'admin/senders' with error message 'Retailer [sender name] already exists'
     * else return error message 'Something went wrong! Please try again later.'
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => array('required', 'min:3'),
            'url' => array('regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/')
        ));

        $currentRetailer = Retailer::findOrFail($id);

        $oldRetailer = Retailer::whereHas('user', function($query) {
            $query->where('id', '=', Auth::user()->id);
        })->where('name', '=', $request->input('name'))->first();
        if($oldRetailer && $currentRetailer->id != $oldRetailer->id) {
            $message = 'Sender ' . $oldRetailer->name . ' already exists.';

            $bag = new MessageBag();
            $bag->add('retailerExists', $message);
            return redirect('admin/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        } else if($request->has('url')) {
            $website = (strpos($request->input('url'), 'http://') === 0 || strpos($request->input('url'), 'https://') === 0) ? $request->input('url') : 'http://' . $request->input('url');

            $oldRetailer = Retailer::whereHas('user', function($query) {
                $query->where('id', '=', Auth::user()->id);
            })->where('website', '=', $website)->first();
            if($oldRetailer && $currentRetailer->id != $oldRetailer->id) {
                $message = 'Website address ' . $website . ' already exists for sender ' . $oldRetailer->name .'.';

                $bag = new MessageBag();
                $bag->add('retailerExists', $message);
                return redirect('admin/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
            }
        }

        try {
            DB::transaction(function () use ($currentRetailer, $request) {
                $currentRetailer->name = $request->input('name');
                if($request->has('url')) {
                    $currentRetailer->website = (strpos($request->input('url'), 'http://') === 0 || strpos($request->input('url'), 'https://') === 0) ? $request->input('url') : 'http://' . $request->input('url');
                }
                $currentRetailer->archived = 0;
                $currentRetailer->save();
            });

            $message = 'Sender ' . $request->input('name') . ' was successfully updated.';
            return redirect('admin/senders')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Remove the specified sender from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * On Success: redirect to 'admin/senders' with success message 'Sender [sender name] was successfully deleted.'
     *
     * On Error: redirect to 'admin/senders' with error message 'Something went wrong! Please try again later.'
     */
    public function destroy($id)
    {
        $retailer = Retailer::findOrFail($id);

        try {
            DB::transaction(function () use ($retailer) {
                $retailer->archived = 1;
                $retailer->save();
            });

            $message = 'Sender ' . $retailer->name . ' was successfully deleted.';
            return redirect('admin/senders')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }
}
