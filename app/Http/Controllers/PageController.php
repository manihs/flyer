<?php

namespace App\Http\Controllers;

use Illuminate\{
    Http\Request,
    Support\Facades\DB
};
use auth;

class PageController extends Controller
{
    function createcommunity(){
        return view('createcommunity');
    }
    function post_image_upload(){

        $user = Auth::user();

        $community = DB::table('user_communities')
        ->select('user_communities.community','user_communities.did','communities.name')
        ->join('communities', 'communities.id', '=', 'user_communities.community')
        ->where('user','=', $user->id)->get();
        return view('image', compact('community'));
        
    }
    function post_video_upload(){

        $user = Auth::user();
        
        $community = DB::table('user_communities')
        ->select('user_communities.community','user_communities.did','communities.name')
        ->join('communities', 'communities.id', '=', 'user_communities.community')
        ->where('user','=', $user->id)->get();

        return view('video', compact('community'));
    }
}
