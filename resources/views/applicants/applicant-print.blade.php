<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>{{ env('APP_NAME') }}</title>
        <link rel="icon" href="{{ asset('img/index.png')  }}" type="image/x-icon">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <script language="javascript" type="text/javascript">
            function printDiv(divID) {
                var divElements = $('#' + divID).html();
                var oldPage = document.body.innerHTML;
                document.body.innerHTML =
                        "<html><head><title>Auqaf, hajj, Religious & Minority Affairs</title></head><body>" +
                        divElements + "</body>";
                window.print();
                document.body.innerHTML = oldPage;
            }
        </script>
        <style>
            @media print {
                @page { margin: 0; }
                body { margin: 0.6cm; }
                .header_text{ font-size: 22px; margin-top: 8px; margin-left:10px;  color:#057822 !important; }
                .d_msg{ color:red !important; font-size: 15px; }
                .form-section{ color:#117D2C; }
            }
        </style>
    </head>
    <body>
        <div id="DivIdToPrint">
            <!--=== Confirmation ===-->
            <div style="margin:0 5px;width:100%">
                <div style="width:20%;float: left;">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" width="250" />
                </div>
                <div style="color:white;width: 80%;float:right;">
                    <h3 class="header_text" style="color:green;font-size: 22px;">{{ env('APP_NAME') }}</h3>
                </div>
            </div>
            <div class="row" style="margin:0 5px;padding-top:20px; clear: both">
                @if ($result->fund->sub_category_id == 3)
                    <h4 class="form-section">"{{ ucwords($result->fund->fund_name) }}" for the Students of Minority Community.</h4>
                @else
                    <p>{{ ucwords($result->fund->fund_name) }}<br/></p>
                @endif
                <h4 class="form-section">Personal Details</h4>
                <div class="body">
                    <div class="table-responsive">
                        @if ($result->fund->sub_category_id == 3)
                            <div style="width: 75%;float: left;padding-right: 60px;">
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">Token number</td>
                                        <td style="border-top:none;">{{ $result->id }}</td>
                                    </tr>  
                                    <tr>
                                        <td>CNIC</td>
                                        <td>{{ $result->applicant->cnic }}</td>
                                    </tr>  
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ ucfirst($result->applicant->name) }}</td>
                                    </tr>  
                                    <tr>
                                        <td>Father Name</td>
                                        <td>{{ ucfirst($result->applicant->father_name) }}</td>
                                    </tr>  
                                    <tr>
                                        <td>Religion</td>
                                        <td>{{ $result->applicant->religion->religion_name }}</td>
                                    </tr>  
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ ucfirst($result->applicant->gender)   }}</td>
                                    </tr>  
                                    <tr>
                                        <td>Applied on</td>
                                        <td>{{ date('M-d-Y', strtotime($result->appling_date)) }}</td>
                                    </tr> 
                                </table> 
                            </div>
                            <div style="width:25%;height: 200px;border: 1px solid #ccc;float: right;display: table;">
                                <span style="display: table-cell;vertical-align: middle;text-align: center;">Attach Passport Size Photo</span>
                            </div>
                            <h4 style="clear:both">Contact Details</h4>
                            <div style="width: 75%;float: left;padding-right: 20px;">
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">Current Address</td>
                                        <td style="border-top:none;">{{ $result->applicant->applicantAddress ? $result->applicant->applicantAddress->current_address : "" }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Permanent address</td>
                                        <td>{{ $result->applicant->applicantAddress ? $result->applicant->applicantAddress->permenent_address : "" }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Postal Address</td>
                                        <td>{{ $result->applicant->applicantAddress ? $result->applicant->applicantAddress->postal_address : "" }}</td>
                                    </tr> 
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $result->applicant->applicantAddress ? $result->applicant->applicantAddress->city->name : "" }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Mobile Number</td>
                                        @php
                                            $contacts = $result->applicant->applicantContacts->pluck('mob_number')->toArray();
                                        @endphp
                                        <td>{{ implode(',', $contacts) }}</td>
                                    </tr> 
                                </table>
                            </div>
                            <div style="width: 50%;float: left;padding-right: 20px;clear:both;border-right: 1px solid #ccc;">
                                <h4 style="">Qualification Details</h4>
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">Qualification Level</td>
                                        <td style="border-top:none;">{{ $result->applicant->qualification->qualificationLevel->name }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Discipline</td>
                                        <td>{{ $result->applicant->qualification->discipline->discipline }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Recent Class</td>
                                        <td>{{ $result->applicant->qualification->recent_class }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Passing Date</td>
                                        <td>{{ $result->applicant->qualification->passing_date }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Current Class</td>
                                        <td>{{ $result->applicant->qualification->current_class }}</td>
                                    </tr>
                                    <tr>
                                        <td>Institute Name</td>
                                        <td>{!! $result->applicant->qualification->institute->name !!}</td>
                                    </tr>
                                </table>
                            </div>
                            <div style="width: 50%;float: left; padding-left:20px;">
                                <h4 style="">Academic Details</h4>
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">Grading system</td>
                                        <td style="border-top:none;">{{ strtoupper($result->applicant->qualification->grading_system) }}</td>
                                    </tr>
                                    @if ($result->applicant->qualification->grading_system == 'marks')
                                        <tr>
                                            <td>Total Marks</td>
                                            <td>{{ $result->applicant->qualification->total_marks }}</td>
                                        </tr>
                                        <tr>
                                            <td>Obtained Marks</td>
                                            <td>{{ $result->applicant->qualification->obtained_marks }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Total CGPA</td>
                                            <td>{{ number_format($result->applicant->qualification->total_cgpa,2,'.','') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Obtained CGPA</td>
                                            <td>{{ number_format($result->applicant->qualification->obtained_cgpa,2,'.','') }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Percentage</td>
                                        <td>{{ number_format($result->applicant->qualification->percentage,2,'.','') }}%</td>
                                    </tr>

                                </table>
                            </div>
                        @else
                            <table class="table table-bordered dataTable" style="margin-bottom:5px !important;">
                                <tr>
                                    <td>Token number</td>
                                    <td>{{ $result->id }}</td>
                                </tr>  
                                <tr>
                                    <td>CNIC</td>
                                    <td>{{ $result->applicant->cnic }}</td>
                                </tr>  
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $result->applicant->name }}</td>
                                </tr>  
                                <tr>
                                    <td>Father Name</td>
                                    <td>{{ $result->applicant->father_name }}</td>
                                </tr>  
                                <tr>
                                    <td>Religion</td>
                                    <td>{{ $result->applicant->religion->religion_name }}</td>
                                </tr>  
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ ucfirst($result->applicant->gender) }}</td>
                                </tr>  
                                <tr>
                                    <td>Marital Status</td>
                                    <td>{{ $result->applicant->maritalStatus->status }}</td>
                                </tr>  
                                @if ($result->applicant->applicantProfession)
                                    <tr>
                                        <td>Profession</td>
                                        <td>{{ $result->applicant->applicantProfession->profession }}</td>
                                    </tr>
                                @endif
                                @if ($result->applicant->applicantIncome && $result->applicant->applicantIncome->monthly_income > 0)
                                    <tr>
                                        <td>Monthly Income</td>
                                        <td>{{ $result->applicant->applicantIncome->monthly_income }}</td>
                                    </tr> 
                                @endif
                                @if ($result->applicant->applicantHouseholdDetail)
                                    <tr>
                                        <td>Family Member</td>
                                        <td>{{ $result->applicant->applicantHouseholdDetail->dependent_family_members }}</td>
                                    </tr> 
                                @endif
                                <tr>
                                    <td>Applied on</td>
                                    <td>{{ date('M-d-Y', strtotime($result->appling_date)) }}</td>
                                </tr> 
                            </table> 
                            @if ( ! is_null( $result->applicant->disease ) && ! empty( $result->applicant->disease ) )
                                <h4  style="color:#117D2C;" class="form-section">Disease & hospitalization Details</h4>
                                <table class="table table-bordered dataTable" style="margin-bottom:5px !important;">
                                    <tr>
                                        <td>Disease</td>
                                        <td>{{ $result->applicant->disease }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Doctor Name</td>
                                        <td>{{ $result->applicant->dname }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Hospital/clinic Address</td>
                                        <td>{{ $result->applicant->clinic_address }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Doctor/clinic Contact number</td>
                                        <td>{{ $result->applicant->dcontact }}</td>
                                    </tr> 
                                </table>
                            @endif
                            @if ($result->applicant->gname)
                                <h4  style="color:#117D2C;" class="form-section">Groom Details</h4>
                                <table class="table table-bordered dataTable">
                                    <tr>
                                        <td>Groom Name</td>
                                        <td>{{ $result->applicant->gname }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Father Name</td>
                                        <td>{{ $result->applicant->gfather_name }}</td>
                                    </tr> 
                                    <tr>
                                        <td>CNIC</td>
                                        <td>{{ $result->applicant->gcnic }}</td>
                                    </tr> 
                                    <tr>
                                        <td>Contact number</td>
                                        <td>{{ $result->applicant->gcontact }}</td>
                                    </tr> 
                                </table>
                            @endif
                            <h4  style="color:#117D2C;" class="form-section">Contact Details</h4>

                            <table class="table table-bordered dataTable">
                                <tr>
                                    <td>current Address</td>
                                    <td>{{ $result->applicant->applicantAddress->current_address }}</td>
                                </tr> 
                                <tr>
                                    <td>Permanent address</td>
                                    <td>{{ $result->applicant->applicantAddress->permenent_address }}</td>
                                </tr> 
                                <tr>
                                    <td>Postal Address</td>
                                    <td>{{ $result->applicant->applicantAddress->postal_address }}</td>
                                </tr> 
                                <tr>
                                    <td>City</td>
                                    <td>{{ $result->applicant->applicantAddress->city->name }}</td>
                                </tr> 
                                <tr>
                                    <td>Mobile Number</td>
                                    @php
                                        $contacts = $result->applicant->applicantContacts->pluck('mob_number')->toArray();
                                    @endphp
                                    <td>{{ implode(',', $contacts) }}</td>
                                </tr> 
                            </table>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <br/><br/><br/><br/><br/><br/>
                        @if ($result->fund->sub_category_id == 3)
                            <div style="width:100%;border: 1px solid black;">
                                <h3 style="text-align:center;margin-top: 5px;margin-bottom: 5px;">CERTIFICATE FROM THE HEAD OF THE INSTITUTE</h3>
                                <p style="text-align:center">(Please issue to those student who did not avail/receive any kind of scholarship during calender year {{ date('Y') }})</p>
                            </div>

                            <p style="margin-top:20px;line-height: 2.5;">
                                It is certified that Mr./Mrs. _________________________________________________________ s/d/w of Mr._________________________________________ is regular/bonafide student of this institute, studying in Class/Degree Title/Discipline __________________________________________ Part/Semester _____________________, and did not avail any kind of scholarship for the present class/semester 
                            </p>
                            <br/>
                            <p style="line-height: 2.5;"><span style="font-weight:bold;">Name and Address of the Institute</span>_______________________________________________________________<br/>_________________________________________________________________________________________________</p>
                        @else
                            <img src="{{ asset('img/attest.jpg') }}">
                        @endif
                    </div>
                    <ul>
                        <li class="d_msg">
                            {{ $result->fund->subCategory->description }}
                        </li>
                    </ul>

                </div>
            </div>
            <!-- /Confirmation -->
        </div>
        <div class="row">
            <div class="col-sm-12" style="padding:25px;background-color: #eee6;margin-bottom: 20px">
                <a class="btn btn-success" href="{{ route('guest.home.index') }}">Back</a>
                <input type='button' id='btn' class="btn btn-success" value='Print' onclick="javascript:printDiv('DivIdToPrint')">
            </div>
        </div>
    </body>
</html>
