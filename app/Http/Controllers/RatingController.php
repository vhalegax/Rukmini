<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        //
    }

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
}
