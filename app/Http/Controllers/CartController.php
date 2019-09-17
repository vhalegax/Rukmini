<?php

namespace App\Http\Controllers;

use App\Baju;
use App\City;
use App\Province;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Steevenz\Rajaongkir;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $provinsi = \App\Province::all();
        if(Auth::guard('pembeli')->user())
        {   
            $id = Auth::guard('pembeli')->user()->id;
            $alamat = \App\Pembeli::findOrFail($id);
            return view('pembeli.belanjaan', ['provinci'=>$provinsi] , ['alamat'=>$alamat]);
        }
        else
        {
            return view('pembeli.belanjaan', ['provinci'=>$provinsi]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request)
        {
            return $cartItem->id == $request->id;
        });

        $duplicates2 = Cart::search(function ($cartItem, $rowId) use ($request)
        {
            return $cartItem->options->size == $request->size;
        });

        if ($duplicates->isNotEmpty() and  $duplicates2->isNotEmpty())
        {
            return redirect()->route('cart.index')->with('status', 'Barang Sudah Ada di Belanjaan!');
        }

        Cart::add($request->id, $request->nama,$request->jumlah, $request->harga,['size' => $request->size])
            ->associate('App\Baju');

        return redirect()->route('cart.index')->with('status', 'Barang Berhasil Ditambahkan!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('status', 'Item has been removed!');
    }


    public function city($id)
    {
        $city = City::where("id_province","=",$id)->pluck("name","id");
        return json_encode($city);
    }

    public function cekongkir2($v1,$v2,$v3,$v4)
    {
        $client = new Client();

        try
        {
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
            [
                'body'=>'origin='.$v1.'&destination='.$v2.'&weight='.$v3.'&courier='.$v4,
                'headers'=>[
                    'key'=>'19ba42a4f5d1a940e88092d6c2319b2b',
                    'content-type'=>'application/x-www-form-urlencoded',
                ]
            ]);
        }

        catch(RequestException $e)
        {
            var_dump($e->getResponse()->getBody()->getContents());
        }

           $json = $response->getBody()->getContents();
           $array_result = json_decode($json,true);

        return $array_result;
    }

    
    public function tambahbelanjaan($id)
    {
        $row=Cart::get($id);
        $baju = \App\Baju::findOrFail($row->id);
        foreach($baju->jumlah as $jumlahs)
        {
            if($jumlahs->size==$row->options->size)
            {
                if($jumlahs->jumlah<($row->qty+1))
                {
                    $data = array(
                        "stokkurang"=> "1");
                    return json_encode($data);
                }
                else
                {
                    Cart::update($id,($row->qty+1));
                    $row=Cart::get($id);
                    $total=Cart::total(0);
                    $jumlahbelanjaan=Cart::count();
                    $data = array(
                        "jumlah"=> $row->qty, "subtotal"=>$row->qty*$row->price, "total"=>$total, "jumlahbelanjaan"=>$jumlahbelanjaan);
                    return json_encode($data);
                }
            }
        }
    }

    public function kurangbelanjaan($id)
    {
        $row=Cart::get($id);

        Cart::update($id,($row->qty-1));
        
        $row=Cart::get($id);
        $total=Cart::total(0);
        $jumlahbelanjaan=Cart::count();
        $data = array(
            "jumlah"=> $row->qty, "subtotal"=>$row->qty*$row->price , "total"=>$total, "jumlahbelanjaan"=>$jumlahbelanjaan);
        return json_encode($data);
    }

    public function cekkupon($kupon,$subtotal)
    {
        $kupon1= \App\Kupon::where('kode',$kupon)->where('status','aktif')->get();
        if(!$kupon1->isEmpty())
        {
            foreach($kupon1 as $kupon1)
            {
                if($subtotal<$kupon1->minimalpembelian)
                {   
                    $data = array("info"=>"ada","status"=>"Minimal Pembelian Kurang");
                }
                elseif(($kupon1->jumlah) <= 0)
                {
                    $data = array("info"=>"ada","status"=>"Kupon Sudah Melebihi Kouta");
                }
                elseif(strtotime($kupon1->masa_berlaku) < strtotime('now'))
                {
                    $data = array("info"=>"ada","status"=>"Masa Berlaku Kupon Sudah Habis");
                }
                else
                {
                    $data = array("info"=>"ada","status"=>null,"potongan"=>$kupon1->potongan);
                }
            }

            return json_encode($data);
        }
        else
        {
            $data = array("info"=>"tidakada","1"=>$kupon1);
            return json_encode($data);
        }
    }

    /**---------------------------------------------------------------------------------- */

    public function getprovince()
    {
        $client = new Client();

        try
        {
            $response = $client->get('https://api.rajaongkir.com/starter/province',
            array(
                'headers' => array(
                    'key' => '19ba42a4f5d1a940e88092d6c2319b2b',
                    )
                ));
        }
        catch(RequestException $e)
        {
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        for($i=0;$i<count($array_result["rajaongkir"]["results"]); $i++)
        {
            $province = new \App\Province;
            $province->id = $array_result["rajaongkir"]["results"][$i]["province_id"];
            $province->name = $array_result["rajaongkir"]["results"][$i]["province"];
            $province->save();
        }
    }

    public function getcity()
    {
        $client = new Client();

        try
        {
            $response = $client->get('https://api.rajaongkir.com/starter/city',
            array(
                'headers' => array(
                    'key' => '19ba42a4f5d1a940e88092d6c2319b2b',
                    )
                ));
        }
        catch(RequestException $e)
        {
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        for($i=0;$i<count($array_result["rajaongkir"]["results"]); $i++)
        {
            $city = new \App\City;
            $city->id = $array_result["rajaongkir"]["results"][$i]["city_id"];
            $city->name = $array_result["rajaongkir"]["results"][$i]["city_name"];
            $city->id_province = $array_result["rajaongkir"]["results"][$i]["province_id"];
            $city->save();
        }
    }

    // -----------------------------------------------------------

    public function belajarajax(Request $request)
    {
        if($request->inputan==="tmbah")
        {
            $data= $request->jumlah+1;
            return json_encode($data);
        }

        elseif($request->inputan==="krng")
        {
            $data= $request->jumlah-1;
            return json_encode($data);
        }
    }

    public function cobaongkir()
    {
        $origin="501";
        $destination="114";
        $weight=1700;
        $courier="jne";
        $client = new Client();
        try
        {
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
            [
                'body'=>'origin='.$origin.'&destination='.$destination.'&weight='.$weight.'&courier='.$courier,
                'headers'=>[
                    'key'=>'19ba42a4f5d1a940e88092d6c2319b2b',
                    'content-type'=>'application/x-www-form-urlencoded',
                ]
            ]);
        }
        catch(RequestException $e)
        {
            var_dump($e->getResponse()->getBody()->getContents());
        }
    
           $json = $response->getBody()->getContents();
           $array_result = json_decode($json,true);
    
        return $array_result;
    
    }

    public function cekcart()
    {
        $cart = Cart::content();
        return $cart;
    }

}
