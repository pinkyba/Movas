<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisaApplicationHead;
use Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified','userstatus']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $u_id = Auth::user()->id;
        // dd($user_id);

        $validation = Validator::make($request->all(), [
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after:from_date',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        if (is_null($request->status) && is_null($request->from_date) && is_null($request->to_date)) {
             $visa_heads= VisaApplicationHead::where('user_id',$u_id)->orderBy('created_at', 'desc')->paginate(20);

            return view('home',compact('visa_heads'));
        }
        if (!is_null($request->status) && !is_null($request->from_date) && !is_null($request->to_date)) {
            // dd('here 1');
            $status = $request->status;
       $from_date = $request->from_date;
       $to_date = $request->to_date;
           $visa_heads = VisaApplicationHead::where(function ($query) use ($u_id,$status) {
                $query->where([
                            ['user_id',$u_id],
                            ['Status', $status],
                        ]);
            })->where(function($query) use ($from_date,$to_date) {
                $query->whereBetween('FirstApplyDate', [$from_date, $to_date]);

            })->orderBy('created_at', 'desc')->paginate(20);
           

            return view('home',compact('visa_heads'));
        }
       if (!is_null($request->from_date) || !is_null($request->to_date)) {
        // dd('here 2');
             $visa_heads= VisaApplicationHead::where([
                            ['user_id',$u_id],
                        ])->whereBetween('FirstApplyDate', [$request->from_date, $request->to_date])->orderBy('created_at', 'desc')->paginate(20);

            return view('home',compact('visa_heads'));
       }
       if (!is_null($request->status)) {
        // dd('here 3');
         $visa_heads= VisaApplicationHead::where([
                            ['user_id',$u_id],
                            ['Status', $request->status],
                        ])->orderBy('created_at', 'desc')->paginate(20);
         
            return view('home',compact('visa_heads'));
       }
    }
}
