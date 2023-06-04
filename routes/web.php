<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;

use App\Http\Controllers\Backend\VendorProductController;

use App\Http\Controllers\Backend\PosterController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingCountryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\OrderDetailsController;
use App\Http\Controllers\Backend\ReportController;



use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\GeneralPagesController;

use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\ReviewProductController;

use App\Http\Controllers\BotmanController;

use App\Http\Middleware\RedirectIfAuthenticated;



use PHPUnit\Metadata\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('frontend.index');
});


Route::middleware(['auth', 'verified'])->group(function () {

    //route to diaplay the user dashboard
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    //route to logout the vendor
    Route::get('/user/logout', [UserController::class, 'UserDestroy'])->name('user.logout');

    //route for the update password
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';




//admin 
Route::middleware(['auth', 'role:admin'])->group(function () {

    //route to diaplay the admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    //route to logout the admin
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');

    //route for the profile
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    //route for the edit profile
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    //route for change password page
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    //route for the update password
    Route::post('/admin/profile/update', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');



    //category routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    //sub category routes 
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subCategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subCategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subCategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subCategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subCategory', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subCategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');

        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
    });




    //manage vendors (boutiques) routes 
    Route::controller(AdminController::class)->group(function () {
        Route::get('/inactive/boutique', 'InactiveBoutique')->name('inactive.boutique');
        Route::get('/active/boutique', 'ActiveBoutique')->name('active.boutique');
        Route::get('/rejected/boutique', 'RejectedBoutique')->name('rejected.boutique');

        Route::get('/view/boutique/{id}', 'ViewBoutiqueDetails')->name('view.boutiqueDetails');

        Route::post('/active/boutique/approve', 'ActivateBoutiqueApprove')->name('active.boutique.approve');
        Route::post('/deactive/boutique/approve', 'DeactivateBoutiqueApprove')->name('deactive.boutique.approve');
        Route::post('/reject/boutique/approve', 'RejectBoutiqueApprove')->name('reject.boutique.approve');
        Route::post('/delete/boutique/approve', 'DeleteBoutiqueApprove')->name('delete.boutique.approve');

        //notification mark read
        Route::get('/admin/read/notification', 'ReadNotification')->name('admin.mark.read.notification');
    });



    //products
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/admin/all/product', 'AdminAllProduct')->name('admin.all.products');
        Route::get('/admin/product/unfavoutive/{id}', 'AdminProductUnFavourite')->name('admin.unfavourite.product');
        Route::get('/admin/product/favourite/{id}', 'AdminProductFavourite')->name('admin.favourite.product');

        Route::get('/admin/fouvourite/product', 'AdminAllFavouriteProduct')->name('admin.favourite.products');

        Route::get('/vendor/delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');

        Route::get('/admin/view/product/{id}', 'AdminViewProduct')->name('admin.view.product');
        Route::get('/admin/delete/product/{id}', 'AdminDeleteProduct')->name('admin.delete.product');

        Route::get('/admin/vendor/product/{id}', 'AdminSelectedVendorProducts')->name('admin.selected.vendor.products');

        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
        });
    });


    Route::controller(PosterController::class)->group(function () {
        Route::get('/all/poster', 'AllPoster')->name('all.poster');
        Route::get('/add/poster', 'AddPoster')->name('add.poster');
        Route::post('/store/poster', 'StorePoster')->name('store.poster');
        Route::get('/edit/poster/{id}', 'EditPoster')->name('edit.poster');
        Route::post('/update/poster', 'UpdatePoster')->name('update.poster');
        Route::get('/view/poster/{id}', 'ViewPoster')->name('view.poster');
        Route::get('/delete/poster/{id}', 'DeletePoster')->name('delete.poster');
        Route::get('/active/poster/{id}', 'PosterActive')->name('active.poster');
        Route::get('/inactive/poster/{id}', 'PosterInactive')->name('inactive.poster');
    });




    Route::controller(CouponController::class)->group(function () {

        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/all/active/coupon', 'AllActiveCoupon')->name('all.active.coupon');
        Route::get('/all/inactive/coupon', 'AllInactiveCoupon')->name('all.inactive.coupon');
        Route::get('/all/expired/coupon', 'AllExpiredCoupon')->name('all.expired.coupon');

        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');

        Route::get('/active/coupon/{id}', 'ActiveCoupon')->name('active.coupon');
        Route::get('/inactive/coupon/{id}', 'InactiveCoupon')->name('inactive.coupon');

        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('update.coupon');

        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');

        Route::get('/coupon/poster/{id}', 'GetCouponPoster')->name('get.coupon.poster');
    });


    //shipping area system
    Route::controller(ShippingCountryController::class)->group(function () {
        Route::get('/all/shippingArea', 'AllShippingArea')->name('all.shippingArea');
        Route::get('/all/active/shippingArea', 'AllActiveShippingArea')->name('all.active.shippingArea');
        Route::get('/all/inactive/shippingArea', 'AllInactiveShippingArea')->name('all.inactive.shippingArea');

        Route::post('/store/shippingArea', 'StoreShippingArea')->name('store.shippingArea');
        Route::get('/add/shippingArea', 'AddShippingArea')->name('add.shippingArea');

        Route::get('/active/shippingArea/{id}', 'ActiveShippingArea')->name('active.shippingArea');
        Route::get('/inactive/shippingArea/{id}', 'InactiveShippingArea')->name('inactive.shippingArea');

        Route::get('/edit/shippingArea/{id}', 'EditShippingArea')->name('edit.shippingArea');
        Route::post('/update/shippingArea', 'UpdateShippingArea')->name('update.shippingArea');

        Route::get('/delete/shippingArea/{id}', 'DeleteShippingArea')->name('delete.shippingArea');
    });


    //orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/all/order', 'AllOrder')->name('all.order');
        Route::get('/pending/order', 'AllPendingOrder')->name('pending.order');
        Route::get('/confirmed/order', 'AllConfirmedOrder')->name('confirmed.order');
        Route::get('/processing/order', 'AllProcessingOrder')->name('processing.order');
        Route::get('/delivered/order', 'AllDeliveredOrder')->name('delivered.order');
        Route::get('/cancelled/order', 'AllCancelledOrder')->name('cancelled.order');
        Route::get('/admin-view/order/details/{order_id}', 'AdminViewOrderDetails')->name('admin.order.details');

        Route::get('/admin/comfirn/{order_id}', 'PendingToConfirm')->name('mark.confirm.order');
        Route::get('/admin/process/{order_id}', 'ContirmToProcess')->name('mark.process.order');
        Route::get('/admin/deliver/{order_id}', 'ProceessToDeliverd')->name('mark.deliver.order');

        Route::get('/admin/download/order-details/{order_id}', 'AdminDownloadOrderDetails')->name('admin.download.order.details');
    });
    Route::controller(OrderDetailsController::class)->group(function () {
        Route::get('/all/ready/order/items', 'AdminGetAllReadyItem')->name('all.ready.order.items');
    });
    //reports
    Route::controller(ReportController::class)->group(function () {
        Route::get('/report/view', 'ReportView')->name('report.view');
        Route::post('/report/search-by-date', 'SearchByDate')->name('search.by.date');
        Route::post('/report/search-by-month', 'SearchByMonth')->name('search.by.month');
        Route::post('/report/search-by-year', 'SearchByYear')->name('search.by.year');
        Route::get('/report/order-by-user', 'OrderByUser')->name('order.by.user');
        Route::post('/report/search-by-user', 'SearchByUser')->name('search.by.user');

        Route::get('/report/all-users', 'GetAllUsers')->name('report.all.user');

        Route::get('/report/all-user-orders/{user_id}', 'GetUserOrders')->name('report.all.user.order');

        Route::get('/report/all-boutiques', 'GetAllVendors')->name('report.all.vendor');
    });


    //product review routes 
    Route::controller(ReviewProductController::class)->group(function () {

        Route::get('/published/reviews', 'GetAllPublishedReviews')->name('all.published.reviews');
        Route::get('/blocked/reviews', 'GetAllBlockedReviews')->name('all.blocked.reviews');

        Route::get('/block/review/{review_id}', 'BlockReview')->name('admin.block.review');

        Route::get('/publish/review/{review_id}', 'RePublishReview')->name('admin.publish.review');
    });
});


