<?php

namespace App\Http\Controllers;

use Illuminate\{
    Http\Request,
    Support\Facades\DB
};

use App\{
    Community,
    userCommunity
};
use Auth;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();
        if (request()->hasFile('img')) {
        $file = request()->file('img');
            if($file->move('./uploads', 'demo.jpg')){
                $Community = new Community;
                $Community->name = $input['name'];
                $Community->category = $input['category'];
                $Community->subc = $input['scategory'];
                $Community->url = '/upload/demo.jpg';
                $Community->save();

                $user = Auth::user();
                dd($user);
                $UserInterest = new userCommunity;
                $UserInterest->user = $user->id;
                $UserInterest->community = $Community->id;
                $UserInterest->save();
            }
        }
        return 'creating community';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listsubcategory(Request $request)
    {
       if($request->get('value')){
        $inputselect = DB::table('sub_interests')
        ->where('main','=', $request->get('value'))
        ->get()->pluck('did','sub');
        $inputselect = $inputselect->toArray();
        $inputselect = json_encode($inputselect);
        echo $inputselect;
       }
        
    }
}
