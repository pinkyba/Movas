<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Rank;
use App\Models\Admin;
use App\Models\User;
use App\Models\PersonType;
use App\Models\Nationality;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Models\VisaApplicationHead;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;


class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','superadmin']);
    }

    public function dashboard()
    {
        //UserCount
         $daily = User::whereDate('created_at', Carbon::today())->get()->count();
        $yesterday = User::whereDate('created_at', Carbon::today()->subDays(1))->get()->count();
        $weekly = User::where('created_at','>=',Carbon::today()->subDays(7))->count();
        $monthly = User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get()->count();

        $increased = $daily-$yesterday;

        $daily_profile_completed = User::whereDate('created_at', Carbon::today())
                                        ->where('Status', 2)
                                        ->get()
                                        ->count();

        $weekly_profile_completed = User::whereDate('created_at', Carbon::today()->subDays(7))
                                        ->where('Status', 2)
                                        ->get()
                                        ->count();

        $monthly_profile_completed = User::whereMonth('created_at', now()->month)
                                        ->where('Status', 2)
                                        ->get()
                                        ->count();

        $total_profile_completed = User::where('Status', 2)->count();
        $total = User::count();
        // dd($monthly_profile_completed);
        $percent_weekly = $weekly_profile_completed / $total * 100;
        $percent_monthly = $monthly_profile_completed / $total * 100;
        $percent_total = $total_profile_completed / $total * 100;

        //UserChart
        $users = User::select('id', 'created_at')
            ->whereYear('created_at', now()->year)
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });
            // dd($users);
            $usermcount = [];
            $userArr = [];

            foreach ($users as $key => $value) {
                $usermcount[(int)$key] = count($value);
            }

            for($i = 0; $i <= 12; $i++){
                if(!empty($usermcount[$i])){
                    $userArr[$i] = $usermcount[$i];    
                }else{
                    $userArr[$i] = 0;    
                }
            }

        //VisaCount
            $daily_visa = VisaApplicationHead::whereDate('created_at', Carbon::today())->get()->count();
        $weekly_visa = VisaApplicationHead::where('created_at','>=',Carbon::today()->subDays(7))->count();
        $monthly_visa = VisaApplicationHead::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get()->count();

        $daily_visa_a = VisaApplicationHead::whereDate('ApproveDate', Carbon::today())->where('Status', 1)->get()->count();
        $weekly_visa_a = VisaApplicationHead::where('ApproveDate','>=',Carbon::today()->subDays(7))->where('Status', 1)->count();
        $monthly_visa_a = VisaApplicationHead::whereMonth('ApproveDate', now()->month)->whereYear('ApproveDate', now()->year)->where('Status', 1)->get()->count();

        $daily_visa_r = VisaApplicationHead::whereDate('RejectedDate', Carbon::today())->where('Status', 2)->get()->count();
        $weekly_visa_r = VisaApplicationHead::where('RejectedDate','>=',Carbon::today()->subDays(7))->where('Status', 2)->count();
        $monthly_visa_r = VisaApplicationHead::whereMonth('RejectedDate', now()->month)->whereYear('RejectedDate', now()->year)->where('Status', 2)->get()->count();

        $total_visa = VisaApplicationHead::count();

        $approved_visa = VisaApplicationHead::where('Status', 1)->count();
        $rejected_visa = VisaApplicationHead::where('Status', 2)->count();
        $inprogress_visa = VisaApplicationHead::whereIn('Status', [0,3])->count();

        return view('admin.dash', compact('percent_weekly','percent_monthly','percent_total','increased','daily','weekly','monthly','userArr','total','daily_visa','weekly_visa','monthly_visa','total_visa','approved_visa','rejected_visa','inprogress_visa','daily_visa_a','weekly_visa_a','monthly_visa_a','daily_visa_r','weekly_visa_r','monthly_visa_r'));
    }

    public function index(Request $request)
    {

    	$sectors = Sector::all();

        $admin_id = Auth::user()->id;
        // dd($admin_id);
        if (Auth::user()->rank_id == 1) {

            if (is_null($request->name)) {
                $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->where('visa_application_heads.Status', 0)
                                        ->whereNull('visa_application_heads.ReviewerSubmitted')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
            }else {
                $visa_heads=DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                                        ->where([
                                            ['visa_application_heads.Status','=',0],
                                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                                        ])
                                        ->whereNull('visa_application_heads.ReviewerSubmitted')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
            }
             

                                        // dd($visa_heads);
        }else{

            if (is_null($request->name)) {
                $visa_heads= DB::table('remarks')
                        ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('remarks.*', 'profiles.CompanyName','visa_application_heads.FirstApplyDate','visa_application_heads.FinalApplyDate','visa_application_heads.Status','visa_application_heads.Subject','sectors.SectorName','visa_application_heads.id as visa_head_id')
                        ->where([
                            ['remarks.ToAdminID','=',$admin_id],
                            ['remarks.SubmittedStatus', '!=', 1],
                            ['visa_application_heads.Status', '=', 0],
                        ])
                        ->orderby('created_at','desc')
                        ->paginate(20);
            }else{
                 $visa_heads= DB::table('remarks')
                        ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('remarks.*', 'profiles.CompanyName','visa_application_heads.FirstApplyDate','visa_application_heads.FinalApplyDate','visa_application_heads.Status','visa_application_heads.Subject','sectors.SectorName','visa_application_heads.id as visa_head_id')
                        ->where([
                            ['remarks.ToAdminID','=',$admin_id],
                            ['remarks.SubmittedStatus', '!=', 1],
                            ['visa_application_heads.Status', '=', 0],
                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                        ])
                        ->orderby('created_at','desc')
                        ->paginate(20);
            }
            
        }
       
    	return view('admin.inbox',compact('sectors','visa_heads'));
    }

    public function noteSheet()
    {
        $ranks = Rank::all();
        return view('admin.notesheet',compact('ranks'));
    }

    public function adminTable()
    {
        // $admins = Admin::where('id','!=',1)->paginate(20);
        $admins = DB::table('admins')
            ->join('ranks', 'admins.rank_id', '=', 'ranks.id')
            ->select('admins.*', 'ranks.RankName','ranks.RankNameMM')
            ->where('admins.id','!=',1)
            ->orderby('created_at','desc')
            ->paginate(20);

        return view('admin.admintable',compact('admins'));
    }

    public function showCreateForm()
    {
        $ranks = Rank::all();
        return view('admin.create', compact('ranks'));
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'UserID' => ['required','unique:admins'],
            'username' => ['required'],
            'password' => ['required'],
            'confirmpassword' => ['same:password'],
        ]);

        Admin::create([
            'UserID'  =>  $request['UserID'],
            'username'  =>  $request['username'],
            'password'  =>  Hash::make($request['password']),
            'rank_id' => $request['rank_id'],
            'Status' => 1,
        ]);

        Toastr::success('Adminstrator Created!');

        return redirect()->route('admintable');
    }

    public function showEditForm($id)
    {
        $admin = Admin::findOrFail($id);
        $ranks = Rank::all();
        return view('admin.edit', compact('admin','ranks'));
    }

    public function updateAdmin($id,Request $request)
    {
        $admin = Admin::findOrFail($id);

        /*$request->validate([
            'UserID' => ['required','unique:admins'],
            'username' => ['required'],
        ]);*/

        // $admin->update(['UserID'=>request('UserID')]);
        $admin->update(['username'=>request('username')]);
        $admin->update(['rank_id'=>request('rank_id')]);

        Toastr::success('Adminstrator Updated!');

        return redirect()->route('admintable');
    }

    public function changePasswordForm()
    {
        return view('admin.changePassword');
    }

    public function changepasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        Admin::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->back()->with('alert', 'Password Successfully Changed.');
    }


    

    public function reportForm(Request $request)
    {
        $sector = Sector::orderBy('SectorNameMM')->get();
        $nationality = Nationality::orderBy('NationalityName')->get();
        $persontype = PersonType::orderBy('PersonTypeNameMM')->get();
        $reportlist = DB::table('visa_application_details')
        ->join('visa_application_heads', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
        ->join('nationalities', 'visa_application_details.nationality_id', '=', 'nationalities.id')
        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
        ->join('person_types', 'visa_application_details.person_type_id', '=', 'person_types.id')
        ->join('sectors','profiles.sector_id','=','sectors.id')
        ->leftjoin('relation_ships', 'visa_application_details.relation_ship_id', '=', 'relation_ships.id')
        ->leftjoin('visa_types', 'visa_application_details.visa_type_id', '=', 'visa_types.id')
        ->leftjoin('stay_types', 'visa_application_details.stay_type_id', '=', 'stay_types.id')
        ->select('visa_application_details.*','nationalities.NationalityName','visa_types.VisaTypeNameMM','stay_types.StayTypeNameMM','person_types.PersonTypeNameMM','relation_ships.RelationShipNameMM','profiles.CompanyName','profiles.PermitNo','visa_application_heads.ApproveDate','sectors.SectorNameMM','profiles.Township');

	        if (!is_null($request->PersonNameSearch)) {
	            $reportlist->where('visa_application_details.PersonName', 'like', '%'.$request->PersonNameSearch.'%');
	        }
	        if (!is_null($request->from_date) || !is_null($request->to_date)) {
	            $reportlist->whereBetween('visa_application_heads.ApproveDate', [$request->from_date, $request->to_date]);
	        }

            if (!is_null($request->GenderSearch)) {
	            $reportlist->where('visa_application_details.Gender', '=', $request->GenderSearch);
	        }

            if (!is_null($request->SectorSearch)) {
	            $reportlist->where('profiles.sector_id', '=', $request->SectorSearch);
	        }

            if (!is_null($request->PersonTypeSearch)) {
	            $reportlist->where('visa_application_details.person_type_id', '=', $request->PersonTypeSearch);
	        }

	        if (!is_null($request->NationalitySearch)) {
	            $reportlist->where('visa_application_details.nationality_id', '=', $request->NationalitySearch);
	        }

            if (!is_null($request->CompanyNameSearch)) {
	            $reportlist->where('profiles.CompanyName', 'like', '%'.$request->CompanyNameSearch.'%');
	        }

            if (!is_null($request->PermitNoSearch)) {
	            $reportlist->where('profiles.PermitNo', 'like', '%'.$request->PermitNoSearch.'%');
	        }

            if (!is_null($request->AddressSearch)) {
	            $reportlist->where('profiles.Township', 'like', '%'.$request->AddressSearch.'%');
	        }

	        
            $reportlist->where('visa_application_heads.Status', '=', 1);
	        $reportlist->orderBy('PersonName','asc');
	        $reportlist->get();
            $reports = $reportlist->paginate(1000);

        return view('admin.reportForm',compact('reports','nationality','persontype','sector'));

    }
}
