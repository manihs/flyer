<?php

namespace App\Http\Controllers;

use Illuminate\{
    Http\Request,
    Support\Facades\DB
};

use App\UserInterest;
use Auth;

class signupTwoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {    
        $user = Auth::user();

        $listdata = DB::table('activity_lists')
        ->join('sub_interests', 'activity_lists.did', '=', 'sub_interests.main')
        ->select('sub_interests.sub', 'activity_lists.did', 'sub_interests.did')
        ->get();
         
        $userinterest = DB::table('user_interests')->where('uid','=', $user->id)->get()->pluck('icode');
            
        $userinterest = $userinterest->toArray();
        return view('Interestform', compact('listdata','userinterest'));
    }

    public function fetch(Request $request)
    {
        if($request->get('query')){
            $user = Auth::user();

            $query = strtoupper($request->get('query'));
            $data = DB::table('activity_lists')
            ->join('sub_interests', 'activity_lists.did', '=', 'sub_interests.main')
            ->select('sub_interests.sub', 'activity_lists.did', 'sub_interests.did')
            ->where('contents', 'LIKE', $query.'%')->get();

            $userinterest = DB::table('user_interests')->where('uid','=', $user->id)->get()->pluck('icode');
            $userinterest = $userinterest->toArray();

            $output = '';
            foreach($data as $row){
                $output .= '<div class="card m-2" style="width: 9.4rem;">';
                $output .= '<img class="card-img-top" src="https://dummyimage.com/200x100/000/fff" alt="Card image cap">';
                $output .= '<div class="card-body">';
                $output .= '    <h5 class="card-title">'.$row->sub.'</h5>';
                if(in_array($row->did, $userinterest)){
                $output .= '    <div class="btn btn-primary Man-intra-de">Cancel<input type="hidden" value="'.$row->did.'"></div>';
                }else{
                $output .= '    <div class="btn btn-primary Man-intra">Select<input type="hidden" value="'.$row->did.'"></div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
            $output .= '';

            echo $output;
        }
    }
    public function all(Request $request)
    {
        $user = Auth::user();

        $data = DB::table('activity_lists')
        ->join('sub_interests', 'activity_lists.did', '=', 'sub_interests.main')
        ->select('sub_interests.sub', 'activity_lists.did', 'sub_interests.did')
        ->get();

        
        $userinterest = DB::table('user_interests')->where('uid','=', $user->id)->get()->pluck('icode');
        $userinterest = $userinterest->toArray();


        $output = '';
        foreach($data as $row){
            $output .= '<div class="card m-2" style="width: 9.4rem;">';
            $output .= '<img class="card-img-top" src="https://dummyimage.com/200x100/000/fff" alt="Card image cap">';
            $output .= '<div class="card-body">';
            $output .= '    <h5 class="card-title">'.$row->sub.'</h5>';
            if(in_array($row->did, $userinterest)){
                $output .= '    <div class="btn btn-primary Man-intra-de">Cancel<input type="hidden" value="'.$row->did.'"></div>';
            }else{
                $output .= '    <div class="btn btn-primary Man-intra">Select<input type="hidden" value="'.$row->did.'"></div>';
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

            $userinterest = new UserInterest;
            $userinterest->uid = $user->id;
            $userinterest->icode = $request->get('value');
            $userinterest->save();

            echo $request->get('value');
        }
    }

    public function remove(Request $request)
    {
        if($request->get('value')){
            $user = Auth::user();

            $userinterest = DB::table('user_interests')
            ->where('uid','=', $user->id)
            ->where('icode','=',$request->get("value"));
            $userinterest->delete();

            echo $request->get('value');
        }
    }
}
