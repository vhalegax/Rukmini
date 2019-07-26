<?php

Auth::routes();

Route::get('karyawan/home','UserController@home')->name('karyawan.home');
Route::resource('karyawan/users','UserController');

Route::get('karyawan/kategori/{id}/restore', 'KategoriController@restore')->name('kategori.restore');
Route::get('karyawan/kategori/trash', 'KategoriController@trash')->name('kategori.trash');
Route::delete('karyawan/kategori/{id}/delete-permanent', 'KategoriController@deletePermanent')->name('kategori.delete-permanent');
Route::get('karyawan/ajax/kategori/search', 'KategoriController@ajaxSearch');
Route::resource('karyawan/kategori', 'KategoriController');

Route::get('karyawan/bajus/{id}/restore', 'BajuController@restore')->name('bajus.restore');
Route::get('karyawan/bajus/trash', 'BajuController@trash')->name('bajus.trash');
Route::delete('karyawan/bajus/{id}/delete-permanent', 'BajuController@deletePermanent')->name('bajus.delete-permanent');
Route::resource('karyawan/bajus', 'BajuController');

Route::resource('karyawan/orders', 'OrderController');

Route::resource('karyawan/kupon', 'KuponController');

Route::get('/','ShopController@home')->name('home');
Route::get('/shop','ShopController@tampilsemua')->name('tampil');
Route::get('/shop/{id}/detail','ShopController@detail')->name('shop.detail');

Route::get('/shop/{id}/wishlist','WishlistController@wishlist')->name('shop.wishlist');
Route::get('/shop/{id}/hapuswishlist','WishlistController@hapuswishlist')->name('shop.hapuswishlist');


Route::get('/pembeli/konfirmasi/{id}','PembeliController@konfirmasipembayaran')->name('pembeli.konfirmasi');
Route::post('/pembeli/login', 'Auth\PembeliLoginController@login')->name('pembeli.login.post');
Route::post('/pembeli/logout','Auth\PembeliLoginController@logout')->name('pembeli.logout');
Route::get('/pembeli/login','Auth\PembeliLoginController@showLoginForm')->name('pembeli.login');
Route::get('/pembeli/alamat','PembeliController@alamat')->name('pembeli.alamat');
Route::get('/pembeli/wishlist','PembeliController@wishlist')->name('pembeli.wishlist');
Route::get('/pembeli/history','PembeliController@history')->name('pembeli.history');

Route::resource('/pembeli','PembeliController');
Route::resource('/pembeli/alamat','AlamatController');
Route::resource('checkout','CheckoutController');

Route::get('/cart/tambahbelanjaan/{id}','CartController@tambahbelanjaan');
Route::get('/cart/kurangbelanjaan/{id}','CartController@kurangbelanjaan');
Route::get('/cart/city/{id}', 'CartController@city');
Route::get('/cart/cekongkir2/{v1}/{v2}/{v3}/{v4}','CartController@cekongkir2');
Route::get('/cart/cekkupon/{kupon}/{subtotal}','CartController@cekkupon');
Route::resource('cart','CartController');

Route::get('/getcity','CartController@getcity');
Route::get('/getprovince','CartController@getprovince');

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