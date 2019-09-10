

@if((Auth::guard('pembeli')->user()))
    <div class="profile-pembeli2">
        <a href="{{route('pembeli.index')}}">Profile</a>
        <a href="{{route('alamat.index',['status'=>'daftar'])}}">Daftar Alamat</a>
        <a href="{{route('cart.index')}}">Keranjang Belanjaan</a>
        <a href="{{route('checkout.index')}}">Pembayaran</a>
        <a href="{{route('pembeli.wishlist')}}">Wishlist</a>
        <a href="{{route('pembeli.wishlist')}}">Riwayat Transaksi</a>
    </div>
@else
    <div class="profile-pembeli2">
        <a href="#">Profile</a>
        <a href="#">Daftar Alamat</a>
        <a href="{{route('cart.index')}}" class="active">Keranjang Belanjaan</a>
        <a href="#">Pembayaran</a>
        <a href="#">Wishlist</a>
        <a href="#">Riwayat Transaksi</a>
    </div>
@endif