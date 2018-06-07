<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Page;

class PagesController extends Controller
{
    /**
     * PagesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create_edit');
    }

    /**
     * @param PageRequest $request
     * @return mixed
     */
    public function store(PageRequest $request)
    {
        $page = new Page($request->except('_token', 'page_id','published'));
		
		$page->published = 0;
		
		if($request->input('published'))
		{
			$page->published = 1;
		}
        
		if ($page->published) {
            $page->published_at = \Carbon::now();;
        }

        $page->save();

        return redirect('admin/pages')->with('success', $page->title . ' has been added Successfully');
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function show(Page $page)
    {
        if ($page) {
            return view('frontend.page')->with(compact('page'));
        }
        abort(404);
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function edit(Page $page)
    {
        return view('admin.pages.create_edit', compact('page'));
    }//edit

    /**
     * @param PageRequest $request
     * @param Page $page
     * @return mixed
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->title = $request->input('title');

        $page->content = $request->input('content');

        $page->icon = $request->input('icon');

        if ($page->published == 0 && $request->input('published')) {
            $page->published_at = \Carbon::now();;
        }

        $page->published = $request->input('published');

        $page->blog_post = $request->input('blog_post');

        $page->slug = $request->input('slug');

        $page->meta_keywords = $request->input('meta_keywords');

        $page->meta_desc = $request->input('meta_desc');

        $page->updated_at = \Carbon::now();

        $page->save();

        return redirect('admin/pages')->with('success', $page->title . ' has been Updated Successfully');
    }//update

    /**
     * @param Request $request
     * @param Page $page
     * @return string
     */
    public function destroy(Request $request, Page $page)
    {
        if ($request->ajax()) {
            $page->delete();

            return response()->json(['success' => 'Page has been deleted successfully']);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }

}
