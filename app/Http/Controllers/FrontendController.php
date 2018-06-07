<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use App\Package;
use App\Feature;
use Illuminate\Support\Facades\Mail;
use Log;

class FrontendController extends Controller
{
    /**
     * Return first page view
     * */
    public function index()
    {
        $packages = Package::active()->get();

        $features = Feature::active()->get();

        return view('frontend.welcome')->with(compact('packages', 'features'));
    }

    /**
     *
     * */
    public function pricing()
    {
        $packages = Package::active()->get();

        $features = Feature::active()->get();

        return view('frontend.pricing')->with(compact('packages', 'features'));
    }

    public function components()
    {
        return view('frontend.components');
    }
    public function howItWorks()
    {
        $packages = Package::active()->get()->sortBy('cost');

        /*$features = Feature::active()->first();*/

        return view('frontend.how_it_works')->with(compact('packages'));

    }
    public function packages()
    {
        $packages = Package::active()->get();

        $features = Feature::active()->get();

        return view('frontend.packages')->with(compact('packages', 'features'));
    }
    public function faq()
    {
        return view('frontend.faq');
    }
    public function contactUs(){
        return view('frontend.contact_us');
    }
    public function contactUsSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:10'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $form_message = $request->input('message');

        $emails = User::where('role_id', '=', 1)->lists('email')->toArray();
        Log::info($emails);

        Mail::send('emails.contact', [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'form_message' => $form_message
        ], function ($message) use ($emails) {
            $message->subject("Club 99 Support");
            $message->to($emails);
        });

        return redirect('/')->with(['success' => 'Thanks for contacting us!']);
    }


    public function privacyPolicy(){
        return view('frontend.privacy_policy');
    }

    public function termsOfUse(){
        return view('frontend.terms_of_use');
    }

    public function blog()
    {
        $posts_per_page = getSetting('POSTS_PER_PAGE');

        $posts = Page::published()->post()->paginate($posts_per_page);

        return view('frontend.blog')->with(compact('posts'));
    }

    public function post($slug = '')
    {
        $post = Page::whereSlug($slug)->published()->post()->get()->first();
        if ($post) {
            return view('frontend.post')->with(compact('post'));
        }

        abort(404);
    }

    public function staticPages($slug = '')
    {
        $page = Page::whereSlug($slug)->published()->page()->get()->first();

        if ($page) {
            return view('frontend.page')->with(compact('page'));
        }

        abort(404);
    }

    public function login_register()
    {
        return view('auth.login_register');
    }
}
