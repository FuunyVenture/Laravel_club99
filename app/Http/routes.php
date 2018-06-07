<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

use App\User;
use App\Setting;
use App\Role;
use App\Feature;
use App\Package;
use App\Page;
use App\Menu;

Route::model('users', User::class);
Route::model('settings', Setting::class);
Route::model('roles', Role::class);
Route::model('packages', Package::class);
Route::model('features', Feature::class);
Route::model('pages', Page::class);
Route::model('menus', Menu::class);

Route::group(['middleware' => ['web']], function () {

    Route::get('/page/{slug}', 'FrontendController@staticPages');

    Route::get('/', 'FrontendController@index');

    Route::get('/pricing', 'FrontendController@pricing');

    Route::get('/components', 'FrontendController@components');

    Route::get('/contact-us', 'FrontendController@contactUs');

    Route::post('/contact-us', 'FrontendController@contactUsSubmit');

    Route::get('/privacy-policy', 'FrontendController@privacyPolicy');

    Route::get('/terms-of-use', 'FrontendController@termsOfUse');

    Route::get('/blog', 'FrontendController@blog');

    Route::get('/blog/{slug}', 'FrontendController@post');

    Route::get('/guest', 'FrontendController@login_register')->middleware('guest');

    Route::get('/how-it-works', 'FrontendController@howItWorks');

    Route::get('/packages', 'FrontendController@packages');

    Route::get('/faq', 'FrontendController@faq');

    /* Route::post('stripe/webhook', '\Laravel\Cashier\WebhookController@handleWebhook');*/

});

