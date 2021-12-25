<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForeignTechician;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class ForeignTechicianController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        // dd(Auth::user()->profile->id);
        $playlists = ForeignTechician::where('profile_id',Auth::user()->profile->id)->get();
        return View('foreign_technician', compact('playlists'));
        // return view('foreign_technician');
    }

    public function create()
    {
        return view('foreign_tech_create');
    }


    public function store(Request $request)
    {
    	// dd($request->all());
        $foreign_tech = ForeignTechician::create($request->all());

        if ($request->hasfile('Image')) {
            $profile = $request->file('Image');
            $upload_path =public_path().'/foreign_tech_photo/';
            $name = $foreign_tech->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/foreign_tech_photo/'.$name;
        }else{
            $att= "";
        }

        $foreign_tech->update(['Status'=>1]);
        $foreign_tech->update(['Image'=>$att]);

        Toastr::success('Foreign Techician created!');

        return redirect()->route('FT.show');

    }

    public function edit($id)
    {
        $playlist = ForeignTechician::Find($id);
        return view('foreign_tech_edit',compact('playlist'));
    }

    public function update($id,Request $request)
    {
    	// dd($request->all());
    	// dd($request->hasfile('Image'));

        $foreign_tech = ForeignTechician::Find($id);

        /*if ($request->hasfile('Image')) {
            $profile = $request->file('Image');
            $upload_path =public_path().'/foreign_tech_photo/';
            $name = $foreign_tech->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/foreign_tech_photo/'.$name;
        }else{
            $att= request('old_att');
        }*/

        // dd($request->file('Image'));

        $foreign_tech->update($request->all());

        /*if (!is_null($request->Image)) {
                $file_old = public_path() . $foreign_tech->Image;
                unlink($file_old);

                $foreign_tech->update(['Image'=>$att]);
            }else{
                $foreign_tech->update(['Image'=>$att]);
            }*/

            Toastr::success('Foreign Techician updated!');

        return redirect()->route('FT.show'); 
    }

     public function delete($id)
    {
        $playlist = ForeignTechician::findOrFail($id);
        // dd($playlist);
        $file = public_path() . $playlist->Image;
        unlink($file);
        
        $playlist->delete();

        Toastr::success('Foreign Techician deleted!');

        return redirect()->route('FT.show');
    }


}
