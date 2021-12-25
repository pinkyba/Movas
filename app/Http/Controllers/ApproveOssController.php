<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\VisaApplicationHead;
use App\Models\Rank;
use App\Models\Admin;
use DB;
use Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class ApproveOssController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ossiApprove($id,Request $request)
    {
    	$visa_head = VisaApplicationHead::findOrFail($id);

    	$visa_head->update(['IntegrationActionStatus'=>1]);
    	$visa_head->update(['IntegrationActionDate'=>now()]);

    	Toastr::success('Successfully Approved!');

    	return redirect()->route('approvedform');
    }

    public function osslApprove($id,Request $request)
    {
    	$visa_head = VisaApplicationHead::findOrFail($id);

    	$visa_head->update(['LabourActionStatus'=>1]);
    	$visa_head->update(['LabourActionDate'=>now()]);

    	Toastr::success('Successfully Approved!');

    	return redirect()->route('approvedform');
    }

    public function ossiReject($id,Request $request)
    {
        $visa_head = VisaApplicationHead::findOrFail($id);

        $visa_head->update(['IntegrationActionStatus'=>2]);
        $visa_head->update(['IntegrationActionDate'=>now()]);
        $visa_head->update(['IntegrationActionRemark'=>$request->cmt]);

        Toastr::success('Successfully Rejected!');

        return redirect()->route('approvedform');
    }
}