Route::group(['middleware' => 'web'], function () {
    /**
     * Authentication routes
     */
    Route::auth();
    /**
     * Admin routes
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        Route::controllers([
            'subscription' => 'SubscriptionController',
            'datatables' => 'Admin\DatatablesController',
        ]);

        Route::get('/dashboard', 'Admin\DashboardController@index');

        Route::get('team/{user}/activate', 'Admin\AdminsController@activate');
        Route::get('team/{user}/deactivate', 'Admin\AdminsController@deactivate');
        Route::resource('team', 'Admin\AdminsController');

        Route::get('users/{id}/activate', 'Admin\UsersController@activate');
        Route::resource('users', 'Admin\UsersController');

        Route::get('settings/create/{type}', ['as' => 'admin.settings.create.type', 'uses' => 'Admin\SettingsController@createForm']);
        Route::get('settings/download/{settings}', ['as' => 'admin.settings.download', 'uses' => 'Admin\SettingsController@fileDownload']);
        Route::resource('settings', 'Admin\SettingsController');

        Route::resource('roles', 'Admin\RolesController');

        Route::resource('features', 'Admin\FeaturesController');

        Route::resource('packages', 'Admin\PackagesController');

        Route::resource('pages', 'Admin\PagesController');

        Route::resource('menus', 'Admin\MenusController');

        Route::get('shipments/{id}/cancel', 'Admin\ShipmentsController@cancel');
        Route::get('shipments/{id}/approve', 'Admin\ShipmentsController@approve');
        Route::get('shipments/{id}/collect', 'Admin\ShipmentsController@collect');
        Route::get('shipments/getByUser', 'Admin\ShipmentsController@getByUser');
        Route::resource('shipments', 'Admin\ShipmentsController');

        Route::get('invoices/create', 'Admin\InvoicesController@create');
        Route::get('invoices/create/user/{userId}/shipment/{shipmentId}', 'Admin\InvoicesController@createSpecific');
        Route::get('invoices/{id}/mark-as-payed', 'Admin\InvoicesController@markAsPaid');
        Route::get('invoices/{id}/mark-as-unpayed', 'Admin\InvoicesController@markAsUnpaid');
        Route::get('invoices/{id}/invalidate-invoice-payment', 'Admin\InvoicesController@invalidateInvoicePayment');
        Route::get('invoices/{id}/send-invoice', 'Admin\InvoicesController@sendInvoice');
        Route::get('/invoices/{id}/pay', 'Admin\InvoicesController@showPayInvoice');
        Route::post('/invoices/pay', 'Admin\InvoicesController@payInvoice');
        Route::post('invoices/{id}/update', 'Admin\InvoicesController@update');
        Route::resource('invoices', 'Admin\InvoicesController');

        Route::get('products/{id}/delete', 'Admin\ProductsController@destroy');
        Route::resource('products', 'Admin\ProductsController');

        Route::resource('fees', 'Admin\FeesController');

        Route::get('coupons/{id}/edit', 'Admin\CouponsController@edit');
        Route::get('coupons/{id}/delete', 'Admin\CouponsController@destroy');
        Route::resource('coupons', 'Admin\CouponsController');

        Route::get('affiliates/{id}/delete', 'Admin\AffiliatesController@destroy');
        Route::post('affiliates/{id}/update', 'Admin\AffiliatesController@update');
        Route::resource('affiliates', 'Admin\AffiliatesController');

        Route::get('senders/{id}/delete', 'Admin\SendersController@destroy');
        Route::resource('senders', 'Admin\SendersController');

        Route::get('classification/{id}/delete', 'Admin\ClassificationController@destroy');
        Route::resource('classification', 'Admin\ClassificationController');

        Route::resource('notifications', 'Admin\NotificationsController');

        Route::post('/upload-shipment-invoice', 'Admin\ShipmentsController@uploadShipmentInvoice');
    });

    /**
     * Member routes
     */
    Route::group(['prefix' => 'member'], function () {
        Route::get('/subscription', ['as' => 'member.subscription', 'uses' => 'MemberController@index'])->middleware('notSubscribed');
        Route::controllers([
            'subscription' => 'SubscriptionController',
            'datatables' => 'Member\DatatablesController'
        ]);

        Route::get('/pending-subscription', 'MemberController@pendingSubscription')->middleware('activeUser');


        Route::group(['middleware' => ['subscribed', 'profile']], function () {
            Route::get('/dashboard', ['as' => 'member.dashboard', 'uses' => 'Member\DashboardController@dashboard']);
            Route::get('/profile', ['as' => 'member.profile', 'uses' => 'Member\ProfileController@profile']);
            Route::get('/profile/edit', ['as' => 'member.profile.edit', 'uses' => 'Member\ProfileController@editProfile']);
            Route::put('/profile/edit', ['as' => 'member.profile.update', 'uses' => 'Member\ProfileController@updateProfile']);
            Route::post('/profile/update-avatar', ['as' => 'member.profile.update', 'uses' => 'Member\ProfileController@updateAvatar']);
            Route::get('/shop', ['as' => 'member.shop', 'uses' => 'Member\ShopController@shop']);
            Route::get('/invoices', ['as' => 'member.invoices', 'uses' => 'Member\InvoicesController@invoices']);
            Route::get('/invoices/detail', ['as' => 'member.invoices.detail', 'uses' => 'Member\InvoicesController@invoiceDetail']);
            Route::get('/help', ['as' => 'member.help', 'uses' => 'MemberController@help']);
            Route::get('/pricing', ['as' => 'member.pricing', 'uses' => 'MemberController@pricing']);

            Route::get('shipments/{id}/cancel', 'Member\ShipmentsController@cancel');
            Route::get('/shipments', ['as' => 'member.shipments', 'uses' => 'Member\ShipmentsController@shipments']);
            Route::get('/shipments/detail', ['as' => 'member.shipments.detail', 'uses' => 'Member\ShipmentsController@shipmentDetail']);
            Route::resource('shipments', 'Member\ShipmentsController');

            Route::get('senders/{id}/delete', 'Member\SendersController@destroy');
            Route::resource('senders', 'Member\SendersController');

            Route::get('/invoices/{id}/pay', 'Member\InvoicesController@showPayInvoice');
            Route::post('/invoices/pay', 'Member\InvoicesController@payInvoice');
            Route::resource('invoices', 'Member\InvoicesController');
            Route::resource('notifications', 'Member\NotificationsController');

            Route::post('/upload-shipment-invoice', 'Member\ShipmentsController@uploadShipmentInvoice');
        });
    });

    Route::get('sitemap', function () {

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 1440);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {


            $posts = DB::table('pages')->orderBy('created_at', 'desc')->get();

            // add every post to the sitemap
            foreach ($posts as $post) {
                if ($post->blog_post) {
                    $slug = "blog/" . $post->slug;
                } else {
                    $slug = "page/" . $post->slug;
                }
                $sitemap->add(URL::to($slug), $post->updated_at, '0.9', 'daily');
            }
        }

        return $sitemap->render('xml');

    }
    );
});