//vendor 
Route::middleware(['auth', 'role:vendor'])->group(function () {

    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');

    //route to logout the vendor
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');

    //route for the profile
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');

    //route for the edit profile
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');

    //route for change password page
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    //route for the update password
    Route::post('/vendor/profile/update', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');


    //notification mark read
    Route::get('/vendor/read/notification', [VendorController::class, 'ReadNotification'])->name('mark.read.notification');

    Route::get('/vendor/joining/poster', [VendorController::class, 'VendorPostPage'])->name('vendor.join.poster');





    //vendor product routes  
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.products');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thumbnail', 'VendorUpdateProductThumbnail')->name('vendor.update.product.thumbnail');
        Route::post('/vendor/update/product/multiimage', 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/delete/product/multiimage/{id}', 'VendorDeleteProductMultiimage')->name('vendor.delete.product.multiimage');
        Route::get('/vendor/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');





        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
        });



        //orders routes
        Route::controller(OrderDetailsController::class)->group(function () {
            Route::get('/boutique/order/all', 'AllVendorOrder')->name('vendor.order.all');
            Route::get('/boutique/order/pending', 'AllVendorPendingOrder')->name('vendor.order.pending');
            Route::get('/boutique/order/processing', 'AllVendorProcessingOrder')->name('vendor.order.processing');
            Route::get('/boutique/order/ready', 'AllVendorFinishedOrder')->name('vendor.order.ready');
            Route::get('/boutique/order/delivered', 'AllVendorDeliveredOrder')->name('vendor.order.delivered');
            Route::get('/boutique/order/cancelled', 'AllVendorCancelledOrder')->name('vendor.order.cancelled');

            Route::get('/boutique/order/details/{order_id}', 'VendorOrderDetails')->name('vendor.order.details');

            Route::get('/boutique/process/{orderItem_id}', 'PendingToProcess')->name('mark.processing.orderItem');
            Route::get('/boutique/ready/{orderItem_id}', 'ProcessToReady')->name('mark.ready.orderItem');
            Route::get('/boutique/deliver/{orderItem_id}', 'ReadyToDeliverd')->name('mark.deliver.orderItem');
        });

        Route::get('/vendor/all/product/stock', 'VendorAllProductStock')->name('vendor.stock.all');
    });


    //product review routes 
    Route::controller(ReviewProductController::class)->group(function () {

        Route::get('/boutique/products/reviews', 'GetAllVendorReviews')->name('vendor.reviews.all');
    });
});





