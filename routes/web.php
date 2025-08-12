<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\SystemInformationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientSayController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\NewsAndMediaController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ExtraPageController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Front\TextController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\CustomerPersonalController;
use App\Http\Controllers\Admin\DefaultLocationController;
use App\Http\Controllers\Admin\SearchLogController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HolidayCalenderController;

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\AnimationCategoryController;

use App\Http\Controllers\Admin\SubSubcategoryController;
use App\Http\Controllers\Admin\FabricController;

use App\Http\Controllers\Admin\SizeChartController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BarcodeController;
use App\Http\Controllers\Admin\FrontendControlController;
use App\Http\Controllers\Admin\BundleOfferController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return redirect()->back();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/payment/success', [FrontController::class, 'paymentSuccess'])->name('payment.success');
Route::post('/payment/fail', [FrontController::class, 'paymentFail'])->name('payment.fail');
Route::post('/payment/cancel', [FrontController::class, 'paymentCancel'])->name('payment.cancel');

Route::resource('customerPersonalTicket', CustomerPersonalController::class);

Route::controller(CustomerPersonalController::class)->group(function () {
    Route::get('/customerGeneralTicketPdf/{id}', 'customerGeneralTicketPdf')->name('customerGeneralTicketPdf');
Route::get('/customerPersonalTicketPdf/{id}', 'customerPersonalTicketPdf')->name('customerPersonalTicketPdf');
    Route::get('/customerPersonalTicket', 'customerPersonalTicket')->name('customerPersonalTicket');
});
Route::controller(LoginController::class)->group(function () {

    Route::get('/', 'viewLoginPage')->name('viewLoginPage');
    Route::get('/password/reset', 'showLinkRequestForm')->name('showLinkRequestForm');
    Route::post('/password/reset/submit', 'reset')->name('reset');

});

Route::controller(TextController::class)->group(function () {
    Route::post('/textMessageAll', 'textMessage')->name('text.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login-register', 'loginregisterPage')->name('front.loginRegister');

    Route::post('/login-user-post', 'loginUserPost')->name('front.loginUserPost');
    Route::post('/register-user-post', 'registerUserPost')->name('front.registerUserPost');

      // --- NEW PASSWORD RESET ROUTES ---
    Route::get('forgot-password', 'showForgotPasswordForm')->name('front.password.request');
    Route::post('forgot-password', 'sendResetLink')->name('front.password.email');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('front.password.reset');
    Route::post('reset-password', 'resetPassword')->name('front.password.update'); // Note: This reuses the standard 'password.update' name
});


    



