<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ImagesGalleryController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LineGraphController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\Ounass;
use App\Models\Styli;
use App\Models\ArabyAds;
use App\Models\Shosh;
use App\Models\MarketerHub;
use App\Models\OunassValidation;
use App\Models\StyliValidation;
use App\Models\ArabyAdsValidation;
use App\Models\ShoshValidation;
use App\Models\MarketerHubValidation;
use Sarfraznawaz2005\BackupManager\Http\Controllers\BackupManagerController;
use App\Http\Controllers\InfluencerGraphController;
use App\Http\Controllers\CommissionCalulation;

use App\Http\Requests\Auth\LoginRequest;


require __DIR__.'/auth.php';
Auth::routes();
// Auth::routes();
Route::get('/check',function(){
	
    $dirPath = public_path('storage');
	if (is_dir($dirPath)) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
    }
    \Artisan::call('storage:link');
   \Artisan::call('optimize:clear');
   
   

   
   return "linked";
});
// My routes
Route::get('getdel',function(){
    set_time_limit(600000000000000);
    $b = Brand::all();
    foreach($b as $a){
        $a->delete();
    }
    $c = Coupon::all();
    foreach($c as $a){
        $a->delete();
    }
    $c1 = ArabyAds::all();
    foreach($c1 as $d){
        $d->delete();
    }
    $c2 = Ounass::all();
    foreach($c2 as $d){
        $d->delete();
    }
    $c3 = Styli::all();
    foreach($c3 as $d){
        $d->delete();
    }
    $c4 = MarketerHub::all();
    foreach($c4 as $d){
        $d->delete();
    }
    $c5 = MarketerHubValidation::all();
    foreach($c5 as $d){
        $d->delete();
    }
    $c6 = OunassValidation::all();
    foreach($c6 as $d){
        $d->delete();
    }
    $c7 = StyliValidation::all();
    foreach($c7 as $d){
        $d->delete();
    }
    $c8 = ArabyAdsValidation::all();
    foreach($c8 as $d){
        $d->delete();
    }
    $c9 = Shosh::all();
    foreach($c9 as $d){
        $d->delete();
    }
    $c10 = ShoshValidation::all();
    foreach($c10 as $d){
        $d->delete();
    }
    $c11 = ArabyAds::all();
    foreach($c11 as $d){
        $d->delete();
    }
    $c12 = Styli::all();
    foreach($c12 as $d){
        $d->delete();
    }
    dd('success');
});
Route::get('notfound',function(){
    return view('404');
})->name('notfound');



Route::get('influencer/login',function(){
    // dd("hello");
    return view('auth.influencer_login');
});
Route::post('influencerLogin',[LoginController::class,'processLogin'])->name('influencer_login');





Route::get('influencer_payment_detail',[InfluencerController::class,'influencerDetails'])->name('influencer_payment_detail');

