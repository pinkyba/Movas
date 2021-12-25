@extends('layout')
@section('content')
<style>
/* Style the tab */
.tab {
  overflow: hidden;
  /*border: 1px solid #ccc;*/
  /*background-color: #f1f1f1;*/
}

/* Style the buttons inside the tab */
.tab button {
  background-color: #9894e5;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 15px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #7a7acf;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #524bef;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid green;
  -webkit-animation: fadeEffect 1s;
  animation: fadeEffect 1s;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

.mybutton {
  background-color: #4CAF50 !important; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>
<script>
	function validateFileSize(input) {
		const fileSize = input.files[0].size 
		if (fileSize > 3145728) {
		alert('Attach File Size Must Be Lower Than 3 MB');
		input.value='';
		}
	}
</script>
	<form class="form-inline" method="post" action="{{ route('applyform.update',$visa_head->id) }}" enctype="multipart/form-data">
			  	@csrf
		<div class="container mt-3 mb-4">
			{{-- <h3 class="text-center">Application Form</h3> --}}
			<div class="tab row">
				<div class="col-md-10 col-sm-6">
					<button class="tablinks active company" type="button" id="Mytab0" onclick="openCity(event, 'Company')">Company</button>
					@if ($count == 1)
						<button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
					@elseif($count == 2)
						<button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
						<button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')">Applicant - 2</button>
					@elseif($count == 3)
						<button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
					  <button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')">Applicant - 2</button>
					  <button class="tablinks applicant3" type="button" id="Mytab3" onclick="openCity(event, 'Applicant3')">Applicant - 3</button>
					 @elseif($count == 4)
					  <button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
					  <button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')">Applicant - 2</button>
					  <button class="tablinks applicant3" type="button" id="Mytab3" onclick="openCity(event, 'Applicant3')">Applicant - 3</button>
					  <button class="tablinks applicant4" type="button" id="Mytab4" onclick="openCity(event, 'Applicant4')">Applicant - 4</button>
					 @elseif($count == 5)
						 <button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
					  <button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')">Applicant - 2</button>
					  <button class="tablinks applicant3" type="button" id="Mytab3" onclick="openCity(event, 'Applicant3')">Applicant - 3</button>
					  <button class="tablinks applicant4" type="button" id="Mytab4" onclick="openCity(event, 'Applicant4')">Applicant - 4</button>
					  <button class="tablinks applicant5" type="button" id="Mytab5" onclick="openCity(event, 'Applicant5')">Applicant - 5</button>
					 @elseif($count == 6)
					 	<button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
						  <button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')">Applicant - 2</button>
						  <button class="tablinks applicant3" type="button" id="Mytab3" onclick="openCity(event, 'Applicant3')">Applicant - 3</button>
						  <button class="tablinks applicant4" type="button" id="Mytab4" onclick="openCity(event, 'Applicant4')">Applicant - 4</button>
						  <button class="tablinks applicant5" type="button" id="Mytab5" onclick="openCity(event, 'Applicant5')">Applicant - 5</button>
						  <button class="tablinks applicant6" type="button" id="Mytab6" onclick="openCity(event, 'Applicant6')">Applicant - 6</button>
					 @elseif($count == 7)

					 <button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
					  <button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')">Applicant - 2</button>
					  <button class="tablinks applicant3" type="button" id="Mytab3" onclick="openCity(event, 'Applicant3')">Applicant - 3</button>
					  <button class="tablinks applicant4" type="button" id="Mytab4" onclick="openCity(event, 'Applicant4')">Applicant - 4</button>
					  <button class="tablinks applicant5" type="button" id="Mytab5" onclick="openCity(event, 'Applicant5')">Applicant - 5</button>
					  <button class="tablinks applicant6" type="button" id="Mytab6" onclick="openCity(event, 'Applicant6')">Applicant - 6</button>
					  <button class="tablinks applicant7" type="button" id="Mytab7" onclick="openCity(event, 'Applicant7')">Applicant - 7</button>
					@endif
				</div>
			  
			  <div class="col-md-2 col-sm-6">
			  	<button type="submit" class="mybutton" id="applySubmit" style="margin-right: 20px;background-color: #4CAF50;" onclick="return confirm('Submit Now');" >Submit</button>
			  </div>
			</div>

			<div id="Company" class="tabcontent" style="display: block;">
			  
			  	<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
			  	<input type="hidden" value="{{$profile->id}}" name="profile_id">
				<div class="container mb-5" style="">
					<h3 class="text-center mt-4"><span class="mm">ကုမ္ပဏီအချက်အလက်</span><span class="eng">COMPANY PROFILE</span></h3>
					<br/>
		
						<div class="row">
							<div class="col-6">
								<fieldset class="form-group">
									<label ><span class="mm">ကုမ္ပဏီအမည်</span><span class="eng">Company Name</span></label>
									<input type="text" disabled value="{{$profile->CompanyName}}" class="form-control" name="CompanyName">
								</fieldset>
							</div>
							
							<div class="col">
							    <fieldset class="form-group">
									<label ><span class="mm">ကုမ္ပဏီမှတ်ပုံတင်အမှတ်</span><span class="eng">Company Registeration No</span></label>
									<input type="text" disabled value="{{$profile->CompanyRegistrationNo}}" class="form-control" name="CompanyRegistrationNo">
								</fieldset>
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">လုပ်ငန်းအမျိုးအစား</span><span class="eng">Business Type</span></label>
									<br/>
									<textarea class="form-control" name="BusinessType" disabled>{{$profile->BusinessType}}</textarea>
								</fieldset>
							</div>
						</div>

						<br/>
						
						<div class="row mt-3">
							<div class="col">
								<fieldset class="form-group">
									<label ></label>
									<input disabled type="text" disabled class="form-control" style="border: 0;" value="Numbers of Local Staff">
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">အဆိုပြု</span><span class="eng">In Proposal</span></label>
									<input type="text" value="{{$visa_head->StaffLocalProposal}}" class="form-control" id="StaffLocalProposal" name="StaffLocalProposal" onkeyup="localTotal()" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">ထပ်တိုး</span><span class="eng">Increased</span></label>
									<input type="text" value="{{$visa_head->StaffLocalSurplus}}" class="form-control" id="StaffLocalSurplus" name="StaffLocalSurplus" onkeyup="localTotal()" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">စုစုပေါင်း</span><span class="eng">Total</span></label>
									<input type="text" id="TotalLocal" value="{{$total_local}}" class="form-control" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">ခန့်အပ်ပြီး</span><span class="eng">Appointed</span></label>
									<input type="text" value="{{$visa_head->StaffLocalAppointed}}" class="form-control" id="StaffLocalAppointed" name="StaffLocalAppointed" onkeyup="aLocal()" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">ခန့်ရန်ကျန်</span><span class="eng">Available</span></label>
									<input type="text" value="{{$available_local}}" id="AvailableLocal" class="form-control" readonly>
								</fieldset>
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col">
								<fieldset class="form-group">
									
									<input disabled type="text" disabled class="form-control" style="border: 0;" value="Numbers of Foreign Staff" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									
									<input type="text" value="{{$visa_head->StaffForeignProposal}}" class="form-control" id="StaffForeignProposal" name="StaffForeignProposal"  onkeyup="foreignTotal()" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									
									<input type="text" value="{{$visa_head->StaffForeignSurplus}}" class="form-control" id="StaffForeignSurplus" name="StaffForeignSurplus"  onkeyup="foreignTotal()" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									
									<input type="text" value="{{$total_foreign}}" id="TotalForeign" class="form-control" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									
									<input type="text" value="{{$visa_head->StaffForeignAppointed}}" class="form-control" id="StaffForeignAppointed" name="StaffForeignAppointed"  onkeyup="aForeign()" readonly>
								</fieldset>
							</div>
							<div class="col">
								<fieldset class="form-group">
									
									<input type="text" value="{{$available_foreign}}" id="AvailableForeign" class="form-control" readonly>
								</fieldset>
							</div>
						</div>

		                <br/>

		                <!-- <div class="row mt-3">
		                    <h3 class="text-center mt-3">ATTACHMENT</h3>
		                </div> -->
		                
						<!-- <div class="row mt-3">
						    <span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
		                    <br><br>
		                    <p>License/Permit/Evidence from Government Agency. Business Contract with other Related Organization (if Any).</p>

							<script>
                            $(document).ready(function() {
                                var i = 0;

                                $("#add").click(function() {

                                    ++i;

                                    $("#CompanyTable").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
                                });

                                $(document).on('click', '.remove-tr', function() {
                                    $(this).parents('tr').remove();
                                });

                            });
                        </script>

                        <table class="table table-bordered" id="CompanyTable">
                            <tr>
                                <th>File</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath[]" placeholder="Enter your Name" class="form-control" /></td>
                                <td><input type="text" name="Description[]" placeholder="Enter attachment description" class="form-control" /></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
					</div> -->

				</div>
				{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
				{{-- <button type="button" class="btn btn-primary mb-3 mytab">Next</button> --}}
			</div>


			@php
				$a=1;
				$b=1;
				$c=1;
				$d=1;
				$e=1;
				$f=1;
				$g=1;
				$h=1;
				$i=1;
				$j=1;
				$k=1;
				$l=1;
				$m=1;
				$zz=1;
				$o=1;
				$p=1;
				$q=1;
				$r=1;
				$s=1;
				$t=1;
				$u=1;
				$v=1;
				$w=1;
				$x=1;
				$y=1;
				$z=1;
				$aaa=1;
				$bbb=1;
				$ccc=1;
				$ddd=1;
				$ja=1;
				$jb=1;
				$jc=1;
				$jd=1;
				$je=1;
				$jf=1;
				$jg=1;
				$jh=1;
				$ji=1;
				$jj=1;
				$jk=1;
				$aaaa=1;
				$aaab=1;
				$aaac=1;
				$aaad=1;
				$aaae=1;
				$aaaf=1;
				$aaag=1;
			@endphp

			@foreach ($visa_details as $vd)

				
				<div id="Applicant{{$a++}}" class="tabcontent">
					<input type="hidden" name="detail_id{{$z++}}" value="{{$vd->id}}">
					<h3 class="text-center mt-4" style="text-transform: uppercase;">Applicant {{$b++}} information</h3>
					<br/>
		    			
						<div class="row">
							<div class="col-6">
								<fieldset class="form-group">
									<label ><span class="mm">အမည်</span><span class="eng">Name</span></label>
									<input type="text" class="form-control" name="PersonName{{$c++}}" value="{{$vd->PersonName}}" required>
								</fieldset>
							</div>
							
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span></label>
									<select class="form-control" name="nationality_id{{$d++}}" required>
										<option value="">Choose</option>
		                                @foreach($nationalities as $n)
		                                <option value="{{$n->id}}" {{$vd->nationality_id == $n->id  ? 'selected' : ''}}>{{$n->NationalityName}}</option>
		                                @endforeach
		                            </select>
								</fieldset>
							</div>
						</div>
						
						<div class="row mt-5">
							<div class="col">
							    <fieldset class="form-group">
									<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
		    					    <input type="text" class="form-control" name="PassportNo{{$e++}}" id="pxq13" value="{{$vd->PassportNo}}" required>
								</fieldset>
							</div>
							<div class="col">
							    <fieldset class="form-group">
									<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
		    					    <input type="date" class="form-control" name="StayAllowDate{{$f++}}" id="pxq14" value="{{$vd->StayAllowDate}}">
								</fieldset>
							</div>
							{{-- <div class="col">
							    <fieldset class="form-group">
									<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
		    					    <input type="date" class="form-control" name="StayExpireDate{{$g++}}" id="pxq15" value="{{$vd->StayExpireDate}}" onchange="checkTwoMonth(this.value,'TwoMonthWarning')">
								</fieldset>
							</div> --}}

							<div class="col">
								<fieldset class="form-group">
									<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning{{$ja++}}" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
									<input type="date" class="form-control" name="StayExpireDate{{$aaag++}}" id="pxq15" value="{{$vd->StayExpireDate}}" onchange="checkTwoMonth(this.value,'TwoMonthWarning{{$jb++}}')">
								</fieldset>
							</div>
							
						</div>

						<div class="row mt-5">
							<div class="col">
								<fieldset class="form-group">
									<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
									<select class="form-control" id="applicantType{{$aaae++}}" name="person_type_id{{$h++}}" onchange="checkApplicantType{{$y++}}(this.value); changeAttachmentLabel('applicantType{{$aaac++}}','attachmentLabel{{$aaad++}}')" required>
										<option value="">Choose</option>
		                                @foreach($person_types as $pt)
		                                <option value="{{$pt->id}}" {{$vd->person_type_id == $pt->id  ? 'selected' : ''}}>{{$pt->PersonTypeName}}</option>
		                                @endforeach
		                            </select>
								</fieldset>
							</div>
							<div class="col">
							    <fieldset class="form-group">
									<label for="abc23{{$ji++}}"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
		    					    <input type="date" class="form-control" name="DateOfBirth{{$i++}}" id="abc23{{$jj++}}" value="{{$vd->DateOfBirth}}" onchange="checkAge('relationship{{$jc++}}','abc23{{$jd++}}','relation{{$je++}}')">
								</fieldset>
							</div>
							<div class="col col-md-3">
								<fieldset class="form-group">
									<label ><span class="mm">ကျား၊မ</span><span class="eng">Gender</span></label>
									<div class="radio">
										<label>
											<input type="radio" name="Gender{{$j++}}" value="Male" {{$vd->Gender == 'Male'  ? 'checked' : ''}}>
											Male
										</label>
										<label>
											<input type="radio" name="Gender{{$k++}}" value="Female" {{$vd->Gender == 'Female'  ? 'checked' : ''}}>
											Female
										</label>
									</div>
								</fieldset>
							</div>
						</div>

						<div class="row mt-5">
							<div class="col">
								<label ><span class="mm">ဗီဇာအမျိုးအစား</span><span class="eng">Visa Type</span></label>
								<select class="form-control" name="visa_type_id{{$l++}}">
									<option value="">Not Apply</option>
	                                @foreach($visa_types as $vt)
	                                <option value="{{$vt->id}}" {{$vd->visa_type_id == $vt->id  ? 'selected' : ''}}>{{$vt->VisaTypeName}}</option>
	                                @endforeach
	                            </select>
							</div>
							<div class="col">
								<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
								<select class="form-control" name="stay_type_id{{$m++}}">
									<option value="">Not Apply</option>
	                                @foreach($stay_types as $st)
	                                <option value="{{$st->id}}" {{$vd->stay_type_id == $st->id  ? 'selected' : ''}}>{{$st->StayTypeName}}</option>
	                                @endforeach
	                            </select>
							</div>
							<div class="col" id="labour_type{{$o++}}">
								<label ><span class="mm">အလုပ်သမားကတ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
								<select class="form-control" name="labour_card_type_id{{$zz++}}">
									<option value="">Not Apply</option>
	                                @foreach($labour_card_types as $lct)
	                                <option value="{{$lct->id}}" {{$vd->labour_card_type_id == $lct->id  ? 'selected' : ''}}>{{$lct->LabourCardTypeName}}</option>
	                                @endforeach
	                            </select>
							</div>
						</div>

						<div style="display: none" id="dependant{{$p++}}">
							<div class="row mt-5" >
								<div class="col-md-6">
									<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation{{$aaab++}}" style="color:red;"><small></small></span></label>
									<select class="form-control" id="relationship{{$aaaa++}}" name="relation_ship_id{{$q++}}" onchange="checkAge('relationship{{$jf++}}','abc23{{$jg++}}','relation{{$jh++}}')">
										<option value="">Choose</option>
		                                @foreach($relation_ships as $rs)
		                                <option value="{{$rs->id}}" {{$vd->relation_ship_id == $rs->id  ? 'selected' : ''}}>{{$rs->RelationShipName}}</option>
		                                @endforeach
		                            </select>
								</div>
								<div class="col-md-6">
									<fieldset class="form-group">
										<label for="abc125"><span class="mm">မှတ်ချက်</span><span class="eng">Relation with (eg. Mr. John Smith)</span></label>
			    					    <textarea type="text" class="form-control" name="Remark{{$r++}}" id="abc125">{{$vd->Remark}}</textarea>
									</fieldset>
								</div>
							</div>
						</div>
						

		                <br/>

		                <div class="row mt-5">
		                    <h3 class="text-center mt-3">ATTACHMENT</h3>
		                </div>
		                
						<div class="row mt-3">
						    <span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
		                    <br><br>
		                    @if ($vd->person_type_id == 1)
		                    	<p id="attachmentLabel{{$aaaf++}}">Passport, Company Registration Card, Extract Form</p>
		                    @elseif ($vd->person_type_id == 2)
		                    	<p id="attachmentLabel{{$aaaf++}}">Passport, Company Registration Card, Extract Form</p>
		                    @elseif ($vd->person_type_id == 3)
		                    	<p id="attachmentLabel{{$aaaf++}}">Passport, MIC Approved Letter, Labour Card (if any)</p>
		                    @elseif ($vd->person_type_id == 4)
		                    	<p id="attachmentLabel{{$aaaf++}}">Passport, Evidence (eg. Marriage Contract, Birth Certificate), MIC Approved Letter and Technician/Skill Labour's Passport (if Relation with Technician/Skill Labour)</p>
		                    @endif
		                    

							<script>
                            $(document).ready(function() {
                                var i = 0;

                                $("#add_applicant_attach{{$s++}}").click(function() {

                                    ++i;

                                    $("#ApplicantTable{{$t++}}").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath{{$aaa++}}[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description{{$bbb++}}[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach{{$u++}}">Remove</button></td></tr>');
                                });

                                $(document).on('click', '.remove-applicant_attach1', function() {
                                    $(this).parents('tr').remove();
                                });

                            });
                        </script>

                        <table class="table table-bordered" id="ApplicantTable{{$v++}}">
                            <tr>
                                <th>File</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath{{$ccc++}}[]" placeholder="Enter your Name" class="form-control" /></td>
                                <td><input type="text" name="Description{{$ddd++}}[]" placeholder="Enter attachment description" class="form-control" /></td>
                                <td><button type="button" name="add_applicant_attach{{$w++}}" id="add_applicant_attach{{$x++}}" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
					</div>
					{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
				</div>
			@endforeach
			

			
			</form>
			</div>
			<script src="{{ asset('js/applyform.js') }}"></script>
			<script type="text/javascript">
				function localTotal() {
			        var StaffLocalProposal = checkNaN(document.getElementById('StaffLocalProposal').value);
			        var StaffLocalSurplus = checkNaN(document.getElementById('StaffLocalSurplus').value);
			        var TotalLocal = parseInt(StaffLocalProposal) + parseInt(StaffLocalSurplus);
			        document.getElementById('TotalLocal').value = TotalLocal;
			    }

			    function foreignTotal() {
			        var StaffForeignProposal = checkNaN(document.getElementById('StaffForeignProposal').value);
			        var StaffForeignSurplus = checkNaN(document.getElementById('StaffForeignSurplus').value);
			        var TotalForeign = parseInt(StaffForeignProposal) + parseInt(StaffForeignSurplus);
			        document.getElementById('TotalForeign').value = TotalForeign;
			    }

			    function aLocal() {
			        var StaffLocalAppointed = checkNaN(document.getElementById('StaffLocalAppointed').value);
			        var TotalLocal = checkNaN(document.getElementById('TotalLocal').value);
			        var a_local = parseInt(TotalLocal) - parseInt(StaffLocalAppointed);
			        document.getElementById('AvailableLocal').value = a_local;
			    }

			    function aForeign() {
			        var StaffForeignAppointed = checkNaN(document.getElementById('StaffForeignAppointed').value);
			        var TotalForeign = checkNaN(document.getElementById('TotalForeign').value);
			        var a_foreign = parseInt(TotalForeign) - parseInt(StaffForeignAppointed);
			        document.getElementById('AvailableForeign').value = a_foreign;
			    }

			    function checkNaN(Budget) {
			        var x = parseInt(Budget);
			        if (isNaN(x)) {
			            x = 0;
			        }
			        return x;
			    }

	function checkTwoMonth(expireDate,sourceID){
		const d = new Date();
		var newDate = new Date(d.setMonth(d.getMonth()+2)).toISOString().split('T')[0];

		var b = document.getElementById("applySubmit");
		if (newDate < expireDate) {
			b.disabled = true;
	    	b.style.background = "lightgrey"; //"#dc3545";
	    	var Mytab0 = document.getElementById("Mytab0");
	    	var Mytab1 = document.getElementById("Mytab1");
	    	var Mytab2 = document.getElementById("Mytab2");
	    	var Mytab3 = document.getElementById("Mytab3");
	    	var Mytab4 = document.getElementById("Mytab4");
	    	var Mytab5 = document.getElementById("Mytab5");
	    	var Mytab6 = document.getElementById("Mytab6");
	    	var Mytab7 = document.getElementById("Mytab7");

	    	if(Mytab0){
	    		document.getElementById("Mytab0").disabled = true;
	    	}
	    	if(Mytab1){
	    		document.getElementById("Mytab1").disabled = true;
	    	}
	    	if(Mytab2){
	    		document.getElementById("Mytab2").disabled = true;
	    	}
	    	if(Mytab3){
	    		document.getElementById("Mytab3").disabled = true;
	    	}
	    	if(Mytab4){
	    		document.getElementById("Mytab4").disabled = true;
	    	}
	    	if(Mytab5){
	    		document.getElementById("Mytab5").disabled = true;
	    	}
	    	if(Mytab6){
	    		document.getElementById("Mytab6").disabled = true;
	    	}
	    	if(Mytab7){
	    		document.getElementById("Mytab7").disabled = true;
	    	}
	    	

	    	// document.getElementById("TwoMonthWarning1").style.visibility = "visible";
	    	document.getElementById(sourceID).style.visibility = "visible";
	    } else {
	    	b.disabled = false;
	    	b.style.background = "#4CAF50";

	    	var Mytab0 = document.getElementById("Mytab0");
	    	var Mytab1 = document.getElementById("Mytab1");
	    	var Mytab2 = document.getElementById("Mytab2");
	    	var Mytab3 = document.getElementById("Mytab3");
	    	var Mytab4 = document.getElementById("Mytab4");
	    	var Mytab5 = document.getElementById("Mytab5");
	    	var Mytab6 = document.getElementById("Mytab6");
	    	var Mytab7 = document.getElementById("Mytab7");

	    	if(Mytab0){
	    		document.getElementById("Mytab0").disabled = false;
	    	}
	    	if(Mytab1){
	    		document.getElementById("Mytab1").disabled = false;
	    	}
	    	if(Mytab2){
	    		document.getElementById("Mytab2").disabled = false;
	    	}
	    	if(Mytab3){
	    		document.getElementById("Mytab3").disabled = false;
	    	}
	    	if(Mytab4){
	    		document.getElementById("Mytab4").disabled = false;
	    	}
	    	if(Mytab5){
	    		document.getElementById("Mytab5").disabled = false;
	    	}
	    	if(Mytab6){
	    		document.getElementById("Mytab6").disabled = false;
	    	}
	    	if(Mytab7){
	    		document.getElementById("Mytab7").disabled = false;
	    	}
	    	// document.getElementById("TwoMonthWarning1").style.visibility = "hidden";
	    	document.getElementById(sourceID).style.visibility = "hidden";
	    }
	}

	function checkAge(id1,id2,id3){
		var r = document.getElementById(id1).value;
		var dob = document.getElementById(id2).value;
		var x = document.getElementById(id3);

		// var years = new Date(new Date() - new Date(dob)).getFullYear() - 1970;		

		var b = document.getElementById("applySubmit");

		//1=Father, 2=Mother, 5=Son, 6=Daughter
		if (r==1 || r==2){
			const d = new Date();
			var newDate = new Date(d.setYear(d.getFullYear()-60)).toISOString().split('T')[0];
			// alert(newDate);
			if (newDate < dob) {
				x.innerHTML = "Invalid Under 60 Years";
				x.style.visibility = "visible";

				b.disabled = true;
				b.style.background = "lightgrey"; //"#dc3545";
				var Mytab0 = document.getElementById("Mytab0");
	    	var Mytab1 = document.getElementById("Mytab1");
	    	var Mytab2 = document.getElementById("Mytab2");
	    	var Mytab3 = document.getElementById("Mytab3");
	    	var Mytab4 = document.getElementById("Mytab4");
	    	var Mytab5 = document.getElementById("Mytab5");
	    	var Mytab6 = document.getElementById("Mytab6");
	    	var Mytab7 = document.getElementById("Mytab7");

	    	if(Mytab0){
	    		document.getElementById("Mytab0").disabled = true;
	    	}
	    	if(Mytab1){
	    		document.getElementById("Mytab1").disabled = true;
	    	}
	    	if(Mytab2){
	    		document.getElementById("Mytab2").disabled = true;
	    	}
	    	if(Mytab3){
	    		document.getElementById("Mytab3").disabled = true;
	    	}
	    	if(Mytab4){
	    		document.getElementById("Mytab4").disabled = true;
	    	}
	    	if(Mytab5){
	    		document.getElementById("Mytab5").disabled = true;
	    	}
	    	if(Mytab6){
	    		document.getElementById("Mytab6").disabled = true;
	    	}
	    	if(Mytab7){
	    		document.getElementById("Mytab7").disabled = true;
	    	}
			} else {
				x.innerHTML = "";
				x.style.visibility = "hidden";

				b.disabled = false;
				b.style.background = "#4CAF50";
				var Mytab0 = document.getElementById("Mytab0");
		    	var Mytab1 = document.getElementById("Mytab1");
		    	var Mytab2 = document.getElementById("Mytab2");
		    	var Mytab3 = document.getElementById("Mytab3");
		    	var Mytab4 = document.getElementById("Mytab4");
		    	var Mytab5 = document.getElementById("Mytab5");
		    	var Mytab6 = document.getElementById("Mytab6");
		    	var Mytab7 = document.getElementById("Mytab7");

		    	if(Mytab0){
		    		document.getElementById("Mytab0").disabled = false;
		    	}
		    	if(Mytab1){
		    		document.getElementById("Mytab1").disabled = false;
		    	}
		    	if(Mytab2){
		    		document.getElementById("Mytab2").disabled = false;
		    	}
		    	if(Mytab3){
		    		document.getElementById("Mytab3").disabled = false;
		    	}
		    	if(Mytab4){
		    		document.getElementById("Mytab4").disabled = false;
		    	}
		    	if(Mytab5){
		    		document.getElementById("Mytab5").disabled = false;
		    	}
		    	if(Mytab6){
		    		document.getElementById("Mytab6").disabled = false;
		    	}
		    	if(Mytab7){
		    		document.getElementById("Mytab7").disabled = false;
		    	}
			}
		} else if (r==5 || r==6){
			const d = new Date();
			var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
			if (newDate > dob) {
				x.innerHTML = "Invalid Over 18 Years";
				x.style.visibility = "visible";

				b.disabled = true;
				b.style.background = "lightgrey"; //"#dc3545";
				var Mytab0 = document.getElementById("Mytab0");
	    	var Mytab1 = document.getElementById("Mytab1");
	    	var Mytab2 = document.getElementById("Mytab2");
	    	var Mytab3 = document.getElementById("Mytab3");
	    	var Mytab4 = document.getElementById("Mytab4");
	    	var Mytab5 = document.getElementById("Mytab5");
	    	var Mytab6 = document.getElementById("Mytab6");
	    	var Mytab7 = document.getElementById("Mytab7");

	    	if(Mytab0){
	    		document.getElementById("Mytab0").disabled = true;
	    	}
	    	if(Mytab1){
	    		document.getElementById("Mytab1").disabled = true;
	    	}
	    	if(Mytab2){
	    		document.getElementById("Mytab2").disabled = true;
	    	}
	    	if(Mytab3){
	    		document.getElementById("Mytab3").disabled = true;
	    	}
	    	if(Mytab4){
	    		document.getElementById("Mytab4").disabled = true;
	    	}
	    	if(Mytab5){
	    		document.getElementById("Mytab5").disabled = true;
	    	}
	    	if(Mytab6){
	    		document.getElementById("Mytab6").disabled = true;
	    	}
	    	if(Mytab7){
	    		document.getElementById("Mytab7").disabled = true;
	    	}
			} else {
				x.innerHTML = "";
				x.style.visibility = "hidden";

				b.disabled = false;
				b.style.background = "#4CAF50";
				var Mytab0 = document.getElementById("Mytab0");
		    	var Mytab1 = document.getElementById("Mytab1");
		    	var Mytab2 = document.getElementById("Mytab2");
		    	var Mytab3 = document.getElementById("Mytab3");
		    	var Mytab4 = document.getElementById("Mytab4");
		    	var Mytab5 = document.getElementById("Mytab5");
		    	var Mytab6 = document.getElementById("Mytab6");
		    	var Mytab7 = document.getElementById("Mytab7");

		    	if(Mytab0){
		    		document.getElementById("Mytab0").disabled = false;
		    	}
		    	if(Mytab1){
		    		document.getElementById("Mytab1").disabled = false;
		    	}
		    	if(Mytab2){
		    		document.getElementById("Mytab2").disabled = false;
		    	}
		    	if(Mytab3){
		    		document.getElementById("Mytab3").disabled = false;
		    	}
		    	if(Mytab4){
		    		document.getElementById("Mytab4").disabled = false;
		    	}
		    	if(Mytab5){
		    		document.getElementById("Mytab5").disabled = false;
		    	}
		    	if(Mytab6){
		    		document.getElementById("Mytab6").disabled = false;
		    	}
		    	if(Mytab7){
		    		document.getElementById("Mytab7").disabled = false;
		    	}
			}
		} else {
			x.innerHTML = "";
			x.style.visibility = "hidden";

			b.disabled = false;
			b.style.background = "#4CAF50";
			var Mytab0 = document.getElementById("Mytab0");
		    	var Mytab1 = document.getElementById("Mytab1");
		    	var Mytab2 = document.getElementById("Mytab2");
		    	var Mytab3 = document.getElementById("Mytab3");
		    	var Mytab4 = document.getElementById("Mytab4");
		    	var Mytab5 = document.getElementById("Mytab5");
		    	var Mytab6 = document.getElementById("Mytab6");
		    	var Mytab7 = document.getElementById("Mytab7");

		    	if(Mytab0){
		    		document.getElementById("Mytab0").disabled = false;
		    	}
		    	if(Mytab1){
		    		document.getElementById("Mytab1").disabled = false;
		    	}
		    	if(Mytab2){
		    		document.getElementById("Mytab2").disabled = false;
		    	}
		    	if(Mytab3){
		    		document.getElementById("Mytab3").disabled = false;
		    	}
		    	if(Mytab4){
		    		document.getElementById("Mytab4").disabled = false;
		    	}
		    	if(Mytab5){
		    		document.getElementById("Mytab5").disabled = false;
		    	}
		    	if(Mytab6){
		    		document.getElementById("Mytab6").disabled = false;
		    	}
		    	if(Mytab7){
		    		document.getElementById("Mytab7").disabled = false;
		    	}
		}
	}

	function changeAttachmentLabel(id1,id2){
		// var t = document.getElementById("applicantType1").value;
		// var l = document.getElementById("attachmentLabel1");

		var t = document.getElementById(id1).value;
		var l = document.getElementById(id2);
		switch(t){
			case "1":
			l.innerHTML = "Passport, Company Registration Card, Extract Form";
			break;
			case "2":
			l.innerHTML = "Passport, Company Registration Card, Extract Form";
			break;
			case "3":
			l.innerHTML = "Passport, MIC Approved Letter, Labour Card (if any)";
			break;
			case "4":
			l.innerHTML = "Passport, Evidence (eg. Marriage Contract, Birth Certificate), MIC Approved Letter and Technician/Skill Labour's Passport (if Relation with Technician/Skill Labour)";
			break;
		}
	}

</script>
@endsection