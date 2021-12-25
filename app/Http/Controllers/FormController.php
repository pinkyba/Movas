<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\VisaApplicationHead;
use App\Models\Rank;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\VisaApplicationDetail;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  

    public function approvedForm(Request $request)
    {
        $tmp= DB::table('visa_application_heads')
                ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                ->where('visa_application_heads.Status', 1);

        if (Auth::user()->rank_id == 7) {
            // OSS Immi     gration
            $tmp->where(function($query) {$query->whereIn('OssStatus', [1,3]);});
        } elseif (Auth::user()->rank_id == 6) {
            // OSS Labour
            $tmp->where(function($query) {$query->whereIn('OssStatus', [2,3]);});
        }

        if (!is_null($request->name)) {
            $tmp->where('profiles.CompanyName', 'like', '%'.$request->name.'%');
        }
        if (!is_null($request->from_date) || !is_null($request->to_date)) {
            $tmp->whereBetween('visa_application_heads.ApproveDate', [$request->from_date, $request->to_date]);
        }

        $visa_heads = $tmp->orderBy('created_at', 'desc')->paginate(100);

    	$sectors = Sector::all();
    	return view('admin.approvedform',compact('sectors','visa_heads'));
    }

    public function showAppForm($id)
    {
    	$ranks = Rank::all();
    	$data = VisaApplicationHead::findOrFail($id);
                $approve_no = $data->ApproveLetterNo;

                $approve_letter_no = Str::substr($approve_no, 6, -1);
                $approve_year = Str::substr($approve_no, 0, -8);
        // dd($year);

        $remarks = DB::table('remarks')
                        // ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('admins as a1', 'remarks.FromAdminID', '=', 'a1.id')
                        ->join('admins as a2', 'remarks.ToAdminID', '=', 'a2.id')
                        ->join('ranks as r1', 'remarks.FromRankID', '=', 'r1.id')
                        ->join('ranks as r2', 'remarks.ToRankID', '=', 'r2.id')
                        ->select('remarks.*', 'a1.username as a1_name','a2.username as a2_name','r1.RankNameMM as r1_name','r2.RankNameMM as r2_name')
                        ->where([
                            ['remarks.visa_application_head_id',$data->id],
                            // ['SubmittedStatus', '!=', 1],
                        ])
                        ->get();

    	$total_local = $data->profile->StaffLocalProposal + $data->profile->StaffLocalSurplus;
        $total_foreign = $data->profile->StaffForeignProposal + $data->profile->StaffForeignSurplus;

        $available_local = $total_local - $data->profile->StaffLocalAppointed;
        $available_foreign = $total_foreign - $data->profile->StaffForeignAppointed;

        $rr =Auth::user()->rank_id;
        // dd($rr);
        if ($rr == 1) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 1],
                        ])->get();
        }
        if ($rr == 2) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 2],
                        ])->get();
        }
        if ($rr == 3) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 3],
                        ])->get();
        }
        if ($rr == 4) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 4],
                        ])->get();
        }
        if ($rr == 5) {
            $admins = [];
        }
        if ($rr == 6) {
            $admins = [];
        }
        if ($rr == 7) {
            $admins = [];
        }
    	
    	
    	// dd($data);
    	return view('admin.appFormDetail',compact('data','ranks','admins','total_local','total_foreign','available_local','available_foreign','remarks','approve_letter_no','approve_year'));
    }

    public function showPrintForm($id)
    {
        $ranks = Rank::all();
        $data = VisaApplicationHead::findOrFail($id);
                $approve_no = $data->ApproveLetterNo;

                $approve_letter_no = Str::substr($approve_no, 6, -1);
                $approve_year = Str::substr($approve_no, 0, -8);
        // dd($year);

        $remarks = DB::table('remarks')
                        // ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('admins as a1', 'remarks.FromAdminID', '=', 'a1.id')
                        ->join('admins as a2', 'remarks.ToAdminID', '=', 'a2.id')
                        ->join('ranks as r1', 'remarks.FromRankID', '=', 'r1.id')
                        ->join('ranks as r2', 'remarks.ToRankID', '=', 'r2.id')
                        ->select('remarks.*', 'a1.username as a1_name','a2.username as a2_name','r1.RankNameMM as r1_name','r2.RankNameMM as r2_name')
                        ->where([
                            ['remarks.visa_application_head_id',$data->id],
                            // ['SubmittedStatus', '!=', 1],
                        ])
                        ->get();

        $total_local = $data->StaffLocalProposal + $data->StaffLocalSurplus;
        $total_foreign = $data->StaffForeignProposal + $data->StaffForeignSurplus;

        $available_local = $total_local - $data->StaffLocalAppointed;
        $available_foreign = $total_foreign - $data->StaffForeignAppointed;

        $rr =Auth::user()->rank_id;
        // dd($rr);
        if ($rr == 1) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 1],
                        ])->get();
        }
        if ($rr == 2) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 2],
                        ])->get();
        }
        if ($rr == 3) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 3],
                        ])->get();
        }
        if ($rr == 4) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 4],
                        ])->get();
        }
        if ($rr == 5) {
            $admins = [];
        }
        if ($rr == 6) {
            $admins = [];
        }
        if ($rr == 7) {
            $admins = [];
        }
        
        
        // dd($data);
        return view('admin.PrintFormDetail',compact('data','ranks','admins','total_local','total_foreign','available_local','available_foreign','remarks','approve_letter_no','approve_year'));
    }

    public function rejectedForm(Request $request)
    {
    	if (is_null($request->name)) {
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->where('visa_application_heads.Status', 2)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }else{
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->where([
                                            ['visa_application_heads.Status','=',2],
                                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                                        ])
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }
    	$sectors = Sector::all();
    	return view('admin.rejectedform',compact('sectors','visa_heads'));
    }

    public function showRejForm($id)
    {
        $ranks = Rank::all();
        $data = VisaApplicationHead::findOrFail($id);

        $remarks = DB::table('remarks')
                        // ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('admins as a1', 'remarks.FromAdminID', '=', 'a1.id')
                        ->join('admins as a2', 'remarks.ToAdminID', '=', 'a2.id')
                        ->join('ranks as r1', 'remarks.FromRankID', '=', 'r1.id')
                        ->join('ranks as r2', 'remarks.ToRankID', '=', 'r2.id')
                        ->select('remarks.*', 'a1.username as a1_name','a2.username as a2_name','r1.RankNameMM as r1_name','r2.RankNameMM as r2_name')
                        ->where([
                            ['remarks.visa_application_head_id',$data->id],
                            // ['SubmittedStatus', '!=', 1],
                        ])
                        ->get();

        $total_local = $data->profile->StaffLocalProposal + $data->profile->StaffLocalSurplus;
        $total_foreign = $data->profile->StaffForeignProposal + $data->profile->StaffForeignSurplus;

        $available_local = $total_local - $data->profile->StaffLocalAppointed;
        $available_foreign = $total_foreign - $data->profile->StaffForeignAppointed;

        $rr =Auth::user()->rank_id;
        // dd($rr);
        if ($rr == 1) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 1],
                        ])->get();
        }
        if ($rr == 2) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 2],
                        ])->get();
        }
        if ($rr == 3) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 3],
                        ])->get();
        }
        if ($rr == 4) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 4],
                        ])->get();
        }
        if ($rr == 5) {
            $admins = [];
        }
        if ($rr == 6) {
            $admins = [];
        }
        if ($rr == 7) {
            $admins = [];
        }
        
        
        // dd($data);
        return view('admin.rejectedFormDetail',compact('data','ranks','admins','total_local','total_foreign','available_local','available_foreign','remarks'));
    }

    public function turnDownForm(Request $request)
    {
        if (is_null($request->name)) {
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->where('visa_application_heads.Status', 3)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }else{
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->where([
                                            ['visa_application_heads.Status','=',3],
                                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                                        ])
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }
        $sectors = Sector::all();
        return view('admin.turndownform',compact('sectors','visa_heads'));
    }


   

    public function showturnDownForm($id)
    {
        $ranks = Rank::all();
        $data = VisaApplicationHead::findOrFail($id);

        $applicants = $data->visa_details;

        // $remarks = Remark::where('visa_application_head_id',$data->id)->get();
        $remarks = DB::table('remarks')
                        // ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('admins as a1', 'remarks.FromAdminID', '=', 'a1.id')
                        ->join('admins as a2', 'remarks.ToAdminID', '=', 'a2.id')
                        ->join('ranks as r1', 'remarks.FromRankID', '=', 'r1.id')
                        ->join('ranks as r2', 'remarks.ToRankID', '=', 'r2.id')
                        ->select('remarks.*', 'a1.username as a1_name','a2.username as a2_name','r1.RankNameMM as r1_name','r2.RankNameMM as r2_name')
                        ->where([
                            ['remarks.visa_application_head_id',$data->id],
                            // ['SubmittedStatus', '!=', 1],
                        ])
                        ->get();

        // dd($remarks);
        // foreach ($applicants as $value) {
        //  dd($value->stay_type);
        // }

        $total_local = $data->profile->StaffLocalProposal + $data->profile->StaffLocalSurplus;
        $total_foreign = $data->profile->StaffForeignProposal + $data->profile->StaffForeignSurplus;

        $available_local = $total_local - $data->profile->StaffLocalAppointed;
        $available_foreign = $total_foreign - $data->profile->StaffForeignAppointed;

        $rr =Auth::user()->rank_id;
        // dd($rr);
        if ($rr == 1) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 1],
                        ])->get();
        }
        if ($rr == 2) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 2],
                        ])->get();
        }
        if ($rr == 3) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 3],
                        ])->get();
        }
        if ($rr == 4) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 4],
                        ])->get();
        }
        if ($rr == 5) {
            $admins = [];
        }
        if ($rr == 6) {
            $admins = [];
        }
        if ($rr == 7) {
            $admins = [];
        }
        
        
        // dd($data);
        return view('admin.turndownFormDetail',compact('data','ranks','admins','total_local','total_foreign','available_local','available_foreign','remarks'));
    }

    public function inProcessForm(Request $request)
    {
        if (is_null($request->name)) {
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->whereIn('visa_application_heads.Status', [0,3])
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }else{
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->whereIn('visa_application_heads.Status', [0,3])
                        ->where([
                                            // ['visa_application_heads.Status','=',0],
                                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                                        ])
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }
        $sectors = Sector::all();

        // dd($visa_heads);
        return view('admin.inprocessform',compact('sectors','visa_heads'));
    }

    public function showinProcessForm($id)
    {
        $ranks = Rank::all();
        $data = VisaApplicationHead::findOrFail($id);

        $applicants = $data->visa_details;

        // $remarks = Remark::where('visa_application_head_id',$data->id)->get();
        $remarks = DB::table('remarks')
                        // ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('admins as a1', 'remarks.FromAdminID', '=', 'a1.id')
                        ->join('admins as a2', 'remarks.ToAdminID', '=', 'a2.id')
                        ->join('ranks as r1', 'remarks.FromRankID', '=', 'r1.id')
                        ->join('ranks as r2', 'remarks.ToRankID', '=', 'r2.id')
                        ->select('remarks.*', 'a1.username as a1_name','a2.username as a2_name','r1.RankNameMM as r1_name','r2.RankNameMM as r2_name')
                        ->where([
                            ['remarks.visa_application_head_id',$data->id],
                            // ['SubmittedStatus', '!=', 1],
                        ])
                        ->get();

        // dd($remarks);
        // foreach ($applicants as $value) {
        //  dd($value->stay_type);
        // }

        $total_local = $data->profile->StaffLocalProposal + $data->profile->StaffLocalSurplus;
        $total_foreign = $data->profile->StaffForeignProposal + $data->profile->StaffForeignSurplus;

        $available_local = $total_local - $data->profile->StaffLocalAppointed;
        $available_foreign = $total_foreign - $data->profile->StaffForeignAppointed;

        $rr =Auth::user()->rank_id;
        // dd($rr);
        if ($rr == 1) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 1],
                        ])->get();
        }
        if ($rr == 2) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 2],
                        ])->get();
        }
        if ($rr == 3) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 3],
                        ])->get();
        }
        if ($rr == 4) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 4],
                        ])->get();
        }
        if ($rr == 5) {
            $admins = [];
        }
        if ($rr == 6) {
            $admins = [];
        }
        if ($rr == 7) {
            $admins = [];
        }
        
        
        // dd($data);
        return view('admin.inprocessFormDetail',compact('data','ranks','admins','total_local','total_foreign','available_local','available_foreign','remarks'));
    }

    public function outBoxForm(Request $request)
    {
        if (is_null($request->name)) {
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->leftjoin('remarks', 'visa_application_heads.id', '=', 'remarks.visa_application_head_id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName','remarks.FromAdminID')
                        ->where([
                            ['visa_application_heads.Status',0],
                            ['remarks.FromAdminID', Auth::user()->id],
                        ])->distinct()
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }else{
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->leftjoin('remarks', 'visa_application_heads.id', '=', 'remarks.visa_application_head_id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName','remarks.FromAdminID')
                        ->where([
                                            ['visa_application_heads.Status','=',0],
                                            ['remarks.FromAdminID','=',Auth::user()->id],
                                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                                        ])->distinct()
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
        }
        $sectors = Sector::all();

        // dd($visa_heads);
        return view('admin.outboxform',compact('sectors','visa_heads'));
    }


    



   
    // public function reportForm(Request $request)
    // {

    //     $showreport = DB::table('visa_application_details')
    //     ->join('visa_application_heads', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
    //     ->join('nationalities', 'visa_application_details.nationality_id', '=', 'nationalities.id')
    //     ->join('visa_types', 'visa_application_details.visa_type_id', '=', 'visa_types.id')
    //     ->join('stay_types', 'visa_application_details.stay_type_id', '=', 'stay_types.id')
    //     ->join('person_types', 'visa_application_details.person_type_id', '=', 'person_types.id')
    //     ->join('relation_ships', 'visa_application_details.relation_ship_id', '=', 'relation_ships.id')
    //     ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
    //     ->select('visa_application_details.*','nationalities.NationalityName','visa_types.VisaTypeNameMM','stay_types.StayTypeNameMM','person_types.PersonTypeNameMM','relation_ships.RelationShipNameMM','profiles.CompanyName')
    //     ->get();

    //     return view('admin.reportandexport',compact('showreport'));
    // }
    
}