Route::middleware(['auth'])->group(function () {

    Route::get('commissionCal', [CommissionCalulation::class, 'commissionCalulation'])->name('commissionCal');
    Route::post('searchcommissionCal', [CommissionCalulation::class, 'searchCommissionCalulation'])->name('searchcommissionCal');

    Route::post('get_data_by_pages',[BrandsController::class,'getDataByPages'])->name('get_data_by_pages');

    Route::get('logout',[AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::prefix('brands')->group(function () {
        Route::resource('brands', BrandsController::class);
        Route::get('csv_brands', [BrandsController::class, 'csvForm'])->name('csv_brands');
        Route::post('brand_csv_upload', [BrandsController::class, 'csvUpload'])->name('brand_csv');
        Route::get('brand_csv_export', [BrandsController::class, 'export'])->name('brand.export');
        Route::get('myproductsDeleteAll', [BrandsController::class, 'bulk_delete'])->name('brand.bulk.delete');
        Route::post('search_brands', [BrandsController::class, 'searchBrands'])->name('search_brands');


    // });

    // Route::prefix('influencer')->group(function () {
Route::resource('influencer', InfluencerController::class);
Route::get('csv',[InfluencerController::class, 'csvForm'])->name('csv_form');
Route::post('csv_upload',[InfluencerController::class, 'csvUpload'])->name('csv_upload');
Route::get('influencer_csv_export',[InfluencerController::class, 'export'])->name('influencer_csv_export');
Route::get('myinfluencrDeleteAll', [InfluencerController::class, 'bulk_delete']);
Route::post('search_influencer', [InfluencerController::class, 'searchInfluencer'])->name('search_influencers');
Route::get('get_influencers', [InfluencerController::class, 'getInfluencers'])->name('get_influencers');


// });

// Route::prefix('coupon')->group(function () {
Route::resource('coupon', CouponsController::class);
Route::get('coupon_csv',[CouponsController::class, 'csvForm'])->name('coupon_csv_form');
Route::post('coupon_csv_upload',[CouponsController::class, 'csvUpload'])->name('coupon_csv_upload');
Route::get('coupon_csv_export',[CouponsController::class, 'export'])->name('coupon_csv_export');
Route::get('mycouponDeleteAll', [CouponsController::class, 'bulk_delete']);
Route::post('search_coupon', [CouponsController::class, 'searchCoupons'])->name('search_coupons');


// });

// Route::prefix('management')->group(function () {
Route::resource('management', ManagementController::class);
Route::get('management_csv',[ManagementController::class, 'csvForm'])->name('management_csv');
Route::post('management_csv_upload',[ManagementController::class, 'csvUpload'])->name('management_csv_upload');
Route::post('management_csv_export',[ManagementController::class, 'export'])->name('management_csv_export');
Route::get('myuploadDeleteAll', [ManagementController::class, 'bulk_delete']);
Route::post('search_all_data', [ManagementController::class, 'searchData'])->name('search_all_data');


// });

// Route::prefix('assciate')->group(function () {
    Route::resource('assciate', AssociationController::class);
    Route::get('assciate_csv',[AssociationController::class, 'csvForm'])->name('assciate_csv');
Route::post('assciate_csv_upload',[AssociationController::class, 'csvUpload'])->name('assciate_csv_upload');
Route::get('assciate_csv_export',[AssociationController::class, 'export'])->name('assciate_csv_export');
Route::get('myassociateDeleteAll', [AssociationController::class, 'bulk_delete']);
Route::get('get/coupons', [AssociationController::class,'getCoupons'])->name('get_coupons');
Route::post('search_associated_data', [AssociationController::class, 'searchData'])->name('search_associated_data');

// });

// Route::prefix('Gallery')->group(function () {
    Route::resource('galleryimages', ImagesGalleryController::class);
    Route::get('multi-images-view', [ImagesGalleryController::class,'multipleImages'])->name('back.item.images.view');

    Route::post('item/multi-images', [ImagesGalleryController::class,'uploadMultipleImages'])->name('back.item.images.multiple');

    Route::get('remove-image/{id}', [ImagesGalleryController::class,'removeImage'])->name('remove.image');

    // Route::view('general-widget', 'widgets.general-widget')->name('general-widget');
    // Route::view('chart-widget', 'widgets.chart-widget')->name('chart-widget');
// });
Route::resource('management', ManagementController::class);

Route::get('graph', [GraphController::class,'index'])->name('graph');
Route::post('datasearch', [GraphController::class,'search'])->name('search_data');

Route::get('influencer_graph', [InfluencerGraphController::class,'index'])->name('influencer.graph');
Route::post('influencer_data_search', [InfluencerGraphController::class,'search'])->name('influencer.search_data');
// Route::post('dataSearch', [GraphController::class,'mainSearch'])->name('data_search');
Route::get('getTemplate', [GraphController::class,'getTemplate'])->name('get_template');

Route::resource('roles', RoleController::class);

// Line Graph
Route::get('linegraph', [LineGraphController::class,'index'])->name('line_graph');
Route::post('linedatasearch', [LineGraphController::class,'search'])->name('line_search_data');

// Backup
Route::get('/backupmanager', [BackupManagerController::class, 'index'])->name('backupmanager');
Route::post('create', [BackupManagerController::class,'createBackup'])->name('backupmanager_create');
Route::post('restore_delete',
[BackupManagerController::class,'restoreOrDeleteBackups'])->name('backupmanager_restore_delete');
Route::get('download/{file}', [BackupManagerController::class,'download'])->name('backupmanager_download');
Route::get('reset', [BackupManagerController::class, 'resetData'])->name('reset_data');
Route::get('db_update', [BackupManagerController::class, 'updateDbFile']);
Route::get('db_update', [BackupManagerController::class, 'updateDbFile'])->name('database_updation');

Route::get('payment',[PaymentController::class,'index'])->name('payment');
Route::post('paymentStore',[PaymentController::class,'store'])->name('payment_store');
Route::get('upload_payment',[PaymentController::class,'uploadPayment'])->name('upload_payments');
Route::post('upload_payment_store',[PaymentController::class,'uploadPaymentStore'])->name('upload_payment_store');
Route::get('payment_detail',[PaymentController::class,'payment_detail'])->name('payment_detail');
Route::get('payment_view/{id}',[PaymentController::class,'payment_view'])->name('payment_view');
Route::get('/change_payment_data',[PaymentController::class,'changePaymentStatus']);

Route::get('/get_influencer_payments',[PaymentController::class,'getInfluencerPayments'])->name('get_influencer_payments');
Route::get('export-payments',[PaymentController::class,'export'])->name('export-payments');
Route::post('search_payments',[PaymentController::class,'searchPayments'])->name('search_payments');
Route::get('searched_payment/{search}',[PaymentController::class,'searchedPayment'])->name('searched_payment');


// End


Route::get('/', function () {
    return redirect()->route('brands.index');
})->name('/');

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
        abort(400);
    }   
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');
    
Route::prefix('dashboard')->group(function () {
    Route::view('index', 'dashboard.index')->name('index');
    // Route::view('dashboard-02', 'dashboard.dashboard-02')->name('dashboard-02');
});

Route::prefix('Brands')->group(function () {
    Route::view('brands', 'brands.index')->name('list_brands');
    Route::view('createBrands', 'brands.create')->name('create_brands');
    Route::view('editBrands', 'brands.edit')->name('edit_brands');
    Route::view('brandsCsv', 'brands.csv_brands')->name('csv_brands');
    // Route::view('general-widget', 'widgets.general-widget')->name('general-widget');
    // Route::view('chart-widget', 'widgets.chart-widget')->name('chart-widget');
});

Route::prefix('Influencer')->group(function () {
    Route::view('Influencers', 'influencer.index')->name('list_influencer'); 
    Route::view('createInfluencers', 'influencer.create')->name('create_influencer');
    Route::view('editInfluencers', 'influencer.edit')->name('edit_influencer');
    Route::view('InfluencersCsv', 'influencer.csv_influencer')->name('csv_influencer'); 
    
    
    
    Route::view('layout-rtl', 'page-layout.layout-rtl')->name('layout-rtl');    
    Route::view('layout-dark', 'page-layout.layout-dark')->name('layout-dark');    
    Route::view('hide-on-scroll', 'page-layout.hide-on-scroll')->name('hide-on-scroll');    
    Route::view('footer-light', 'page-layout.footer-light')->name('footer-light');    
    Route::view('footer-dark', 'page-layout.footer-dark')->name('footer-dark');    
    Route::view('footer-fixed', 'page-layout.footer-fixed')->name('footer-fixed');    
}); 

Route::prefix('Coupones')->group(function () {
    Route::view('coupones', 'coupones.index')->name('coupones_index');
    Route::view('createCoupones', 'coupones.create')->name('create_coupone');
    Route::view('CouponesCsv', 'coupones.csv_coupone')->name('csv_coupones');


    Route::view('projectcreate', 'project.projectcreate')->name('projectcreate');
});

Route::prefix('Management')->group(function () {
    Route::view('management', 'management.index')->name('management_index');
    Route::view('createManagement', 'management.create')->name('create_management');
    Route::view('ManagementCsv', 'management.csv_management')->name('csv_management');


    Route::view('projectcreate', 'project.projectcreate')->name('projectcreate');
});

Route::view('file-manager', 'file-manager')->name('file-manager');
Route::view('kanban', 'kanban')->name('kanban');

Route::prefix('ecommerce')->group(function () {
    Route::view('product', 'apps.product')->name('product');
    Route::view('product-page', 'apps.product-page')->name('product-page');
    Route::view('list-products', 'apps.list-products')->name('list-products');
    Route::view('payment-details', 'apps.payment-details')->name('payment-details');
    Route::view('order-history', 'apps.order-history')->name('order-history');
    Route::view('invoice-template', 'apps.invoice-template')->name('invoice-template');
    Route::view('cart', 'apps.cart')->name('cart');
    Route::view('list-wish', 'apps.list-wish')->name('list-wish');
    Route::view('checkout', 'apps.checkout')->name('checkout');
    Route::view('pricing', 'apps.pricing')->name('pricing');
});

Route::prefix('email')->group(function () {
    Route::view('email-application', 'apps.email-application')->name('email-application');
    Route::view('email-compose', 'apps.email-compose')->name('email-compose');
});

Route::prefix('chat')->group(function () {
    Route::view('chat', 'apps.chat')->name('chat');
    Route::view('chat-video', 'apps.chat-video')->name('chat-video');
});

Route::prefix('users')->group(function () {
    Route::view('user-profile', 'apps.user-profile')->name('user-profile');
    Route::view('edit-profile', 'apps.edit-profile')->name('edit-profile');
    Route::view('user-cards', 'apps.user-cards')->name('user-cards');
});


Route::view('bookmark', 'apps.bookmark')->name('bookmark');
Route::view('contacts', 'apps.contacts')->name('contacts');
Route::view('task', 'apps.task')->name('task');
Route::view('calendar-basic', 'apps.calendar-basic')->name('calendar-basic');
Route::view('social-app', 'apps.social-app')->name('social-app');
Route::view('to-do', 'apps.to-do')->name('to-do');
Route::view('search', 'apps.search')->name('search');

Route::prefix('ui-kits')->group(function () {
    Route::view('state-color', 'ui-kits.state-color')->name('state-color');
    Route::view('typography', 'ui-kits.typography')->name('typography');
    Route::view('avatars', 'ui-kits.avatars')->name('avatars');
    Route::view('helper-classes', 'ui-kits.helper-classes')->name('helper-classes');
    Route::view('grid', 'ui-kits.grid')->name('grid');
    Route::view('tag-pills', 'ui-kits.tag-pills')->name('tag-pills');
    Route::view('progress-bar', 'ui-kits.progress-bar')->name('progress-bar');
    Route::view('modal', 'ui-kits.modal')->name('modal');
    Route::view('alert', 'ui-kits.alert')->name('alert');
    Route::view('popover', 'ui-kits.popover')->name('popover');
    Route::view('tooltip', 'ui-kits.tooltip')->name('tooltip');
    Route::view('loader', 'ui-kits.loader')->name('loader');
    Route::view('dropdown', 'ui-kits.dropdown')->name('dropdown');
    Route::view('accordion', 'ui-kits.accordion')->name('accordion');
    Route::view('tab-bootstrap', 'ui-kits.tab-bootstrap')->name('tab-bootstrap');
    Route::view('tab-material', 'ui-kits.tab-material')->name('tab-material');
    Route::view('box-shadow', 'ui-kits.box-shadow')->name('box-shadow');
    Route::view('list', 'ui-kits.list')->name('list');
});

Route::prefix('bonus-ui')->group(function () {
    Route::view('scrollable', 'bonus-ui.scrollable')->name('scrollable');
    Route::view('tree', 'bonus-ui.tree')->name('tree');
    Route::view('bootstrap-notify', 'bonus-ui.bootstrap-notify')->name('bootstrap-notify');
    Route::view('rating', 'bonus-ui.rating')->name('rating');
    Route::view('dropzone', 'bonus-ui.dropzone')->name('dropzone');
    Route::view('tour', 'bonus-ui.tour')->name('tour');
    Route::view('sweet-alert2', 'bonus-ui.sweet-alert2')->name('sweet-alert2');
    Route::view('modal-animated', 'bonus-ui.modal-animated')->name('modal-animated');
    Route::view('owl-carousel', 'bonus-ui.owl-carousel')->name('owl-carousel');
    Route::view('ribbons', 'bonus-ui.ribbons')->name('ribbons');
    Route::view('pagination', 'bonus-ui.pagination')->name('pagination');
    Route::view('breadcrumb', 'bonus-ui.breadcrumb')->name('breadcrumb');
    Route::view('range-slider', 'bonus-ui.range-slider')->name('range-slider');
    Route::view('image-cropper', 'bonus-ui.image-cropper')->name('image-cropper');
    Route::view('sticky', 'bonus-ui.sticky')->name('sticky');
    Route::view('basic-card', 'bonus-ui.basic-card')->name('basic-card');
    Route::view('creative-card', 'bonus-ui.creative-card')->name('creative-card');
    Route::view('tabbed-card', 'bonus-ui.tabbed-card')->name('tabbed-card');
    Route::view('dragable-card', 'bonus-ui.dragable-card')->name('dragable-card');
    Route::view('timeline-v-1', 'bonus-ui.timeline-v-1')->name('timeline-v-1');
    Route::view('timeline-v-2', 'bonus-ui.timeline-v-2')->name('timeline-v-2');
    Route::view('timeline-small', 'bonus-ui.timeline-small')->name('timeline-small');
});

Route::prefix('builders')->group(function () {
    Route::view('form-builder-1', 'builders.form-builder-1')->name('form-builder-1');
    Route::view('form-builder-2', 'builders.form-builder-2')->name('form-builder-2');
    Route::view('pagebuild', 'builders.pagebuild')->name('pagebuild');
    Route::view('button-builder', 'builders.button-builder')->name('button-builder');
});

Route::prefix('animation')->group(function () {
    Route::view('animate', 'animation.animate')->name('animate');
    Route::view('scroll-reval', 'animation.scroll-reval')->name('scroll-reval');
    Route::view('aos', 'animation.aos')->name('aos');
    Route::view('tilt', 'animation.tilt')->name('tilt');
    Route::view('wow', 'animation.wow')->name('wow');
});


Route::prefix('icons')->group(function () {
    Route::view('flag-icon', 'icons.flag-icon')->name('flag-icon');
    Route::view('font-awesome', 'icons.font-awesome')->name('font-awesome');
    Route::view('ico-icon', 'icons.ico-icon')->name('ico-icon');
    Route::view('themify-icon', 'icons.themify-icon')->name('themify-icon');
    Route::view('feather-icon', 'icons.feather-icon')->name('feather-icon');
    Route::view('whether-icon', 'icons.whether-icon')->name('whether-icon');
    Route::view('simple-line-icon', 'icons.simple-line-icon')->name('simple-line-icon');
    Route::view('material-design-icon', 'icons.material-design-icon')->name('material-design-icon');
    Route::view('pe7-icon', 'icons.pe7-icon')->name('pe7-icon');
    Route::view('typicons-icon', 'icons.typicons-icon')->name('typicons-icon');
    Route::view('ionic-icon', 'icons.ionic-icon')->name('ionic-icon');
});

Route::prefix('buttons')->group(function () {
    Route::view('buttons', 'buttons.buttons')->name('buttons');
    Route::view('buttons-flat', 'buttons.buttons-flat')->name('buttons-flat');
    Route::view('buttons-edge', 'buttons.buttons-edge')->name('buttons-edge');
    Route::view('raised-button', 'buttons.raised-button')->name('raised-button');
    Route::view('button-group', 'buttons.button-group')->name('button-group');
});

Route::prefix('forms')->group(function () {
    Route::view('form-validation', 'forms.form-validation')->name('form-validation');
    Route::view('base-input', 'forms.base-input')->name('base-input');
    Route::view('radio-checkbox-control', 'forms.radio-checkbox-control')->name('radio-checkbox-control');
    Route::view('input-group', 'forms.input-group')->name('input-group');
    Route::view('megaoptions', 'forms.megaoptions')->name('megaoptions');
    Route::view('datepicker', 'forms.datepicker')->name('datepicker');
    Route::view('time-picker', 'forms.time-picker')->name('time-picker');
    Route::view('datetimepicker', 'forms.datetimepicker')->name('datetimepicker');
    Route::view('daterangepicker', 'forms.daterangepicker')->name('daterangepicker');
    Route::view('touchspin', 'forms.touchspin')->name('touchspin');
    Route::view('select2', 'forms.select2')->name('select2');
    Route::view('switch', 'forms.switch')->name('switch');
    Route::view('typeahead', 'forms.typeahead')->name('typeahead');
    Route::view('clipboard', 'forms.clipboard')->name('clipboard');
    Route::view('default-form', 'forms.default-form')->name('default-form');
    Route::view('form-wizard', 'forms.form-wizard')->name('form-wizard');
    Route::view('form-wizard-two', 'forms.form-wizard-two')->name('form-wizard-two');
    Route::view('form-wizard-three', 'forms.form-wizard-three')->name('form-wizard-three');
    Route::post('form-wizard-three', function(){
        return redirect()->route('form-wizard-three');
    })->name('form-wizard-three-post');
});

Route::prefix('tables')->group(function () {
    Route::view('bootstrap-basic-table', 'tables.bootstrap-basic-table')->name('bootstrap-basic-table');
    Route::view('bootstrap-sizing-table', 'tables.bootstrap-sizing-table')->name('bootstrap-sizing-table');
    Route::view('bootstrap-border-table', 'tables.bootstrap-border-table')->name('bootstrap-border-table');
    Route::view('bootstrap-styling-table', 'tables.bootstrap-styling-table')->name('bootstrap-styling-table');
    Route::view('table-components', 'tables.table-components')->name('table-components');
    Route::view('datatable-basic-init', 'tables.datatable-basic-init')->name('datatable-basic-init');
    Route::view('datatable-advance', 'tables.datatable-advance')->name('datatable-advance');
    Route::view('datatable-styling', 'tables.datatable-styling')->name('datatable-styling');
    Route::view('datatable-ajax', 'tables.datatable-ajax')->name('datatable-ajax');
    Route::view('datatable-server-side', 'tables.datatable-server-side')->name('datatable-server-side');
    Route::view('datatable-plugin', 'tables.datatable-plugin')->name('datatable-plugin');
    Route::view('datatable-api', 'tables.datatable-api')->name('datatable-api');
    Route::view('datatable-data-source', 'tables.datatable-data-source')->name('datatable-data-source');
    Route::view('datatable-ext-autofill', 'tables.datatable-ext-autofill')->name('datatable-ext-autofill');
    Route::view('datatable-ext-basic-button', 'tables.datatable-ext-basic-button')->name('datatable-ext-basic-button');
    Route::view('datatable-ext-col-reorder', 'tables.datatable-ext-col-reorder')->name('datatable-ext-col-reorder');
    Route::view('datatable-ext-fixed-header', 'tables.datatable-ext-fixed-header')->name('datatable-ext-fixed-header');
    Route::view('datatable-ext-html-5-data-export', 'tables.datatable-ext-html-5-data-export')->name('datatable-ext-html-5-data-export');
    Route::view('datatable-ext-key-table', 'tables.datatable-ext-key-table')->name('datatable-ext-key-table');
    Route::view('datatable-ext-responsive', 'tables.datatable-ext-responsive')->name('datatable-ext-responsive');
    Route::view('datatable-ext-row-reorder', 'tables.datatable-ext-row-reorder')->name('datatable-ext-row-reorder');
    Route::view('datatable-ext-scroller', 'tables.datatable-ext-scroller')->name('datatable-ext-scroller');
    Route::view('jsgrid-table', 'tables.jsgrid-table')->name('jsgrid-table');
});

Route::prefix('charts')->group(function () {
    Route::view('echarts', 'charts.echarts')->name('echarts');
    Route::view('chart-apex', 'charts.chart-apex')->name('chart-apex');
    Route::view('chart-google', 'charts.chart-google')->name('chart-google');
    Route::view('chart-sparkline', 'charts.chart-sparkline')->name('chart-sparkline');
    Route::view('chart-flot', 'charts.chart-flot')->name('chart-flot');
    Route::view('chart-knob', 'charts.chart-knob')->name('chart-knob');
    Route::view('chart-morris', 'charts.chart-morris')->name('chart-morris');
    Route::view('chartjs', 'charts.chartjs')->name('chartjs');
    Route::view('chartist', 'charts.chartist')->name('chartist');
    Route::view('chart-peity', 'charts.chart-peity')->name('chart-peity');
});

Route::view('sample-page', 'pages.sample-page')->name('sample-page');
Route::view('internationalization', 'pages.internationalization')->name('internationalization');

Route::prefix('starter-kit')->group(function () {
});

Route::prefix('others')->group(function () {
    Route::view('400', 'errors.400')->name('error-400');
    Route::view('401', 'errors.401')->name('error-401');
    Route::view('403', 'errors.403')->name('error-403');
    Route::view('404', 'errors.404')->name('error-404');
    Route::view('500', 'errors.500')->name('error-500');
    Route::view('503', 'errors.503')->name('error-503');
});

// Route::prefix('authentication')->group(function () {
//     Route::view('login', 'authentication.login')->name('login');
//     Route::view('login-one', 'authentication.login-one')->name('login-one');
//     Route::view('login-two', 'authentication.login-two')->name('login-two');
//     Route::view('login-bs-validation', 'authentication.login-bs-validation')->name('login-bs-validation');
//     Route::view('login-bs-tt-validation', 'authentication.login-bs-tt-validation')->name('login-bs-tt-validation');
//     Route::view('login-sa-validation', 'authentication.login-sa-validation')->name('login-sa-validation');
//     Route::view('sign-up', 'authentication.sign-up')->name('sign-up');
//     Route::view('sign-up-one', 'authentication.sign-up-one')->name('sign-up-one');
//     Route::view('sign-up-two', 'authentication.sign-up-two')->name('sign-up-two');
//     Route::view('sign-up-wizard', 'authentication.sign-up-wizard')->name('sign-up-wizard');
//     Route::view('unlock', 'authentication.unlock')->name('unlock');
//     Route::view('forget-password', 'authentication.forget-password')->name('forget-password');
//     Route::view('reset-password', 'authentication.reset-password')->name('reset-password');
//     Route::view('maintenance', 'authentication.maintenance')->name('maintenance');
// });

Route::view('comingsoon', 'comingsoon.comingsoon')->name('comingsoon');
Route::view('comingsoon-bg-video', 'comingsoon.comingsoon-bg-video')->name('comingsoon-bg-video');
Route::view('comingsoon-bg-img', 'comingsoon.comingsoon-bg-img')->name('comingsoon-bg-img');

Route::view('basic-template', 'email-templates.basic-template')->name('basic-template');
Route::view('email-header', 'email-templates.email-header')->name('email-header');
Route::view('template-email', 'email-templates.template-email')->name('template-email');
Route::view('template-email-2', 'email-templates.template-email-2')->name('template-email-2');
Route::view('ecommerce-templates', 'email-templates.ecommerce-templates')->name('ecommerce-templates');
Route::view('email-order-success', 'email-templates.email-order-success')->name('email-order-success');


Route::prefix('gallery')->group(function () {
    Route::view('/', 'apps.gallery')->name('gallery');
    Route::view('gallery-with-description', 'apps.gallery-with-description')->name('gallery-with-description');
    Route::view('gallery-masonry', 'apps.gallery-masonry')->name('gallery-masonry');
    Route::view('masonry-gallery-with-disc', 'apps.masonry-gallery-with-disc')->name('masonry-gallery-with-disc');
    Route::view('gallery-hover', 'apps.gallery-hover')->name('gallery-hover');
});

Route::prefix('blog')->group(function () {
    Route::view('/', 'apps.blog')->name('blog');
    Route::view('blog-single', 'apps.blog-single')->name('blog-single');
    Route::view('add-post', 'apps.add-post')->name('add-post');
});


Route::view('faq', 'apps.faq')->name('faq');

Route::prefix('job-search')->group(function () {
    Route::view('job-cards-view', 'apps.job-cards-view')->name('job-cards-view');
    Route::view('job-list-view', 'apps.job-list-view')->name('job-list-view');
    Route::view('job-details', 'apps.job-details')->name('job-details');
    Route::view('job-apply', 'apps.job-apply')->name('job-apply');
});

Route::prefix('learning')->group(function () {
    Route::view('learning-list-view', 'apps.learning-list-view')->name('learning-list-view');
    Route::view('learning-detailed', 'apps.learning-detailed')->name('learning-detailed');
});

Route::prefix('maps')->group(function () {
    Route::view('map-js', 'apps.map-js')->name('map-js');
    Route::view('vector-map', 'apps.vector-map')->name('vector-map');
});

Route::prefix('editors')->group(function () {
    Route::view('summernote', 'apps.summernote')->name('summernote');
    Route::view('ckeditor', 'apps.ckeditor')->name('ckeditor');
    Route::view('simple-mde', 'apps.simple-mde')->name('simple-mde');
    Route::view('ace-code-editor', 'apps.ace-code-editor')->name('ace-code-editor');
});

Route::view('knowledgebase', 'apps.knowledgebase')->name('knowledgebase');
Route::view('support-ticket', 'apps.support-ticket')->name('support-ticket');
Route::view('landing-page', 'pages.landing-page')->name('landing-page');

Route::prefix('layouts')->group(function () {
    Route::view('compact-sidebar', 'admin_unique_layouts.compact-sidebar'); //default //Dubai
    Route::view('box-layout', 'admin_unique_layouts.box-layout');    //default //New York //
    Route::view('dark-sidebar', 'admin_unique_layouts.dark-sidebar');

    Route::view('default-body', 'admin_unique_layouts.default-body');
    Route::view('compact-wrap', 'admin_unique_layouts.compact-wrap');
    Route::view('enterprice-type', 'admin_unique_layouts.enterprice-type');

    Route::view('compact-small', 'admin_unique_layouts.compact-small');
    Route::view('advance-type', 'admin_unique_layouts.advance-type');
    Route::view('material-layout', 'admin_unique_layouts.material-layout');

    Route::view('color-sidebar', 'admin_unique_layouts.color-sidebar');
    Route::view('material-icon', 'admin_unique_layouts.material-icon');
    Route::view('modern-layout', 'admin_unique_layouts.modern-layout');
});

Route::get('layout-{light}', function($light){
    session()->put('layout', $light);
    session()->get('layout');
    if($light == 'vertical-layout')
    {
        return redirect()->route('pages-vertical-layout');
    }
    return redirect()->route('index');
    return 1;
});
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
