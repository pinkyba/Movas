<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sector;
use App\Models\PersonType;
use App\Models\Nationality;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\ExcelExport;    


class ReportController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','superadmin']);
    }
    
    public function reportExport(Request $request)
    {
        $reportlist = DB::table('visa_application_details')
        ->join('visa_application_heads', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
        ->join('nationalities', 'visa_application_details.nationality_id', '=', 'nationalities.id')
        ->leftjoin('visa_types', 'visa_application_details.visa_type_id', '=', 'visa_types.id')
        ->leftjoin('stay_types', 'visa_application_details.stay_type_id', '=', 'stay_types.id')
        ->join('person_types', 'visa_application_details.person_type_id', '=', 'person_types.id')
        ->leftjoin('relation_ships', 'visa_application_details.relation_ship_id', '=', 'relation_ships.id')
        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
        ->join('sectors','profiles.sector_id','=','sectors.id')
        ->select('visa_application_details.*','nationalities.NationalityName','visa_types.VisaTypeNameMM','stay_types.StayTypeNameMM','person_types.PersonTypeNameMM','relation_ships.RelationShipNameMM','profiles.CompanyName','profiles.PermitNo','visa_application_heads.ApproveDate','sectors.SectorNameMM','profiles.Township');

        if (!is_null($request->PersonNameSearch)) {
                $reportlist->where('visa_application_details.PersonName', 'like', '%'.$request->PersonNameSearch.'%');
            }
            if (!is_null($request->from_date) || !is_null($request->to_date)) {
                $reportlist->whereBetween('visa_application_heads.ApproveDate', [$request->from_date, $request->to_date]);
            }
            if (!is_null($request->NationalitySearch)) {
                $reportlist->where('visa_application_details.nationality_id', '=', $request->NationalitySearch);
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
            $reports = $reportlist->paginate(30);

        // $reports = $query->orderBy('visa_application_details.id', 'desc')->get();

        $array = [];
        foreach ($reports as $key => $list) {
            if($list->StayTypeNameMM=='၃ လ'){
                $toDate = Carbon::parse($list->StayExpireDate)->addMonth(3)->subDay(1)->format('Y-m-d');

            } else if($list->StayTypeNameMM=='၆ လ'){
                $toDate = Carbon::parse($list->StayExpireDate)->addMonth(6)->subDay(1)->format('Y-m-d');

            } else if($list->StayTypeNameMM=='၁ နှစ်'){
                $toDate = Carbon::parse($list->StayExpireDate)->addMonth(12)->subDay(1)->format('Y-m-d');
            } else {
                $toDate = '';
            }

            $array[] = [
                'No' => $key + 1,
                'PersonName' => $list->PersonName,
                'Nationalities' => $list->NationalityName,
                'Gender' => $list->Gender,
                'PassportNo' => $list->PassportNo,
                'StayExpireDate' => $list->StayExpireDate,
                'visa_types' => $list->VisaTypeNameMM,
                'stay_types' => $list->StayTypeNameMM,
                'StayAllowDateFrom' => $list->StayExpireDate,
                'StayAllowDateTo' => $toDate,
                'person_types' => $list->PersonTypeNameMM,
                'relation_ships' => $list->RelationShipNameMM,
                'Sectore' => $list->SectorNameMM,
                'CompanyName' => $list->CompanyName,
                'Township' => $list->Township,
                'PermitNo' => $list->PermitNo,
                'ApproveDate' => Carbon::parse($list->ApproveDate)->format('d'),
                'ApproveDate1' => Carbon::parse($list->ApproveDate)->format('m'),
                'ApproveDate2' => Carbon::parse($list->ApproveDate)->format('Y'),
            ];
        }

        $rows = count($array);
        $export = new ExcelExport($array,$rows);
        $name = 'report.xlsx';
       
        return Excel::download($export,$name);
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
