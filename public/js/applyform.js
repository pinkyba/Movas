$(document).ready(function() {
        $(document).on("click","#remove_tab",function() {
             $('#Company').show();
             $('#Applicant1').hide();
             $('#Applicant2').hide();
             $('#Applicant3').hide();
             $('#Applicant4').hide();
             $('#Applicant5').hide();
             $('#Applicant6').hide();
             $('#Applicant7').hide();
            
            $(".company").addClass("active");
            $(".applicant1").removeClass("active");
            $(".applicant2").removeClass("active");
            $(".applicant3").removeClass("active");
            $(".applicant4").removeClass("active");
            $(".applicant5").removeClass("active");
            $(".applicant6").removeClass("active");
            $(".applicant7").removeClass("active");
        });


        //showAppModalBody();

    });


$('.mybutton').on('click',function(){
    
    var isDisable = false;

    for (var i = 1; i <= 7; i++) {
        
        if($('#applicantType'+i+'').val() == "3" && $('#stay_type_id'+i+'').val() == ''){
            $('#alertmsg'+i+'').removeClass('d-none');
            $('#stay_type_id'+i+'').addClass('border-danger');
            $('#labouralert'+i+'').removeClass('d-none');
            $('#labour_card_type_id'+i+'').addClass('border-danger');
            isDisable = true;
        }
        else if($('#applicantType'+i+'').val() == "3" && $('#stay_type_id'+i+'').val() != '' && $('#labour_card_type_id'+i+'').val() == ''){
            $('#stay_type_id'+i+'').removeClass('border-danger');
            $('#labouralert'+i+'').removeClass('d-none');
            $('#labour_card_type_id'+i+'').addClass('border-danger');
            isDisable = true;
        }
        else if($('#file'+i+'').val() != '' && $('#des'+i+'').val() == ''){
            $('#stay_type_id'+i+'').removeClass('border-danger');
            $('#labouralert'+i+'').removeClass('d-none');
            $('#labour_card_type_id'+i+'').removeClass('border-danger');
            $('#desmsg'+i+'').removeClass('d-none');
            $('#des'+i+'').addClass('border-danger');
            isDisable = true;
        }
        
    }
    
    if(isDisable == true){
        $('#btnsave').addClass('disabled');
    }else{
        $('#btnsave').removeClass('disabled');
    }

    var titlehtml = '';
    var bodyhtml = '';

    var companyName = $('#comName').val();

    var ApplicantNumbers = 0;
    var VisaApply = false;
    var StayApply = false;
    var LabourCardApply = false;
    var Subject = "";

    var VisaApplySingle = false;
    var VisaApplyMultiple = false;
    var LabourCardApplyNew = false;
    var LabourCardApplyRenew = false;

    var oss_status = '';
    var app_numbers = '၀';
    var des = '';


    if ($('#nationality_id1').val() != '' && $('#PersonName1').val() != '' && $('.PassportNo1').val() != '') {
        
        if ($('#visa_type_id1') != '') {
            VisaApply = true;

            if ($('#visa_type_id1') == 1){
                VisaApplySingle = true;
            } else if ($('#visa_type_id1') == 2){
                VisaApplyMultiple = true;
            }
        }
        if ($('#stay_type_id1').val() != '') {
            StayApply = true;
        }
        if ($('#labour_card_type_id1') != '') {
            LabourCardApply = true;

            if ($('#labour_card_type_id1') == 1){
                LabourCardApplyNew = true;
            } else if ($('#labour_card_type_id1') == 2){
                LabourCardApplyRenew = true;
            }
        }      

        ApplicantNumbers += 1;
        
    }
        
    if ($('#nationality_id2').val() != '' && $('#PersonName2').val() != '' && $('.PassportNo2').val() != '') {
        
        if ($('#visa_type_id2') != '') {
            VisaApply = true;

            if ($('#visa_type_id2') == 1){
                VisaApplySingle = true;
            } else if ($('#visa_type_id2') == 2){
                VisaApplyMultiple = true;
            }
        }
        if ($('#stay_type_id2').val() != '') {
            StayApply = true;
        }
        if ($('#labour_card_type_id2') != '') {
            LabourCardApply = true;

            if ($('#labour_card_type_id2') == 1){
                LabourCardApplyNew = true;
            } else if ($('#labour_card_type_id2') == 2){
                LabourCardApplyRenew = true;
            }
        }      

        ApplicantNumbers += 1;

        
    }

    if ($('#nationality_id3').val() != '' && $('#PersonName3').val() != '' && $('.PassportNo3').val() != '') {
        

        if ($('#visa_type_id3') != '') {
            VisaApply = true;

            if ($('#visa_type_id3') == 1){
                VisaApplySingle = true;
            } else if ($('#visa_type_id3') == 2){
                VisaApplyMultiple = true;
            }
        }
        if ($('#stay_type_id3').val() != '') {
            StayApply = true;
        }
        if ($('#labour_card_type_id3') != '') {
            LabourCardApply = true;

            if ($('#labour_card_type_id3') == 1){
                LabourCardApplyNew = true;
            } else if ($('#labour_card_type_id3') == 2){
                LabourCardApplyRenew = true;
            }
        }      

        ApplicantNumbers += 1;
        
    }

    if ($('#nationality_id4').val() != '' && $('#PersonName4').val() != '' && $('.PassportNo4').val() != '') {
        

        if ($('#visa_type_id4') != '') {
            VisaApply = true;

            if ($('#visa_type_id4') == 1){
                VisaApplySingle = true;
            } else if ($('#visa_type_id4') == 2){
                VisaApplyMultiple = true;
            }
        }
        if ($('#stay_type_id4').val() != '') {
            StayApply = true;
        }
        if ($('#labour_card_type_id4') != '') {
            LabourCardApply = true;

            if ($('#labour_card_type_id4') == 1){
                LabourCardApplyNew = true;
            } else if ($('#labour_card_type_id4') == 2){
                LabourCardApplyRenew = true;
            }
        }      

        ApplicantNumbers += 1;
        
    }

    if ($('#nationality_id5').val() != '' && $('#PersonName5').val() != '' && $('.PassportNo5').val() != '') {
        

        if ($('#visa_type_id5') != '') {
            VisaApply = true;

            if ($('#visa_type_id5') == 1){
                VisaApplySingle = true;
            } else if ($('#visa_type_id5') == 2){
                VisaApplyMultiple = true;
            }
        }
        if ($('#stay_type_id5').val() != '') {
            StayApply = true;
        }
        if ($('#labour_card_type_id5') != '') {
            LabourCardApply = true;

            if ($('#labour_card_type_id5') == 1){
                LabourCardApplyNew = true;
            } else if ($('#labour_card_type_id5') == 2){
                LabourCardApplyRenew = true;
            }
        }      

        ApplicantNumbers += 1;
        
    }

    if ($('#nationality_id6').val() != '' && $('#PersonName6').val() != '' && $('.PassportNo6').val() != '') {
        

        if ($('#visa_type_id6') != '') {
            VisaApply = true;

            if ($('#visa_type_id6') == 1){
                VisaApplySingle = true;
            } else if ($('#visa_type_id6') == 2){
                VisaApplyMultiple = true;
            }
        }
        if ($('#stay_type_id6').val() != '') {
            StayApply = true;
        }
        if ($('#labour_card_type_id6') != '') {
            LabourCardApply = true;

            if ($('#labour_card_type_id6') == 1){
                LabourCardApplyNew = true;
            } else if ($('#labour_card_type_id6') == 2){
                LabourCardApplyRenew = true;
            }
        }      

        ApplicantNumbers += 1;
        
    }

    if ($('#nationality_id7').val() != '' && $('#PersonName7').val() != '' && $('.PassportNo7').val() != '') {
        

        if ($('#visa_type_id7') != '') {
            VisaApply = true;

            if ($('#visa_type_id7') == 1){
                VisaApplySingle = true;
            } else if ($('#visa_type_id7') == 2){
                VisaApplyMultiple = true;
            }
        }
        if ($('#stay_type_id7').val() != '') {
            StayApply = true;
        }
        if ($('#labour_card_type_id7') != '') {
            LabourCardApply = true;

            if ($('#labour_card_type_id7') == 1){
                LabourCardApplyNew = true;
            } else if ($('#labour_card_type_id7') == 2){
                LabourCardApplyRenew = true;
            }
        }      

        ApplicantNumbers += 1;
        
    }

    //1-immigration, 2-labour, 3-both
    if (StayApply == true && VisaApply == true && LabourCardApply == true) {
        if (VisaApplySingle == true && VisaApplyMultiple == true) {
            Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
            Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
            Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        }

        Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့်၊ " + Subject + " နှင့် ";

        if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
        } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
            Subject += "အလုပ်သမားကဒ် အသစ်";
        } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
        }

        oss_status = 3;
    }
    else if (StayApply == true && VisaApply == true && LabourCardApply == false) {
        if (VisaApplySingle == true && VisaApplyMultiple == true) {
            Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
            Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
            Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        }
        Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " + Subject;

        oss_status = 1;
    }
    else if (StayApply == true && VisaApply == false && LabourCardApply == true) {
        if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
        } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
            Subject += "အလုပ်သမားကဒ် အသစ်";
        } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
        }
        Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " + Subject;

        oss_status = 3;
    }
    else if (StayApply == false && VisaApply == true && LabourCardApply == true) {
        if (VisaApplySingle == true && VisaApplyMultiple == true) {
            Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
            Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
            Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        }
        Subject = Subject + " နှင့် ";
        if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
        } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
            Subject += "အလုပ်သမားကဒ် အသစ်";
        } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
        }

        oss_status = 3;
    }
    else if (StayApply == true && VisaApply == false && LabourCardApply == false) {
        Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခြင်း";
        oss_status = 1;
    }
    else if (StayApply == false && VisaApply == true && LabourCardApply == false) {
        if (VisaApplySingle == true && VisaApplyMultiple == true) {
            Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
            Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
            Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
        }

        oss_status = 1;
    }
    else if (StayApply == false && VisaApply == false && LabourCardApply == true) {
        if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
        } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
            Subject += "အလုပ်သမားကဒ် အသစ်";
        } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
            Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
        }

        oss_status = 2;
    }


    if (ApplicantNumbers == 1) {
        app_numbers = '၁';
    }else if (ApplicantNumbers == 2) {
        app_numbers = '၂';
    }
    else if (ApplicantNumbers == 3) {
        app_numbers = '၃';
    }
    else if (ApplicantNumbers == 4) {
        app_numbers = '၄';
    }
    else if (ApplicantNumbers == 5) {
        app_numbers = '၅';
    }
    else if (ApplicantNumbers == 6) {
        app_numbers = '၆';
    }
    else if (ApplicantNumbers == 7) {
        app_numbers = '၇';
    }
   
    des = "နိုင်ငံခြားသား ( "+app_numbers+" ) ဦး အား "+Subject+" ပြုလုပ်ခွင့်ပေးပါရန် တင်ပြလာခြင်း";


    titlehtml = `<div class="col-md-10">
                    <p><strong>အကြောင်းအရာ ။ ${companyName} မှ ${des}</strong></p>
                </div>
            `;

    $('#checkTitle').html(titlehtml);


    // table display
    var count = 0;

    if($('#PersonName1').val() != '' || $('#nationality_id1').val() != '' || $('.PassportNo1').val() != '' || $('.StayAllowDate1').val() != ''){
        count ++;
        var visaType = '';
        if($('#visa_type_id1').val() == 1)
            visaType = 'တစ်ကြိမ်';
        else if($('#visa_type_id1').val() == 2)
            visaType = 'အကြိမ်ကြိမ်';

        var stayType = '';
        if($('#stay_type_id1').val() == 1)
            stayType = '၃ လ';
        else if($('#stay_type_id1').val() == 2)
            stayType = '၆ လ';
        else if($('#stay_type_id1').val() == 3)
            stayType = 'တစ်နှစ်';

        var labourType = '';
        if($('#labour_card_type_id1').val() == 1)
            labourType = 'အသစ်လျှောက်';
        else if($('#labour_card_type_id1').val() == 2)
            labourType = 'သက်တမ်းတိုး';

        var labourDuration = '';
        if($('#labour_card_duration1').val() == 1)
            labourDuration = '၃ လ';
        else if($('#labour_card_duration1').val() == 2)
            labourDuration = '၆ လ';
        else if($('#labour_card_duration1').val() == 3)
            labourDuration = 'တစ်နှစ်';


        var nationality = $( "#nationality_id1 option:selected" ).text();
        var applicationName = $( "#applicantType1 option:selected" ).text();

        bodyhtml += `
                    <tr>
                        <td>${count}</td>
                        <td>${$('#PersonName1').val()}/${applicationName}</td>
                        <td>${nationality}</td>
                        <td>${$('.PassportNo1').val()}</td>
                        <td>${$('.StayAllowDate1').val()}</td>
                        <td>${$('.StayExpireDate1').val()}</td>
                        <td>${visaType}</td>
                        <td>${stayType}</td>
                        <td>${labourType}/${labourDuration}</td>
                    </tr>

                `;
    }

    if($('#PersonName2').val() != '' || $('#nationality_id2').val() != '' || $('.PassportNo2').val() != '' || $('.StayAllowDate2').val() != ''){
        count ++;
        var visaType = '';
        if($('#visa_type_id2').val() == 1)
            visaType = 'တစ်ကြိမ်';
        else if($('#visa_type_id2').val() == 2)
            visaType = 'အကြိမ်ကြိမ်';

        var stayType = '';
        if($('#stay_type_id2').val() == 1)
            stayType = '၃ လ';
        else if($('#stay_type_id2').val() == 2)
            stayType = '၆ လ';
        else if($('#stay_type_id2').val() == 3)
            stayType = 'တစ်နှစ်';

        var labourType = '';
        if($('#labour_card_type_id2').val() == 1)
            labourType = 'အသစ်လျှောက်';
        else if($('#labour_card_type_id2').val() == 2)
            labourType = 'သက်တမ်းတိုး';

        var labourDuration = '';
        if($('#labour_card_duration2').val() == 1)
            labourDuration = '၃ လ';
        else if($('#labour_card_duration2').val() == 2)
            labourDuration = '၆ လ';
        else if($('#labour_card_duration2').val() == 3)
            labourDuration = 'တစ်နှစ်';


        var nationality = $( "#nationality_id2 option:selected" ).text();
        var applicationName = $( "#applicantType2 option:selected" ).text();

        bodyhtml += `
                    <tr>
                        <td>${count}</td>
                        <td>${$('#PersonName2').val()}/${applicationName}</td>
                        <td>${nationality}</td>
                        <td>${$('.PassportNo2').val()}</td>
                        <td>${$('.StayAllowDate2').val()}</td>
                        <td>${$('.StayExpireDate2').val()}</td>
                        <td>${visaType}</td>
                        <td>${stayType}</td>
                        <td>${labourType}/${labourDuration}</td>
                    </tr>

                `;
    }

    if($('#PersonName3').val() != '' || $('#nationality_id3').val() != '' || $('.PassportNo3').val() != '' || $('.StayAllowDate3').val() != ''){
        count ++;
        var visaType = '';
        if($('#visa_type_id3').val() == 1)
            visaType = 'တစ်ကြိမ်';
        else if($('#visa_type_id3').val() == 2)
            visaType = 'အကြိမ်ကြိမ်';

        var stayType = '';
        if($('#stay_type_id3').val() == 1)
            stayType = '၃ လ';
        else if($('#stay_type_id3').val() == 2)
            stayType = '၆ လ';
        else if($('#stay_type_id3').val() == 3)
            stayType = 'တစ်နှစ်';

        var labourType = '';
        if($('#labour_card_type_id3').val() == 1)
            labourType = 'အသစ်လျှောက်';
        else if($('#labour_card_type_id3').val() == 2)
            labourType = 'သက်တမ်းတိုး';

        var labourDuration = '';
        if($('#labour_card_duration3').val() == 1)
            labourDuration = '၃ လ';
        else if($('#labour_card_duration3').val() == 2)
            labourDuration = '၆ လ';
        else if($('#labour_card_duration3').val() == 3)
            labourDuration = 'တစ်နှစ်';


        var nationality = $( "#nationality_id3 option:selected" ).text();
        var applicationName = $( "#applicantType3 option:selected" ).text();

        bodyhtml += `
                    <tr>
                        <td>${count}</td>
                        <td>${$('#PersonName3').val()}/${applicationName}</td>
                        <td>${nationality}</td>
                        <td>${$('.PassportNo3').val()}</td>
                        <td>${$('.StayAllowDate3').val()}</td>
                        <td>${$('.StayExpireDate3').val()}</td>
                        <td>${visaType}</td>
                        <td>${stayType}</td>
                        <td>${labourType}/${labourDuration}</td>
                    </tr>

                `;
    }

    if($('#PersonName4').val() != '' || $('#nationality_id4').val() != '' || $('.PassportNo4').val() != '' || $('.StayAllowDate4').val() != ''){
        count ++;
        var visaType = '';
        if($('#visa_type_id4').val() == 1)
            visaType = 'တစ်ကြိမ်';
        else if($('#visa_type_id4').val() == 2)
            visaType = 'အကြိမ်ကြိမ်';

        var stayType = '';
        if($('#stay_type_id4').val() == 1)
            stayType = '၃ လ';
        else if($('#stay_type_id4').val() == 2)
            stayType = '၆ လ';
        else if($('#stay_type_id4').val() == 3)
            stayType = 'တစ်နှစ်';

        var labourType = '';
        if($('#labour_card_type_id4').val() == 1)
            labourType = 'အသစ်လျှောက်';
        else if($('#labour_card_type_id4').val() == 2)
            labourType = 'သက်တမ်းတိုး';

        var labourDuration = '';
        if($('#labour_card_duration4').val() == 1)
            labourDuration = '၃ လ';
        else if($('#labour_card_duration4').val() == 2)
            labourDuration = '၆ လ';
        else if($('#labour_card_duration4').val() == 3)
            labourDuration = 'တစ်နှစ်';


        var nationality = $( "#nationality_id4 option:selected" ).text();
        var applicationName = $( "#applicantType4 option:selected" ).text();

        bodyhtml += `
                    <tr>
                        <td>${count}</td>
                        <td>${$('#PersonName4').val()}/${applicationName}</td>
                        <td>${nationality}</td>
                        <td>${$('.PassportNo4').val()}</td>
                        <td>${$('.StayAllowDate4').val()}</td>
                        <td>${$('.StayExpireDate4').val()}</td>
                        <td>${visaType}</td>
                        <td>${stayType}</td>
                        <td>${labourType}/${labourDuration}</td>
                    </tr>

                `;
    }

    if($('#PersonName5').val() != '' || $('#nationality_id5').val() != '' || $('.PassportNo5').val() != '' || $('.StayAllowDate5').val() != ''){
        count ++;
        var visaType = '';
        if($('#visa_type_id5').val() == 1)
            visaType = 'တစ်ကြိမ်';
        else
            visaType = 'အကြိမ်ကြိမ်';

        var stayType = '';
        if($('#stay_type_id5').val() == 1)
            stayType = '၃ လ';
        else if($('#stay_type_id5').val() == 2)
            stayType = '၆ လ';
        else
            stayType = 'တစ်နှစ်';

        var labourType = '';
        if($('#labour_card_type_id5').val() == 1)
            labourType = 'အသစ်လျှောက်';
        else
            labourType = 'သက်တမ်းတိုး';

        var labourDuration = '';
        if($('#labour_card_duration5').val() == 1)
            labourDuration = '၃ လ';
        else if($('#labour_card_duration5').val() == 2)
            labourDuration = '၆ လ';
        else
            labourDuration = 'တစ်နှစ်';


        var nationality = $( "#nationality_id5 option:selected" ).text();
        var applicationName = $( "#applicantType5 option:selected" ).text();

        bodyhtml += `
                    <tr>
                        <td>${count}</td>
                        <td>${$('#PersonName5').val()}/${applicationName}</td>
                        <td>${nationality}</td>
                        <td>${$('.PassportNo5').val()}</td>
                        <td>${$('.StayAllowDate5').val()}</td>
                        <td>${$('.StayExpireDate5').val()}</td>
                        <td>${visaType}</td>
                        <td>${stayType}</td>
                        <td>${labourType}/${labourDuration}</td>
                    </tr>

                `;
    }

    if($('#PersonName6').val() != '' || $('#nationality_id6').val() != '' || $('.PassportNo6').val() != '' || $('.StayAllowDate6').val() != ''){
        count ++;
        var visaType = '';
        if($('#visa_type_id6').val() == 1)
            visaType = 'တစ်ကြိမ်';
        else if($('#visa_type_id6').val() == 2)
            visaType = 'အကြိမ်ကြိမ်';

        var stayType = '';
        if($('#stay_type_id6').val() == 1)
            stayType = '၃ လ';
        else if($('#stay_type_id6').val() == 2)
            stayType = '၆ လ';
        else if($('#stay_type_id6').val() == 3)
            stayType = 'တစ်နှစ်';

        var labourType = '';
        if($('#labour_card_type_id6').val() == 1)
            labourType = 'အသစ်လျှောက်';
        else if($('#labour_card_type_id6').val() == 2)
            labourType = 'သက်တမ်းတိုး';

        var labourDuration = '';
        if($('#labour_card_duration6').val() == 1)
            labourDuration = '၃ လ';
        else if($('#labour_card_duration6').val() == 2)
            labourDuration = '၆ လ';
        else if($('#labour_card_duration6').val() == 3)
            labourDuration = 'တစ်နှစ်';


        var nationality = $( "#nationality_id6 option:selected" ).text();
        var applicationName = $( "#applicantType6 option:selected" ).text();

        bodyhtml += `
                    <tr>
                        <td>${count}</td>
                        <td>${$('#PersonName6').val()}/${applicationName}</td>
                        <td>${nationality}</td>
                        <td>${$('.PassportNo6').val()}</td>
                        <td>${$('.StayAllowDate6').val()}</td>
                        <td>${$('.StayExpireDate6').val()}</td>
                        <td>${visaType}</td>
                        <td>${stayType}</td>
                        <td>${labourType}/${labourDuration}</td>
                    </tr>

                `;
    }

    if($('#PersonName7').val() != '' || $('#nationality_id7').val() != '' || $('.PassportNo7').val() != '' || $('.StayAllowDate7').val() != ''){
        count ++;
        var visaType = '';
        if($('#visa_type_id7').val() == 1)
            visaType = 'တစ်ကြိမ်';
        else if($('#visa_type_id7').val() == 2)
            visaType = 'အကြိမ်ကြိမ်';

        var stayType = '';
        if($('#stay_type_id7').val() == 1)
            stayType = '၃ လ';
        else if($('#stay_type_id7').val() == 2)
            stayType = '၆ လ';
        else if($('#stay_type_id7').val() == 3)
            stayType = 'တစ်နှစ်';

        var labourType = '';
        if($('#labour_card_type_id7').val() == 1)
            labourType = 'အသစ်လျှောက်';
        else if($('#labour_card_type_id7').val() == 2)
            labourType = 'သက်တမ်းတိုး';

        var labourDuration = '';
        if($('#labour_card_duration7').val() == 1)
            labourDuration = '၃ လ';
        else if($('#labour_card_duration7').val() == 2)
            labourDuration = '၆ လ';
        else  if($('#labour_card_duration7').val() == 3)
            labourDuration = 'တစ်နှစ်';


        var nationality = $( "#nationality_id7 option:selected" ).text();
        var applicationName = $( "#applicantType7 option:selected" ).text();

        bodyhtml += `
                    <tr>
                        <td>${count}</td>
                        <td>${$('#PersonName7').val()}/${applicationName}</td>
                        <td>${nationality}</td>
                        <td>${$('.PassportNo7').val()}</td>
                        <td>${$('.StayAllowDate7').val()}</td>
                        <td>${$('.StayExpireDate7').val()}</td>
                        <td>${visaType}</td>
                        <td>${stayType}</td>
                        <td>${labourType}/${labourDuration}</td>
                    </tr>

                `;
    }

    $('#bodyhtml').html(bodyhtml);
})



