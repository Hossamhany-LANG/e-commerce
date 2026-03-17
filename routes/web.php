<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\LanguagesController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Middleware\Roles;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\MainCategoriesController;
use App\Http\Controllers\Backend\VendorsController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\InformationController;
use App\Http\Controllers\Frontend\ItemsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ComparisonController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\PaymentController;

Route::get('/', [FrontendController::class , 'index'])->name('frontend.index');
Route::get('/cart', [FrontendController::class , 'cart'])->name('frontend.cart');
Route::get('/checkout', [FrontendController::class , 'checkout'])->name('frontend.checkout');
Route::get('/product/{id}', [FrontendController::class , 'product'])->name('frontend.product');
Route::get('/store', [FrontendController::class , 'store'])->name('frontend.store');
Route::post('products/review/{id}', [FrontendController::class, 'productreviews'])->name('products.productreviews')->middleware('auth');
Route::put('/newsletter-subscribe', [FrontendController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('about-us/page',[InformationController::class,'aboutus'])->name('aboutus.page');//frontend about us page
Route::get('contact-us',[InformationController::class,'contactus'])->name('contactus');
Route::post('contact-us/store',[InformationController::class,'storecontactus'])->name('contactus.store')->middleware('auth');
Route::get('privacy-policy',[InformationController::class,'privacy_policy'])->name('privacy_policy');
Route::get('orders_and_returns',[InformationController::class,'orders_and_returns'])->name('orders_and_returns');
Route::get('returnproducts/{order_id}/{product_id}',[InformationController::class,'returnproducts'])->name('returnproducts.create');
Route::post('returns_products/store',[InformationController::class,'store_return_products'])->name('returnproducts.store');
Route::get('terms-and-conditions',[InformationController::class,'terms_and_conditions'])->name('terms_and_conditions');
Route::get('help',[InformationController::class,'help'])->name('help');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/wishlist', [WishListController::class , 'wishlist'])->name('wishlist');
Route::post('/add_wishlist/{id}', [WishlistController::class, 'add_wishlist'])->name('wishlist.add');
Route::post('/wishlist/{id}/move-to-cart', [WishListController::class , 'moveToCart'])->name('wishlist.moveToCart');
Route::post('/wishlist/move-all-to-cart', [WishListController::class , 'moveAllToCart'])->name('wishlist.moveAllToCart');
Route::delete('/wishlist/delete/{id}', [WishListController::class, 'delete_wishlist_product'])->name('wishlist_product.delete');
Route::delete('/wishlist/delete', [WishListController::class, 'delete_all_wishlist_products'])->name('wishlist.delete.all');

Route::post('/add-to-compare/{id}', [ComparisonController::class, 'addToCompare'])->name('compare.add');
Route::get('/compare', [ComparisonController::class, 'index'])->name('compare.index');
Route::delete('/compare/remove/{id}', [ComparisonController::class, 'remove'])->name('compare.remove');

Route::post('/cart/add', [CartController::class, 'Add_Cart'])->name('cart.Add');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete_Cart'])->name('cart.delete');
Route::delete('/cart/delete', [CartController::class, 'delete_all_Carts'])->name('cart.delete.all');
// from product page
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');

Route::post('/placeorder' , [OrderController::class,'placeorder'])->name('placeorder');
Route::get('/hot-deals', [ProductController::class, 'hotdeals'])->name('hot.deals');

Route::get('/showorders',[OrderController::class,'showorders'])->name('showorders');
Route::get('/showdetails/{id}',[OrderController::class,'show_order_details'])->name('show_order_details');
Route::get('/showmessages/{id}',[OrderController::class,'show_client_message'])->name('show-client-message');
Route::get('/showmessages',[OrderController::class,'show_all_clients_messages'])->name('show-all-clients-messages');
Route::delete('/delete-client-messages/{id}',[OrderController::class,'delete_client_messages'])->name('delete_client_messages');
Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('update_order_status');
Route::delete('/deleteorder/{id}',[OrderController::class,'deleteorder'])->name('deleteorder');
Route::get('/show-return-orders',[OrderController::class,'show_return_orders'])->name('show-return-orders');
Route::put('/retturn-orders/{id}/status', [OrderController::class, 'update_returns_Status'])->name('update_returns_status');
Route::get('/show-returns-details/{id}', [OrderController::class, 'show_returns_details'])->name('show_returns_details');
Route::delete('/delete-return-order/{id}',[OrderController::class,'delete_return_order'])->name('delete_return_order');
Route::get('hide_order_notification',[OrderController::class,'hide_order_notification'])->name('hide_order_notification');

Route::post('/handle-payment', [PaymentController::class, 'handlePayment'])->name('make_payment');
Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

Route::get('/computerdevices', [ItemsController::class , 'computerdevices'])->name('frontend.computerdevices');
Route::get('/smartphones', [ItemsController::class , 'smartphones'])->name('frontend.smartphones');
Route::get('/cameras', [ItemsController::class , 'cameras'])->name('frontend.cameras');
Route::get('/homeelectronics', [ItemsController::class , 'homeelectronics'])->name('frontend.homeelectronics');
Route::get('/accessories', [ItemsController::class , 'accessories'])->name('frontend.accessories');

//لعرض الفئات الرئيسيه كلُ علي حده
Route::get('category/{slug}', [FrontendController::class, 'showCategoryProducts'])->name('category.products');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit/{id}/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/update/{id}/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/delete/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin' , 'as' =>'admin.'] , function(){
        Route::get('/login', [LoginController::class,'loginpage'])->name('login_page');
        Route::get('/forgot-password', [BackendController::class , 'forgot_password'])->name('forgot_password');

    Route::group(['middleware' => Roles::class , 'role:admin|supervisor'] , function(){
        Route::post('/logout', [LoginController::class, 'admin_logout'])->name('logout');
        Route::get('/', [BackendController::class , 'index'])->name('index_route');
        Route::get('/index', [BackendController::class , 'index'])->name('index');

        Route::get('/admin-profile', [ProfileController::class, 'show_admin_profile'])->name('adminprofile.show');
        Route::get('/edit-admin-profile', [ProfileController::class, 'edit_admin_profile'])->name('adminprofile.edit');
        Route::put('/update-admin-profile/{id}', [ProfileController::class, 'update_admin_profile'])->name('adminprofile.update');
        Route::resource('languages' , LanguagesController::class);
        Route::resource('main_categories' , MainCategoriesController::class);
        Route::get('main_categories/changestatus/{id}', [MainCategoriesController::class, 'changestatus'])->name('main_categories.changestatus');
        Route::resource('subcategories' , SubCategoryController::class);
        Route::get('subcategories/changestatus/{id}', [SubCategoryController::class, 'changestatus'])->name('subcategories.changestatus');
        Route::resource('vendors' , VendorsController::class);
        Route::get('vendors/changestatus/{id}', [VendorsController::class, 'changestatus'])->name('vendors.changestatus');
        Route::resource('products' , ProductController::class);
        Route::get('subcategories-by-category/{id}', [ProductController::class, 'getSubcategories']);
        Route::get('products/changestatus/{id}', [ProductController::class, 'changestatus'])->name('products.changestatus');
        Route::resource('about-us',InformationController::class); //backend about us routes

        Route::get('products/{id}/discount', [ProductController::class, 'discount'])->name('products.discount');
        Route::post('products/{id}/discount', [ProductController::class, 'updateDiscount'])->name('products.updateDiscount');
        Route::get('allproducts/discount', [ProductController::class, 'discount_all'])->name('allproducts.discount');       
        Route::post('all_products/discount', [ProductController::class, 'updateDiscount_forall'])->name('allproducts.updateDiscount');

    });        
});