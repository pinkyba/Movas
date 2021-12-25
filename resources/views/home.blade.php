@extends('layout')
@section('content')
<script type="text/javascript" src="{{ asset('wintouni/tlsDebug.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverter.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverterData.js') }}"></script>
<style>
	.button {
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  //margin: 4px 2px;
}

	.badge{display:inline-block;padding:.25em .4em;font-size:75%;font-weight:700;line-height:1;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25rem}.badge:empty{display:none}.btn .badge{position:relative;top:-1px}.badge-pill{padding-right:.6em;padding-left:.6em;border-radius:10rem}.badge-primary{color:#fff;background-color:#007bff}.badge-primary[href]:focus,.badge-primary[href]:hover{color:#fff;text-decoration:none;background-color:#0062cc}.badge-secondary{color:#fff;background-color:#6c757d}.badge-secondary[href]:focus,.badge-secondary[href]:hover{color:#fff;text-decoration:none;background-color:#545b62}.badge-success{color:#fff;background-color:#28a745}.badge-success[href]:focus,.badge-success[href]:hover{color:#fff;text-decoration:none;background-color:#1e7e34}.badge-info{color:#fff;background-color:#17a2b8}.badge-info[href]:focus,.badge-info[href]:hover{color:#fff;text-decoration:none;background-color:#117a8b}.badge-warning{color:#212529;background-color:#ffc107}.badge-warning[href]:focus,.badge-warning[href]:hover{color:#212529;text-decoration:none;background-color:#d39e00}.badge-danger{color:#fff;background-color:#dc3545}.badge-danger[href]:focus,.badge-danger[href]:hover{color:#fff;text-decoration:none;background-color:#bd2130}.badge-light{color:#212529;background-color:#f8f9fa}.badge-light[href]:focus,.badge-light[href]:hover{color:#212529;text-decoration:none;background-color:#dae0e5}.badge-dark{color:#fff;background-color:#343a40}.badge-dark[href]:focus,.badge-dark[href]:hover{color:#fff;text-decoration:none;background-color:#1d2124}

</style>
    <script type="text/javascript">
    	$(document).ready(function() {
			  window.setTimeout(function() {
			    $(".myalert").fadeTo(2000, 500).slideUp(500, function(){
			        $(this).remove(); 
			    });
			}, 3000);
		});

        function changeLanguage(val) {
            sessionStorage.setItem("language", val);

            if (val == "eng") {
                $('.mm').hide();
                $('.eng').show();

            } else {
                $('.eng').hide();
                $('.mm').show();
            }
        }

        function checkLan() {
            var lan = sessionStorage.getItem("language");
            if (lan) {
                changeLanguage(lan);
            } else {
                changeLanguage("eng");
            }
        }      

    </script>
    @php
    $r_from_date = request()->from_date === null? '' : request()->from_date;
    $r_to_date = request()->to_date === null? '' : request()->to_date;
    $r_person_type_id = request()->person_type_id === null? '' : request()->person_type_id;
    if(old()){
        $r_from_date = old('from_date');
        $r_to_date = old('to_date');
        $r_person_type_id = old('person_type_id');
    }
    @endphp
		<div class="container mt-4">
			<div class="alert alert-success alert-dismissible myalert" role="alert">
				
			  <strong>Keep your information up to date.To update your profile information! <a href="{{ route('editprofile') }}" class="btn btn-outline-success">Click Here</a></strong>
			  <button type="button" class="close btn btn-outline-danger" style="margin-left: 50px;" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>

			<div class="row mb-3">
					<div class="col-md-10 col-sm-6">
						<form class="navbar-form" action="{{ route('home') }}" method="get">
			              <div class="input-group no-border">
			              	<label class="mt-2" style="margin-right: 10px;">Status</label>
			              	<select class="form-control" name="status" style="border-radius: 3px;">
								<option value="">Choose</option>
								<option value="0">In-Process</option>
								<option value="1">Approved</option>
								<option value="2">Rejected</option>
                            </select>
			                {{-- <input type="text" id="search" class="form-control" placeholder="Search..." name="query"> --}}
			                <label class="mt-2" style="margin-left: 10px;margin-right: 10px;">From</label>
			                <input type="date" id="search" class="form-control" style="border-radius: 3px;" name="from_date" value="{{$r_from_date}}">
			                <label class="mt-2" style="margin-left: 10px;margin-right: 10px;">To</label>
			                <input type="date" id="search" class="form-control" style="border-radius: 3px;" name="to_date" value="{{$r_to_date}}">

			                <button type="submit" style="margin-left: 10px;margin-right: 10px;border-radius: 3px;" class="btn btn-primary btn-round btn-just-icon">
			                  <i class="fa fa-search"></i>
			                  <div class="ripple-container"></div>
			                </button>

			                <label class="text-danger"><b>{{$errors->first('from_date')}}</b></label>
		                    <label class="text-danger"><b>{{$errors->first('to_date')}}</b></label>
			              </div>
			            </form>
					</div>
				</div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr style="background: #e4f7eb;">
						<th style="font-weight: normal;text-align: center;" width="70">No</th>
						<th style="font-weight: normal;text-align: center;" width="170">First Apply Date</th>
						<th style="font-weight: normal;text-align: center;" width="170">Final Apply Date</th>
						<th style="font-weight: normal;text-align: center;" >Description</th>
						<th style="font-weight: normal;text-align: center;" width="100">Status</th>
						<th style="font-weight: normal;text-align: center;" width="150">Action</th>
					</tr>
				</thead>
				<tbody>
				@php
                  $i=1;
                  $ia=1;
                  $ib=1;
                  $ic=1;
                  $id=1;
                  $ie=1;
                  $if=1;
                  $aa=1;
                  $ab=1;
                  $ac=1;
                  $ad=1;
                  $ae=1;
                  $af=1;
                  $ba=1;
                  $bb=1;
                @endphp
                @foreach ($visa_heads as $key => $value)
                
@if ($value->Status == 1)
<input type="text" hidden id="approveLetterNo_sourceID{{$ia++}}" value="{{$value->ApproveLetterNo}}" /> 
<input type="text" hidden id="approveDate_sourceID{{$ib++}}" value="{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}" />
	<script>
	  $(document).ready(function() {
	      var al{{$aa++}} = document.getElementById("approveLetterNo_sourceID{{$ic++}}").value;
	      var ad{{$ab++}} = document.getElementById("approveDate_sourceID{{$id++}}").value;  

	      document.getElementById("ApproveLetterNo{{$ie++}}").innerHTML = "မရက-၉/OSS/န-ဗီဇာ/" + uniConvert(al{{$ac++}});      
	      document.getElementById("ApproveDate{{$if++}}").innerHTML = uniConvert(ad{{$ad++}});
	  });
	    
	</script>
@endif

						<tr>
							<td class="text-center">{{$visa_heads->firstItem() + $key}}</td>
							{{-- <td>
								{{$value->FirstApplyDate}}
							</td> --}}
							<td class="text-center">{{ \Carbon\Carbon::parse($value->FirstApplyDate)->format('j F, Y') }}</td>
							<td class="text-center">
								{{-- @php
									echo date("d/m/Y");
								@endphp --}}
								@if ($value->FinalApplyDate)
									{{ \Carbon\Carbon::parse($value->FinalApplyDate)->format('j F, Y') }}
								@else
									&nbsp;
								@endif
								
							</td>
							<td class="text-wrap">
								{{$value->Subject}}<br>@if ($value->Status == 2)
									<span class="text-danger">{{$value->RejectComment}}</span>
								@endif
							</td>
							<td class="text-center">
								@if ($value->Status == 0 || $value->Status == 3)
									<label class="badge badge-info">In-Process</label>
									<td class="text-center"><a class="btn btn-sm rounded btn-primary button disabled" style="opacity: .3">Show</a></td>
								@endif
								@if($value->Status == 1)
									<label class="badge badge-success">Approved</label>
									<td class="text-center"><button type="button" data-toggle="modal" data-target="#exampleModal{{$ba++}}" class="btn btn-sm rounded btn-primary button" style="font-weight: lighter; font-size: 15px;">Show</button></td>

									<!-- Modal -->
									<div class="modal fade" id="exampleModal{{$bb++}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Approved Date & Approve Letter No</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									      <div class="modal-body">
									      	<form>
										        <div class="form-group">
										        	{{-- <p>{{$value->id}}</p> --}}
										            <p  id="ApproveDate{{$ae++}}">{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}</p><br><p id="ApproveLetterNo{{$af++}}">စာအမှတ်၊ မရက-၉/oss/န-ဗီဇာ/{{$value->ApproveLetterNo}}</p>
										          </div>
										     
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									      </div>
									      	</form>
									    </div>
									  </div>
									</div>
								</div>
									{{-- <td style="line-height: 24px; width: 300px;"><span  id="ApproveDate{{$ae++}}">{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}</span><br><span id="ApproveLetterNo{{$af++}}">စာအမှတ်၊ မရက-၉/oss/န-ဗီဇာ/{{$value->ApproveLetterNo}}</span></td> --}}
								@endif
								@if($value->Status == 2)
									<label class="badge badge-danger">Rejected</label>
									<td class="text-center"><a class="btn btn-sm rounded btn-primary button" href="{{ route('applyform.id',$value->id) }}">Show</a></td>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{ $visa_heads->withQueryString()->links() }}
@endsection