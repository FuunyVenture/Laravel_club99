<?php

namespace App\Http\Controllers\Admin;

use App\Tax;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Validator;
use Log;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the classification.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.classification.classification');
    }

    /**
     * Show the form for creating a new classification.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.classification.add_classification');
    }

    /**
     * Store a newly created classification in storage.
     *
     *  * Request must contain:
     *  * description - name of classification (required, min 3 characters)
     *  * duty - duty value of classification (required, regex:/^\d+(?:\.\d{1,2})?$/)
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     *  On Success: return message 'Classification [classification name] was successfully added.'
     *
     *  On Error: if unexpected error return message 'Something went wrong! Please try again later.'
     *  else if classification tax already exists, return message 'Tax [classification name] already exists'
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|min:3',
            'duty' => 'required|numeric|min:0|max:100'
        ]);

        $tax = null;
        $archived = 0;

        $taxes = Tax::where('description', '=', $request->input('description'))->get();
        if (!$taxes->isEmpty()) {
            $tax = $taxes->first();

            if ($tax->archived == 0) {
                $bag = new MessageBag();
                $bag->add('duplicate', 'Tax ' . $request->input('description') . ' already exists!');
                return redirect('admin/classification')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
            } else
                $archived = 1;
        }

        try {
            DB::transaction(function () use ($request, $tax, $archived) {
                if (!$tax)
                    $tax = new Tax();

                $tax->description = $request->input('description');
                $tax->cost = 1;
                $tax->duty = $request->input('duty');
                if($archived) $tax->archived = 0;
                $tax->save();
            });

            $message = 'Classification ' . $request->input('description') . ' was successfully added.';
            return redirect('admin/classification')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/classification')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
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
     * Show the form for editing the specified classification.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        return view('admin.classification.edit_classification')->with(compact('tax'));
    }

    /**
     * Update the specified classification in storage.
     *
     *  * Request must contain:
     *  * description - name of classification (required, min 3 characters)
     *  * duty - duty value of classification (required, regex:/^\d+(?:\.\d{1,2})?$/)
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     *  On Success: return message 'Classification [classification name] was successfully updated.'
     *
     *  On Error: if unexpected error return message 'Something went wrong! Please try again later.'
     *  else if classification tax already exists, return message 'Tax [classification name] already exists'
     */
    public function update(Request $request, $id)
    {
        Log::info($request->all());

        $this->validate($request, [
            'description' => 'required|min:3',
            'duty' => 'required|numeric|min:0|max:100'
        ]);

        $tax = Tax::findOrFail($id);

        if ($tax->name != $request->input('description')) {
            $taxes = Tax::where('description', '=', $request->input('description'))->get();
            if (!$taxes->isEmpty()) {
                if ($tax->id != $taxes->first()->id) {
                    $bag = new MessageBag();
                    $bag->add('duplicate', 'Tax ' . $request->input('description') . ' already exists!');
                    return redirect('admin/classification')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
                }
            }
        }

        try {
            DB::transaction(function () use ($tax, $request) {
                $tax->description = $request->input('description');
                $tax->duty = $request->input('duty');
                $tax->enabled = $request->input('enabled') == 'yes' ? 1 : 0;
                $tax->save();
            });

            $message = 'Classification ' . $request->input('description') . ' was successfully updated.';
            return redirect('admin/classification')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/classification')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }

    /**
     * Remove the specified classification from storage.
     *
     * @param  int $id - id of classification
     * @return \Illuminate\Http\Response
     *
     *  On Success: redirect to 'admin/classification' with success message 'Classification [classification name] was successfully deleted.'
     *
     *  On Error: redirect to 'admin/classification' with error message 'Something went wrong! Please try again later.'
     *
     */
    public function destroy($id)
    {
        $tax = Tax::findOrFail($id);

        try {
            DB::transaction(function () use ($tax) {
                $tax->archived = 1;
                $tax->save();
            });

            $message = 'Classification ' . $tax->description . ' was successfully deleted.';
            return redirect('admin/classification')->with('success', $message);
        } catch (\Exception $e) {
            Log::info($e);

            $bag = new MessageBag();
            $bag->add('sqlTransaction', 'Something went wrong! Please try again later.');
            return redirect('admin/classification')->with('errors', session()->get('errors', new ViewErrorBag())->put('default', $bag));
        }
    }
}
