<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wishlist;
use App\Pembeli;

class ShopController extends Controller
{
    public function tampilsemua(Request $request)
    {       
        $nama_kategori = 'Semua Produk';
        $group = $request->get('status');
        if(isset($group) && $group === 'diskon')
        {
            $bajus = \App\Baju::where('diskon','>',0)->paginate(25);
        }
        elseif(isset($group) && $group !== 'diskon')
        {  
            $nama_kategori = \App\Kategori::findOrFail($group);

            $bajus = \App\Baju::whereHas('kategori', function ($query) use($group) 
            {
               $query->where('kategori_id', '=', $group);
            })->paginate(25);
        }
        else
        {
            $bajus = \App\Baju::paginate(25);
        }
        
        $jumlahbaju = \App\Baju::count();
        $kategori = \App\Kategori::all();
        return view('shop.shop',['bajus' => $bajus],['kategori' => $kategori])->with(['nama_kategori' => $nama_kategori])->with(['jumlahbaju' => $jumlahbaju]);
    }

    public function detail($id)
    {   
        $user = 17;
        $baju = \App\Baju::findOrFail($id);
        $baju_all = \App\Baju::all();
        $kategori = \App\Kategori::all();

        
        $rekomendasi = $this->rekomendasi($user);

        $hasil = collect($rekomendasi)->sortBy('sim')->reverse()->toArray();

        return view('shop.detail', ['baju' => $baju],['kategoris'=>$kategori])->with(['hasil'=>$hasil])->with(['bajurekomendasi'=>$baju_all]);

    }

    public function home(Request $request)
    {
         return view('shop.home');
    }

    public function rekomendasi($id)
    {
        $pembeli = \App\Pembeli::findOrFail($id);
        $baju = \App\Baju::all();
        $rating = \App\Rating::all();
        $baju_rating = array();
        $baju_all = array();
        $baju_not_rating = array();
        $rekomendasi = array();

        foreach($pembeli->rating as $ratings)
        {
            $baju_rating[] = $ratings->baju_id;
        }

        foreach($baju as $bajus)
        {
            $baju_all[] = $bajus->id;
        }

        $baju_not_rating = array_diff($baju_all,$baju_rating);
        foreach($baju_not_rating as $baju_not_rating)
        {   
            $sim = 0;
            $sum_atas = 0;
            $sum_bawah = 0;
            foreach($rating as $ratings)
            {      
                if($baju_not_rating==$ratings->baju_id)
                {   
                    $nama_baju = \App\Baju::findOrFail($baju_not_rating);
                    $sim = $this->similarity_tunggal($id,$ratings->pembeli_id);
                    $sum_atas = $sum_atas + ($ratings->rating*$sim);
                    $sum_bawah = $sum_bawah + $sim;
                }
            }

            if($sum_atas!=0 && $sum_bawah!=0)
            {
                $rekomendasi[] = array('id'=>$baju_not_rating,'nama'=>$nama_baju->nama_baju,'sim'=>($sum_atas/$sum_bawah));
            }
        }

        return $rekomendasi;
    }

    public function similarity_tunggal($pembeli1,$pembeli2)
    {
        $person_1 = \App\Pembeli::findOrFail($pembeli1);
        $person_2 = \App\Pembeli::findOrFail($pembeli2);
        $similarity = 0;
                $sum = 0;
                $j = $this->jumlahsama($person_1,$person_2);
                    $i=0;
                    foreach($person_1->rating as $rating1)
                    {       
                        foreach($person_2->rating as $rating2)
                        {   
                            if($rating1->baju_id==$rating2->baju_id)
                            {   
                                $i=$i+1;
                                $sum=$sum+pow(($rating1->rating-$rating2->rating),2);
                            }
                        }
                    }
                    
                    if($i==$j)
                    {   
                        $similarity=1/(1+sqrt($sum));
                        $data[] = array($person_1->id,$person_2->id,$similarity);
                    }
            

        return $similarity;
    }

    public function jumlahsama($person1,$person2)
    {   
        $pembeli1 = \App\Pembeli::findOrFail($person1);
        $pembeli2 = \App\Pembeli::findOrFail($person2);
        $sum=0;
        foreach($pembeli1 as $person_1)
        {
            foreach($pembeli2 as $person_2)
            {
                if($person_1->id != $person_2->id)
                {
                    foreach($person_1->rating as $rating1)
                    {       
                        foreach($person_2->rating as $rating2)
                        {
                            if($rating1->baju_id==$rating2->baju_id)
                            {
                                $sum=$sum+1;
                            }
                        }
                    }
                }
            }
        }
        return $sum;
    }

}
