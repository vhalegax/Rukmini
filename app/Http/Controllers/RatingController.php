<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function tambahrating($userid, $komentar, $rating, $bajuid)
    {
        $new_rating = new \App\Rating;
        $new_rating->rating = $rating;
        $new_rating->komentar = $komentar;
        $new_rating->pembeli_id = $userid;
        $new_rating->baju_id = $bajuid;
        $new_rating->save();

        $avg_rating = \App\Rating::avg('rating');
        return $avg_rating;
    }

    public function rating()
    {
        $pembeli2 = \App\Pembeli::all();
        $baju = \App\Baju::all();
        $baju2 = \App\Baju::all();
        $rating = \App\Rating::all()->groupBy('pembeli_id');
        return view('rating.rating', ['pembeli2' => $pembeli2])->with(['baju'=>$baju])->with(['rating'=>$rating])->with(['baju2'=>$baju2]);
    }

    public function similarity()
    {    
        $baju_i = \App\Baju::all();
        $baju_j = \App\Baju::all(); 
        $pembeli = \App\Rating::all()->groupBy('pembeli_id');
        return view('rating.similarity', ['pembeli'=>$pembeli])->with(['baju_i'=>$baju_i])->with(['baju_j'=>$baju_j]);
    }

    public function similarity2($id)
    {    
        $person_1 = \App\Pembeli::findOrFail($id);
        $pembeli2 = \App\Pembeli::all();
        $data = array();

            foreach($pembeli2 as $person_2)
            {   
                $sum = 0;
                $j = $this->jumlahsama($person_1,$person_2);
                if($person_1->id != $person_2->id)
                {   
                    $i=0;
                    $hasil=0;
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
                        $data[] = array($person_1->nama_lengkap,$person_2->nama_lengkap,$similarity);
                    }
                }
            }

        $temp = \App\Temp::all();
        // return dd($data);
        return view('rating.similarity2', ['temp'=>$temp])->with(['pembeli2'=>$pembeli2])->with(['data'=>$data]);
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
