<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPKPembeliController extends Controller
{
    public function index()
    {
        $pembeli = \App\Pembeli::all();
        return view('spk_pembeli.index', ['pembeli' => $pembeli]);
    }

    public function similarity($id)
    {    
        $person_1 = \App\Pembeli::findOrFail($id);
        $pembeli = \App\Pembeli::all();
        $data = array();

            foreach($pembeli as $person_2)
            {   
                $sum = 0;
                $j = $this->jumlahsama($person_1,$person_2);
                if($person_1->id != $person_2->id)
                {   
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
                }
            }

        return view('spk_pembeli.similarity',['data'=>$data])->with(['id'=>$id]);
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
            $rekomendasi[] = array($baju_not_rating,$nama_baju->nama_baju,($sum_atas/$sum_bawah));
        }

        return view('spk_pembeli.rekomendasi',['id'=>$id])->with(['rekomendasi'=>$rekomendasi]);
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
