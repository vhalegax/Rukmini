<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail_tr_penjualan;
use App\Baju;
use App\Tr_penjualan;
use App\Alamat;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $order = \App\Tr_penjualan::where('pembeli_id','LIKE', Auth::guard('pembeli')->user()->id)->paginate(10)->sortByDesc('id');;
        return view('pembeli.semuatransaksi',['order' => $order]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        foreach(Cart::content() as $itemcheck)
        {
            $baju = \App\Baju::findOrFail($itemcheck->id);
            foreach($baju->jumlah as $jumlahs)
            {
                if($jumlahs->size==$itemcheck->options->size)
                {
                    if($jumlahs->jumlah>=$itemcheck->qty)
                    {
                        $new_order = new \App\Tr_penjualan;
                        $new_order->pembeli_id= Auth::guard('pembeli')->user() ? Auth::guard('pembeli')->user()->id : null;
                        $new_order->invoice_number = date("Ymdhis");
                        $new_order->subtotal = $request->get('total')-$request->get('ongkir');
                        $new_order->ongkir = $request->get('ongkir');
                        $new_order->potongankupon = $request->get('potongankupon');
                        $new_order->total= $request->get('total');
                        $new_order->no_resi=0;
                        $new_order->status='Menunggu Pembayaran';
                        $new_order->karyawan_id=3;

                        if($request->get('kupon'))
                        {
                            $kupon1= \App\Kupon::where('kode_kupon',$request->get('kupon'))->get();
                            if(!$kupon1->isEmpty())
                            {
                                foreach($kupon1 as $kupon1)
                                {
                                    $kupon1->jumlah = $kupon1->jumlah-1;
                                    $kupon1->save();
                                    $new_order->kupon_id = $kupon1->id;
                                }
                            }
                        }
                        
                        $new_order->save();
                
                        $pengiriman = new \App\Pengiriman;
                        $pengiriman->tr_penjual_id = $new_order->id;
                        $pengiriman->nama_penerima = $request->get('nama');
                        $pengiriman->telp = $request->get('telp');
                        $pengiriman->jalan = $request->get('alamat');
                        $pengiriman->provinsi = $request->get('prov');
                        $pengiriman->kota = $request->get('cities');
                        $pengiriman->kode_pos = $request->get('kode_pos');
                        $pengiriman->pengiriman = $request->get('jasa');
                        $pengiriman->service = $request->get('ongkirservice');
                        $pengiriman->biayakirim = $request->get('ongkir');
                        $pengiriman->berat = $request->get('berat');
                        $pengiriman->save();
                
                        if(empty(Alamat::find($request->get('idalamat'))))
                        {
                            $alamat = new \App\Alamat;
                            $alamat->nama = $request->get('nama');
                            $alamat->telp = $request->get('telp');
                            $alamat->jalan = $request->get('alamat');
                            $alamat->kode_pos = $request->get('kode_pos');
                            $alamat->kota = $request->get('cities');
                            $alamat->provinsi = $request->get('prov');
                            $alamat->id_pembeli = Auth::guard('pembeli')->user()->id;
                            $alamat->save();
                        }
                       
                        foreach(Cart::content() as $item)
                        {
                            Detail_tr_penjualan::create([
                                'tr_penjualan_id'=> $new_order->id,
                                'pakaian_id' => $item->id,
                                'jumlah' => $item->qty,
                                'harga' => $item->price,
                                'size' => $item->options->size,
                                'subtotal' => $item->qty*$item->price,
                            ]);
                                
                            $baju = \App\Baju::findOrFail($item->id);
                            foreach($baju->jumlah as $jumlahs)
                            {
                                if($jumlahs->size==$item->options->size)
                                {
                                    $jumlahs->jumlah = $jumlahs->jumlah-$item->qty;
                                    $jumlahs->save();
                                }
                            }
                        }
                
                        Cart::destroy();
                        return redirect()->route('checkout.konfirmasi',['id' => $new_order->id]);
                    }
                    else
                    {
                        Cart::destroy();
                        return redirect()->route('cart.index')->with('info','Gagal Beli');
                    }
                }
            }
        }
    }

    public function show(Request $request,$id)
    {   
        $order = \App\Tr_penjualan::findOrFail($id);
        return view('pembeli.detailtransaksi', ['order' => $order]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {   

        $no_resi=$request->get('resi');
        $status=$request->get('status');
        $selesai =$request->get('selesai');
        
        if(!empty($selesai))
        {
            $user = \App\Tr_penjualan::findOrFail($id);
            $user->status = 'Selesai';
            $user->save();
            return redirect()->route('checkout.index');
        }

        else
        {
            $user = \App\Tr_penjualan::findOrFail($id);
            $user->tanggal_bayar = $request->get('tanggal_bayar');
            $user->jam_bayar = $request->get('jam');
            $user->jumlah_bayar = $request->get('jumlah');
            $user->ke_rekening = $request->get('bank');
            $user->AN_pengirim = $request->get('AN');
    
            if($request->file('gambar1') != NULL)
            {
                if($user->bukti_bayar && file_exists(storage_path('app/public/' . $user->bukti_bayar)))
                {
                    \Storage::delete('public/'.$user->bukti_bayar); 
                }
                $gmbr = $request->file('gambar1');
                $file = $gmbr->store('buktis', 'public');
                $user->bukti_bayar = $file;
            }

            $user->status = 'Menunggu Konfirmasi';
            $user->save();
            return redirect()->route('checkout.index');
        }
       
    }

    public function destroy(Request $request,$id)
    {   
        $order = \App\Tr_penjualan::findOrFail($id);
        
        foreach($order->Detail_tr_penjualan as $detail)
        {   
            $temp = $detail->jumlah;
            $jumlahs = \App\Jumlah::where('pakaian_id', '=', $detail->pakaian_id)->where('size','=',$detail->size)->first();
            $jumlahs->jumlah = $jumlahs->jumlah + $temp;
            $jumlahs->save();
        }   

        $order->delete();
        return redirect()->route('checkout.index');
    }

    public function konfirmasipembayaran($id)
    {
        $order = \App\Tr_penjualan::findOrFail($id);

        $bank = \App\Rekening::all();
        return view('pembeli.konfirmasi',['orders' => $order])->with(['bank'=>$bank]);
    }
 
}