//user routes
Route::middleware(['auth', 'role:user'])->group(function () {


    //wishlist routes 
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlistProducts')->name('wishlist');
        Route::get('/get-all-wishlist-product', 'GetAllWishlistProducts');
        Route::get(' /wishlist-remove-product/{id}', 'RemoveWishlistProduct');
    });


    //checkout routes 
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/city/ajax/{country_id}', 'CityGetAjax');
        Route::get('/shipping-cost/ajax/{country_id}', 'CostGetAjax');

        Route::post('/checkout/store', 'StoreCheckout')->name('store.checkout');
    });

    //payment stripe routes 
    Route::controller(StripeController::class)->group(function () {
        // Route::post('/payment/stripe/order', 'StripeOrder')->name('stripe.order');
        // Route::post('/payment', [PaymentController::class, 'payment']);

        Route::post('/payment', 'payment')->name('stripe.order');
        Route::get('/order/successful', 'SuccessfulOrder')->name('thankYou');

        Route::post('/cash-payment', 'CashPayment')->name('cash.order');
    });

    //user dashboard routes 
    Route::controller(AllUserController::class)->group(function () {
        Route::get('/user/account/page', 'UserAccount')->name('user.account.page');
        Route::get('/user/change-password/page', 'UserChangePassword')->name('user.change.password');
        Route::get('/user/orders/page', 'UserOrders')->name('user.orders.page');
        Route::get('/user/track/order', 'UserTrackOrder')->name('user.track.order');


        Route::get('/user/order-details/{order_id}', 'UserOrderDetails');
        Route::get('/user/order-download/{order_id}', 'UserOrderDownlad');

        Route::get('/user/order/cancel/{order_id}', 'UserOrderCancel');

        Route::post('/user/track/order', 'UserTrackingOrder')->name('user.order.tracking');
    });

    //product review routes 
    Route::controller(ReviewProductController::class)->group(function () {

        Route::post('/store/product-review', 'StoreProductReview')->name('store.review');
    });
});



// -----------------------------all users--------------------------------------------

//cart routes
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'myCart')->name('cart');
    Route::get('/get-cart-products', 'getAllCartProducts');
    Route::get('/cart-remove-product/{rowId}', 'RemoveCartProduct');

    Route::get('/cart-qty-decreament/{rowId}', 'cartQtyDecreament');
    Route::get('/cart-qty-increament/{rowId}', 'cartQtyIncreament');
});

