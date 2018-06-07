<?php

/**
 * This file is used to manage the 'sender' resource.
 * Here are managed all the operations which are made on a sender.
 * */

namespace App\Http\Controllers\Member;

use App\Retailer;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class SendersController extends Controller
{
    /** Return the view for senders. */
    public function index()
    {
        return view('member.senders.senders');
    }

    /** Return the view for creating a new sender. */
    public function create()
    {
        return view('member.senders.add_sender');
    }

    /**
     * Store a newly created resource in storage.
     * * Request must contains:
     * * name - sender's name (required, min. 3 characters)
     * * url - sender's URL (required, regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/)
     *
     * On Success (sender already exists in storage): return message 'Sender [sender's name] already exists.'
     * On Success: return message 'Sender [sender's name] was successfully added.'
     *
     * On Error: error message 'Something went wrong! Please try again later.'
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
            return redirect('member/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        } else if($request->has('url')) {
            $website = (strpos($request->input('url'), 'http://') === 0 || strpos($request->input('url'), 'https://') === 0) ? $request->input('url') : 'http://' . $request->input('url');

            $oldRetailer = Retailer::whereHas('user', function($query) {
                $query->where('id', '=', Auth::user()->id);
            })->where('website', '=', $website)->first();
            if($oldRetailer) {
                $message = 'Website address ' . $website . ' already exists for sender ' . $oldRetailer->name .'.';

                $bag = new MessageBag();
                $bag->add('retailerExists', $message);
                return redirect('member/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
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
            return redirect('member/senders')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('member/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retailer = Retailer::findOrFail($id);
        return view('member.senders.edit_sender')->with(compact('retailer'));
    }

    /**
     * Update the specified resource in storage.
     * * Request must contains:
     * * name - sender's name (required, min. 3 characters)
     * * url - sender's URL (required, min. 3 characters, regex:/^((http|https):\/\/){0,1}([\w\d]+([-_][\w\d]+){0,})([\.][\w\d]+)+([\/][\w\d]+){0,}$/)
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     * On Success (sender already exists in storage): return message 'Sender [sender's name] already exists.'
     * On Success: return message 'Sender [sender's name] was successfully updated.'
     *
     * On Error: 'Something went wrong! Please try again later.'
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
            return redirect('member/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        } else if($request->has('url')) {
            $website = (strpos($request->input('url'), 'http://') === 0 || strpos($request->input('url'), 'https://') === 0) ? $request->input('url') : 'http://' . $request->input('url');

            $oldRetailer = Retailer::whereHas('user', function($query) {
                $query->where('id', '=', Auth::user()->id);
            })->where('website', '=', $website)->first();
            if($oldRetailer && $currentRetailer->id != $oldRetailer->id) {
                $message = 'Website address ' . $website . ' already exists for sender ' . $oldRetailer->name .'.';

                $bag = new MessageBag();
                $bag->add('retailerExists', $message);
                return redirect('member/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
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
            return redirect('member/senders')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('member/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retailer = Retailer::findOrFail($id);

        try {
            DB::transaction(function () use ($retailer) {
                $retailer->archived = 1;
                $retailer->save();
            });

            $message = 'Sender ' . $retailer->name . ' was archived deleted.';
            return redirect('member/senders')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('member/senders')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }
}
