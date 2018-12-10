<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function createcommunity(){
        return view('createcommunity');
    }
    function post_image_upload(){
        return view('image');
    }
    function post_video_upload(){
        return view('video');
    }
}