Route::controller(IndexController::class)->group(function () {
    //frontend product details routes for all users
    Route::get('product/details/{id}/{slug}', 'ProductDetails');

    Route::get('/boutique/details/{id}', 'BoutiqueDetails')->name('boutique.details');
    Route::get('/boutique/all', 'BoutiqueAll')->name('boutique.all');

    Route::get('/product/category/{id}/{slug}', 'CategoryProducts');
    Route::get('/product/subcategory/{id}/{slug}', 'SubCategoryProducts');

    Route::get('/shop/all', 'ProductAll')->name('product.all');
    Route::get('/shop/sale', 'SaleProductAll')->name('product.sale.all');

    Route::get('/collection/all', 'CollectionAll')->name('collection.all');


    Route::post('/shop/all/filter', 'ShopPageFilter')->name('shop.all.filter');
    Route::post('/shop/sale/filter', 'SalePageFilter')->name('shop.sale.filter');

    Route::post('/shop/boutique/filter', 'BoutiquePageFilter')->name('shop.boutique.filter');
});




//add to cart routes 
Route::post('cart/data/store/{id}', [CartController::class, 'AddToCart']);

Route::get('/product/mini/cart', [CartController::class, 'AddToMiniCart']);
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveFromMiniCart']);


Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishlist']);


//coupon
Route::post('/apply-coupon', [CartController::class, 'ApplyCoupon']);
Route::get('/coupon-calc', [CartController::class, 'CouponCalc']);
Route::get('/remove-coupon', [CartController::class, 'RemoveCoupon']);

//checkout
Route::get('/checkout', [CartController::class, 'MakeCheckout'])->name('checkout');

//search
Route::post('/search', [IndexController::class, 'SearchProduct'])->name('product.search');


//chatbot routes
Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotmanController@handle');


//general web pages routes 

Route::controller(GeneralPagesController::class)->group(function () {
    //frontend product details routes for all users

    Route::get('/about-us', 'ShowAboutPage')->name('show.about.page');
    Route::get('/delivery-terms', 'ShowDeliveryTermsPage')->name('show.deliveryterms.page');
    Route::get('/faqs', 'ShowFaqsPage')->name('show.faqs.page');
    Route::get('/joining-criteria', 'ShowJoiningCriteriaPage')->name('show.joiningcriteria.page');
    Route::get('/payment-methods', 'ShowPaymentMethodsPage')->name('show.paymentmethods.page');
    Route::get('/privacy-policy', 'ShowPrivacyPolicyPage')->name('show.privacypolicy.page');
    Route::get('/terms-and-conditions', 'ShowTermsConditionsPage')->name('show.termsconditions.page');
});


//login routes 

//admin 
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
//vendor
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
//vendor regidteration
Route::get('/register/boutique', [VendorController::class, 'RegisterBoutique'])->name('register.boutique');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');






// Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard']) -> name('admin.dashboard');

// Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard']) -> name('vendor.dashboard');


// Route::middleware(['auth', 'role:admin'])->group(function(){

//     //category routes
//         Route::controller(CategoryController::class)->group(function(){
//             Route::get('/all/category' , 'AllCategory')->name('all.category');
//             Route::get('/add/category' , 'AddCategory')->name('add.category');
//             Route::post('/store/category' , 'StoreCategory')->name('store.category');
//             Route::get('/edit/category/{id}' , 'EditCategory')->name('edit.category');
//             Route::post('/update/category' , 'UpdateCategory')->name('update.category');
//             Route::get('/delete/category/{id}' , 'DeleteCategory')->name('delete.category');
        
//         });
        
//     //sub catwgory routes 
//     Route::controller(SubCategoryController::class)->group(function(){
//         Route::get('/all/subCategory' , 'AllSubCategory')->name('all.subcategory');
//         Route::get('/add/subCategory' , 'AddSubCategory')->name('add.subcategory');
//         Route::post('/store/subCategory' , 'StoreSubCategory')->name('store.subcategory');
//         Route::get('/edit/subCategory/{id}' , 'EditSubCategory')->name('edit.subcategory');
//         Route::post('/update/subCategory' , 'UpdateSubCategory')->name('update.subcategory');
//         Route::get('/delete/subCategory/{id}' , 'DeleteSubCategory')->name('delete.subcategory');
    
//     });
    
    
    
    
//     });