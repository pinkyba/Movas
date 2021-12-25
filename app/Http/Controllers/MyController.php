<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class MyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','superadmin']);
    }
    
    public function createPDF() {
      // retreive all records from db
      $data = Admin::all();

        $pdf = PDF::setOptions(['isRemoteEnabled' =>true]);

             $pdf->loadView('testpdf',compact('data'));

             $pdf->getDomPDF()->setHttpContext(
                stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );

          return $pdf->download('ReplyLetter.pdf');
    }
}
