<?php

Auth::routes();

Route::get('dashboard/beranda','UserController@home')->name('dashboard');
Route::resource('dashboard/users','UserController');

Route::get('dashboard/ajax/kategori/search', 'KategoriController@ajaxSearch');
Route::resource('dashboard/kategori', 'KategoriController');

Route::resource('dashboard/pakaian', 'BajuController');

Route::resource('dashboard/orders', 'OrderController');

Route::get('dashboard/kupon/nonaktif/{id}','KuponController@nonaktif')->name('kupon.nonaktif');
Route::resource('dashboard/kupon', 'KuponController');

Route::resource('dashboard/rekening','RekeningController');

Route::resource('dashboard/kasir','KasirController');

Route::get('dashboard/spkpembeli/rekomendasi/{id}','SPKPembeliController@rekomendasi')->name('spkpembeli.rekomendasi');
Route::get('dashboard/spkpembeli/similarity/{id}','SPKPembeliController@similarity')->name('spkpembeli.similarity');
Route::resource('dashboard/spkpembeli','SPKPembeliController');

Route::get('karyawan/rating/rekomendasi','RatingController@rekomendasi')->name('rating.rekomendasi');
Route::get('karyawan/rating/similarity','RatingController@similarity')->name('rating.similarity');
Route::get('karyawan/rating/similarity2/{id}','RatingController@similarity2')->name('rating.similarity2');
Route::get('karyawan/rating/rating','RatingController@rating')->name('rating.rating');
Route::resource('karyawan/rating','RatingController');

Route::get('/','ShopController@home')->name('home');
Route::get('/shop','ShopController@tampilsemua')->name('tampil');
Route::get('/shop/{id}/detail','ShopController@detail')->name('shop.detail');

Route::get('/shop/{id}/wishlist','WishlistController@wishlist')->name('shop.wishlist');
Route::get('/shop/{id}/hapuswishlist','WishlistController@hapuswishlist')->name('shop.hapuswishlist');

Route::post('/pembeli/login', 'Auth\PembeliLoginController@login')->name('pembeli.login.post');
Route::post('/pembeli/logout','Auth\PembeliLoginController@logout')->name('pembeli.logout');
Route::get('/pembeli/login','Auth\PembeliLoginController@showLoginForm')->name('pembeli.login');

Route::get('/pembeli/alamat','PembeliController@alamat')->name('pembeli.alamat');
Route::get('/pembeli/wishlist','PembeliController@wishlist')->name('pembeli.wishlist');
Route::get('/pembeli/history','PembeliController@history')->name('pembeli.history');

Route::resource('/pembeli','PembeliController');
Route::resource('/pembeli/alamat','AlamatController');

Route::get('/pembeli/konfirmasi/{id}','CheckoutController@konfirmasipembayaran')->name('checkout.konfirmasi');
Route::resource('checkout','CheckoutController');

Route::get('/cart/tambahbelanjaan/{id}','CartController@tambahbelanjaan');
Route::get('/cart/kurangbelanjaan/{id}','CartController@kurangbelanjaan');
Route::get('/cart/city/{id}', 'CartController@city');
Route::get('/cart/cekongkir2/{v1}/{v2}/{v3}/{v4}','CartController@cekongkir2');
Route::get('/cart/cekkupon/{kupon}/{subtotal}','CartController@cekkupon');
Route::resource('cart','CartController');

Route::get('/rating/tambahrating/{userid}/{komentar}/{rating}/{bajuid}','RatingController@tambahrating');
Route::resource('rating','RatingController');

Route::get('/getcity','CartController@getcity');
Route::get('/getprovince','CartController@getprovince');


// --------------------------------------------------------------------------------------------------------------------- //

Route::get('/storagelink',function()
{
     $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/admin/storage/app/public';
     $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
     symlink($targetFolder,$linkFolder);
     echo 'Symlink process successfully completed';
});

Route::get('cobafungsi', function () {
    return $_GET['berhasil'];
})->name('cobafungsi');

Route::get('mikrotik', function () {
    return '"<object type="text/html" data="http://cleon.jogjamedianet.com/checker/cuser.php?user=wiz_wiznu@ymail.com" style="width:100%" "height:100%" ></object>"';
});

Route::get('cekcontent','CartController@cekcart');
Route::post('/cart/belajarajax','CartController@belajarajax');
