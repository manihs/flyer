<?php

namespace App\Http\Controllers;

use Illuminate\{
    Http\Request,
    Support\Facades\DB
};

use App\userCommunity;
use App\UserInterest;
use Auth;

class SignUpCommunityJoin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {    
        $user = Auth::user();

        $userinterest = DB::table('user_interests')->where('uid','=', $user->id)->get()->pluck('icode');            
        $userinterest = $userinterest->toArray();        
        
        $community = DB::table('user_communities')->where('user','=', $user->id)->get()->pluck('community');
        $community = $community->toArray();

        $listdata = DB::table('communities')
        ->whereIn('category',  $userinterest)
        ->orWhereIn('subc',  $userinterest)
        ->get();

        return view('scommunity', compact('listdata','community'));
    }

    public function fetch(Request $request)
    {

    }
    public function all(Request $request)
    {
        $user = Auth::user();
        
        $userinterest = DB::table('user_interests')->where('uid','=', $user->id)->get()->pluck('icode');            
        $userinterest = $userinterest->toArray();        
        
        $community = DB::table('user_communities')->where('user','=', $user->id)->get()->pluck('community');
        $community = $community->toArray();

        $listdata = DB::table('communities')
        ->whereIn('category',  $userinterest)
        ->orWhereIn('subc',  $userinterest)
        ->get();       

        $output = '';
        foreach($listdata as $row){
            $output .= '<div class="card m-2" style="width: 9.4rem;">';
            $output .= '<img class="card-img-top" src="https://dummyimage.com/200x100/000/fff" alt="Card image cap">';
            $output .= '<div class="card-body">';
            $output .= '    <h5 class="card-title">'.$row->name.'</h5>';
            if(in_array($row->subc, $community)){
                $output .= '    <div class="btn btn-primary Man-intra-de">Cancel<input type="hidden" value="'.$row->id.'"></div>';
            }else{
                $output .= '    <div class="btn btn-primary Man-intra">Select<input type="hidden" value="'.$row->id.'"></div>';
            }
            $output .= '</div>';
            $output .= '</div>';
        }
        $output .= '';

        echo $output;
    }

    public function add(Request $request)
    {
        if($request->get('value')){
            $user = Auth::user();
            $UserInterest = new userCommunity;
            $UserInterest->user = $user->id;
            $UserInterest->community = $request->get('value');
            $UserInterest->save();
       
            echo $request->get('value');
        }
    }

    public function remove(Request $request)
    {
        if($request->get('value')){
            $user = Auth::user();
            $UserInterest = DB::table('user_communities')
            ->where('user','=', $user->id)
            ->where('community','=',$request->get("value"));
            $UserInterest->delete();

            echo $request->get('value');
        }
    }
}