Route::group(['middleware' => ['auth']], function() {

      Route::get('ajax-bundle-offers', [BundleOfferController::class, 'data'])->name('ajax.bundle-offer.data');
    Route::get('bundle-offer-search-products', [BundleOfferController::class, 'searchProducts'])->name('bundle-offer.search-products');
    Route::resource('bundle-offer', BundleOfferController::class);

    Route::get('frontend-control', [FrontendControlController::class, 'index'])->name('frontend.control.index');
    Route::post('frontend-control', [FrontendControlController::class, 'update'])->name('frontend.control.update');


     Route::get('barcode', [BarcodeController::class, 'index'])->name('barcode.index');
    Route::get('barcode/search', [BarcodeController::class, 'search'])->name('barcode.search');
    Route::post('barcode/print', [BarcodeController::class, 'print'])->name('barcode.print');

    
Route::get('ajax_brands', [BrandController::class, 'data'])->name('ajax.brand.data');
Route::resource('brand', BrandController::class);

Route::get('ajax_category', [CategoryController::class, 'data'])->name('ajax.category.data');
Route::resource('category', CategoryController::class);

Route::get('ajax_subcategory', [SubCategoryController::class, 'data'])->name('ajax.subcategory.data');
Route::resource('subcategory', SubCategoryController::class);


Route::get('ajax_unit', [UnitController::class, 'data'])->name('ajax.unit.data');
Route::resource('unit', UnitController::class);

// Sub-Subcategory Routes
    Route::get('get-subcategories/{categoryId}', [SubSubcategoryController::class, 'getSubcategories'])->name('get.subcategories');
    Route::get('ajax_ub-subcategories', [SubSubcategoryController::class, 'data'])->name('ajax.sub-subcategory.data');
    Route::resource('sub-subcategory', SubSubcategoryController::class);


     // Fabric Routes
    Route::get('ajax_fabrics', [FabricController::class, 'data'])->name('ajax.fabric.data');
    Route::resource('fabric', FabricController::class);


    // Color Routes
    Route::get('ajax_colors', [ColorController::class, 'data'])->name('ajax.color.data');
    Route::resource('color', ColorController::class);

    // Unit Routes
    Route::get('ajax_units', [UnitController::class, 'data'])->name('ajax.unit.data');
    Route::resource('unit', UnitController::class);

    // Size Routes
    Route::get('ajax_sizes', [SizeController::class, 'data'])->name('ajax.size.data');
    Route::resource('size', SizeController::class);


    // Size Chart Routes
    Route::get('ajax_size-charts', [SizeChartController::class, 'data'])->name('ajax.size-chart.data');
    Route::resource('size-chart', SizeChartController::class)->parameters([
        'size-chart' => 'id'
    ]);


// Product Routes
    Route::get('ajax_products', [ProductController::class, 'data'])->name('ajax.product.data');
        Route::get('get_subcategories/{categoryId}', [ProductController::class, 'getSubcategories'])->name('get_subcategories');
    Route::get('get-sub-subcategories/{subcategoryId}', [ProductController::class, 'getSubSubcategories'])->name('get.sub-subcategories');
    Route::get('get-size-chart-entries/{id}', [ProductController::class, 'getSizeChartEntries'])->name('get.size-chart.entries');
    Route::resource('product', ProductController::class);

Route::get('ajax_animation_category', [AnimationCategoryController::class, 'data'])->name('ajax.animation_category.data');
Route::resource('animationCategory', AnimationCategoryController::class);
Route::resource('coupon', CouponController::class);

Route::post('/coupons/apply', [CouponController::class, 'applyCoupon'])->name('coupons.apply');

    Route::controller(AuthController::class)->group(function () {

        Route::get('/user-dashboard', 'userDashboard')->name('front.userDashboard');
        Route::post('/profile/update', 'updateProfile')->name('profile.update');
        Route::post('/password/update', 'updatePassword')->name('password.update');
});
    //website part




Route::resource('defaultLocation', DefaultLocationController::class);
    Route::resource('searchLog', SearchLogController::class);

     Route::controller(SearchLogController::class)->group(function () {

    Route::get('/ajax-table-searchLog/data','data')->name('ajax.searchLogtable.data');


    });

    Route::resource('aboutUs', AboutUsController::class);
    Route::resource('contact', ContactController::class);

    Route::resource('banner', BannerController::class);
    Route::resource('clientSay', ClientSayController::class);
    Route::resource('review', ReviewController::class);
    Route::resource('newsAndMedia', NewsAndMediaController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('socialLink', SocialLinkController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('extraPage', ExtraPageController::class);
    Route::resource('message', MessageController::class);

    //setting part start
    Route::resource('setting', SettingController::class);
    Route::resource('branch', BranchController::class);
    Route::resource('designation', DesignationController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('systemInformation', SystemInformationController::class);


    Route::resource('customer', CustomerController::class);

    Route::resource('service', ServiceController::class);
    Route::resource('offer', OfferController::class);


    Route::controller(ServiceController::class)->group(function () {
    
        Route::get('/service/export','exportServices')->name('service.export');
    });

   

    


    Route::controller(CustomerController::class)->group(function () {
Route::get('/customers/export','exportCustomers')->name('customer.export');
        Route::get('/customers/check-email','checkEmailUniqueness')->name('customers.checkEmail');

    Route::get('/downloadcustomerPdf','downloadcustomerPdf')->name('downloadcustomerPdf');
    Route::get('/downloadcustomerExcel','downloadcustomerExcel')->name('downloadcustomerExcel');
    Route::get('/ajax-table-customer/data','data')->name('ajax.customertable.data');


    });





    Route::controller(UserController::class)->group(function () {

    Route::get('/downloadUserPdf','downloadUserPdf')->name('downloadUserPdf');
    Route::get('/downloadUserExcel','downloadUserExcel')->name('downloadUserExcel');
    Route::get('/ajax-table-user/data','data')->name('ajax.usertable.data');


    });

    // holiday route added
    Route::resource('holidayCalender', HolidayCalenderController::class)->parameters([
    'holidayCalender' => 'aircraft_model_id' // This tells Laravel to use 'aircraft_model_id' instead of 'holidayCalender'
]);

    Route::controller(HolidayCalenderController::class)->group(function () {

        Route::get('/ajax-table-holidayCalender/data','data')->name('ajax.holidayCalendertable.data');
 });

Route::get('holidayCalender_data', [HolidayCalenderController::class, 'data'])->name('holidayCalender.data');
Route::delete('holidayCalender/single/{holidayCalender_id}', [HolidayCalenderController::class, 'deleteSingleHoliday'])->name('holidayCalender.deleteSingle');
    ///holiday route addd ended




    Route::controller(SystemInformationController::class)->group(function () {

    Route::get('/downloadSystemInformationPdf','downloadSystemInformationPdf')->name('downloadSystemInformationPdf');
    Route::get('/downloadSystemInformationExcel','downloadSystemInformationExcel')->name('downloadSystemInformationExcel');
    Route::get('/ajax-table-systemInformation/data','data')->name('ajax.systemInformationtable.data');


    });



    Route::controller(RoleController::class)->group(function () {

    Route::get('/downloadRolePdf','downloadRolePdf')->name('downloadRolePdf');
    Route::get('/downloadRoleExcel','downloadRoleExcel')->name('downloadRoleExcel');
    Route::get('/ajax-table-role/data','data')->name('ajax.roletable.data');


    });


     Route::controller(PermissionController::class)->group(function () {

    Route::get('/downloadPermissionPdf','downloadPermissionPdf')->name('downloadPermissionPdf');
    Route::get('/downloadPermissionExcel','downloadPermissionExcel')->name('downloadPermissionExcel');
    Route::get('/ajax-table-permission/data','data')->name('ajax.permissiontable.data');


    });


    Route::controller(BranchController::class)->group(function () {

    Route::get('/downloadBranchPdf','downloadBranchPdf')->name('downloadBranchPdf');
    Route::get('/downloadBranchExcel','downloadBranchExcel')->name('downloadBranchExcel');
    Route::get('/ajax-table-branch/data','data')->name('ajax.branchtable.data');


    });

    Route::controller(DesignationController::class)->group(function () {

    Route::get('/downloadDesignationPdf','downloadDesignationPdf')->name('downloadDesignationPdf');
    Route::get('/downloadDesignationExcel','downloadDesignationExcel')->name('downloadDesignationExcel');
    Route::get('/ajax-table-designation/data','data')->name('ajax.designationtable.data');
    

    });

    Route::controller(UserController::class)->group(function () {


        Route::get('/activeOrInActiveUser/{status}/{id}', 'activeOrInActiveUser')->name('activeOrInActiveUser');

    });


    Route::controller(SettingController::class)->group(function () {

        Route::get('/error_500', 'error_500')->name('error_500');
        Route::get('/profileView', 'profileView')->name('profileView');
        Route::get('/profileSetting', 'profileSetting')->name('profileSetting');

        Route::post('/profileSettingUpdate', 'profileSettingUpdate')->name('profileSettingUpdate');
        Route::post('/passwordUpdate', 'passwordUpdate')->name('passwordUpdate');

        Route::post('/checkMailPost', 'checkMailPost')->name('checkMailPost');
        Route::get('/checkMailForPassword', 'checkMailForPassword')->name('checkMailForPassword');

        Route::get('/newEmailNotify', 'newEmailNotify')->name('newEmailNotify');
        Route::post('/postPasswordChange', 'postPasswordChange')->name('postPasswordChange');
        Route::get('/accountPasswordChange/{id}', 'accountPasswordChange')->name('accountPasswordChange');




    });
    //setting part end
});