function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

function checkApplicantType1(applicationType1) {

        if (applicationType1 == '4') {
            document.getElementById('dependant1').style.display = 'block';
            document.getElementById('labour_type1').style.display = 'none';
        } else {
            document.getElementById('dependant1').style.display = 'none';
            document.getElementById('labour_type1').style.display = 'block';
        }


    }

    function checkApplicantType2(applicationType2) {

        if (applicationType2 == '4') {
            document.getElementById('dependant2').style.display = 'block';
            document.getElementById('labour_type2').style.display = 'none';
        } else {
            document.getElementById('dependant2').style.display = 'none';
            document.getElementById('labour_type2').style.display = 'block';
        }


    }

    function checkApplicantType3(applicationType3) {

        if (applicationType3 == '4') {
            document.getElementById('dependant3').style.display = 'block';
            document.getElementById('labour_type3').style.display = 'none';
        } else {
            document.getElementById('dependant3').style.display = 'none';
            document.getElementById('labour_type3').style.display = 'block';
        }


    }

    function checkApplicantType4(applicationType4) {

        if (applicationType4 == '4') {
            document.getElementById('dependant4').style.display = 'block';
            document.getElementById('labour_type4').style.display = 'none';
        } else {
            document.getElementById('dependant4').style.display = 'none';
            document.getElementById('labour_type4').style.display = 'block';
        }


    }

    function checkApplicantType5(applicationType5) {

        if (applicationType5 == '4') {
            document.getElementById('dependant5').style.display = 'block';
            document.getElementById('labour_type5').style.display = 'none';
        } else {
            document.getElementById('dependant5').style.display = 'none';
            document.getElementById('labour_type5').style.display = 'block';
        }


    }

    function checkApplicantType6(applicationType6) {

        if (applicationType6 == '4') {
            document.getElementById('dependant6').style.display = 'block';
            document.getElementById('labour_type6').style.display = 'none';
        } else {
            document.getElementById('dependant6').style.display = 'none';
            document.getElementById('labour_type6').style.display = 'block';
        }


    }

    function checkApplicantType7(applicationType7) {

        if (applicationType7 == '4') {
            document.getElementById('dependant7').style.display = 'block';
            document.getElementById('labour_type7').style.display = 'none';
        } else {
            document.getElementById('dependant7').style.display = 'none';
            document.getElementById('labour_type7').style.display = 'block';
        }


    }

    No=1;

    function ShowTab(Mytab){
		switch(No) {
		  case 1:
		    Mytab="Mytab2";
		    break;
		  case 2:
		    Mytab="Mytab3";
		    break;
		  case 3:
		    Mytab="Mytab4";
		    break;
		  case 4:
		    Mytab="Mytab5";
		    break;
		  case 5:
		    Mytab="Mytab6";
		    break;
		  case 6:
		    Mytab="Mytab7";
		    break;
		}

		  var x = document.getElementById(Mytab);
		  x.style.display = "block";
		  if (No<8){  No++;  }
		}

		function HideTab(Myid){
		switch(No) {
		  case 7:
		    Mytab="Mytab7";
		    break;
		  case 6:
		    Mytab="Mytab6";
		    break;
		  case 5:
		    Mytab="Mytab5";
		    break;
		  case 4:
		    Mytab="Mytab4";
		    break;
		  case 3:
		    Mytab="Mytab3";
		    break;
		  case 2:
		    Mytab="Mytab2";
		}

		  var x = document.getElementById(Mytab);
		  x.style.display = "none";
		  if (No>1){  No--;  }
		}