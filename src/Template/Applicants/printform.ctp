<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Auqaf, hajj, Religious & Minority Affairs</title>
        <link rel="icon" href="<?php echo $this->request->webroot; ?>img/index.png" type="image/x-icon">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <script language="javascript" type="text/javascript">
            function printDiv(divID) {

                //Get the HTML of div
//                var divElements = $('#'+divID).innerHTML;
//                var divElements = document.getElementById(divID).innerHTML;
//                var divElements = $("<div />").append($('#' + divID).clone()).html();
                var divElements = $('#' + divID).html();

//                alert(divElements);
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                        "<html><head><title>Auqaf, hajj, Religious & Minority Affairs</title></head><body>" +
                        divElements + "</body>";

                //Print Page
                window.print();

                //Restore orignal HTML
                document.body.innerHTML = oldPage;
            }
//            window.onafterprint = function () {
////                alert('yes');
//                window.location = "<?php // echo $this->request->webroot;                                                       ?>";
//            }
        </script>

        <style>
            @media print {
                @page { margin: 0; }
                body { margin: 0.6cm; }
                .header_text{
                    font-size: 22px;
                    margin-top: 8px;
                    margin-left:10px; 
                    color:#057822 !important;
                }
                .d_msg{
                    color:red !important;
                    font-size: 15px;
                }
                .form-section{
                    color:#117D2C;
                }
            }

        </style>
    </head>
    <body>
        <div id="DivIdToPrint">

            <!--=== Confirmation ===-->
            <div style="margin:0 5px;width:100%">
                <div style="width:20%;float: left;">
                    <img src="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $this->request->webroot . 'img/logo.png' ?>" alt="logo" />
                </div>
                <div style="color:white;width: 80%;float:left;">
                    <h3 class="header_text" style="color:green;font-size: 22px;">Auqaf, Hajj, Religious & Minority Affairs</h3>
                </div>
            </div>
            <div class="row" style="margin:0 5px;padding-top:20px; clear: both">
                <?php
                if ($results[0]['sub_cat_id'] == 3) {
                    ?>
                    <h4  class="form-section">
                        "<?php echo ucwords($results[0]['fund_name']); ?>" for the Students of Minority Community.
                    </h4>
                <?php } else { ?>
                    <p>                   
                        <?php echo ucwords($results[0]['fund_name']); ?><br/>
                    </p>
                <?php } ?>
                <h4  class="form-section">
                    Personal Details
                </h4>
                <div class="body">
                    <div class="table-responsive">
                        <?php
                        if ($results[0]['sub_cat_id'] == 3) {
                            ?>
                            <div style="width: 75%;float: left;padding-right: 60px;">
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">Token number</td>
                                        <td style="border-top:none;"><?php echo $results[0]['af_id']; ?></td>
                                    </tr>  
                                    <tr>
                                        <td>CNIC</td>
                                        <td><?php echo $results[0]['cnic']; ?></td>
                                    </tr>  
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo ucfirst($results[0]['app_name']); ?></td>
                                    </tr>  
                                    <tr>
                                        <td>Father Name</td>
                                        <td><?php echo ucfirst($results[0]['father_name']); ?></td>
                                    </tr>  
                                    <tr>
                                        <td>Religion</td>
                                        <td><?php echo $results[0]['religion_name']; ?></td>
                                    </tr>  
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php echo $results[0]['gender']; ?></td>
                                    </tr>  
                                    <tr>
                                        <td>Applied on</td>
                                        <td><?php echo date('M-d-Y', strtotime($results[0]['appling_date'])); ?></td>
                                    </tr> 
                                </table> 
                            </div>
                            <div style="width:25%;height: 200px;border: 1px solid #ccc;float: right;display: table;">
                                <span style="display: table-cell;vertical-align: middle;text-align: center;">Attach Passport Size Photo</span>
                            </div>
                            <h4 style="clear:both">
                                Contact Details
                            </h4>
                            <div style="width: 75%;float: left;padding-right: 20px;">
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">current Address</td>
                                        <td style="border-top:none;"><?php echo $results[0]['current_address']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Permanent address</td>
                                        <td><?php echo $results[0]['permenent_address']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Postal Address</td>
                                        <td><?php echo $results[0]['postal_address']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo $results[0]['city_name']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Mobile Number</td>
                                        <td><?php echo $results[0]['mob_number']; ?></td>
                                    </tr> 
                                </table>
                            </div>

                            <div style="width: 50%;float: left;padding-right: 20px;clear:both;border-right: 1px solid #ccc;">
                                <h4 style="">
                                    Qualification Details
                                </h4>
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">Qualification Level</td>
                                        <td style="border-top:none;"><?php echo $results[0]['qualification_name']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Discipline</td>
                                        <td><?php echo $results[0]['discipline']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Recent Class</td>
                                        <td><?php echo $results[0]['recent_class']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Passing Date</td>
                                        <td><?php echo $results[0]['passing_date']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Current Class</td>
                                        <td><?php echo $results[0]['current_class']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Institute Name</td>
                                        <td><?php echo $results[0]['ins_name']; ?></td>
                                    </tr>

                                </table>
                            </div>
                            <div style="width: 50%;float: left; padding-left:20px;">
                                <h4 style="">
                                    Academic Details
                                </h4>
                                <table class="table">
                                    <tr>
                                        <td style="border-top:none;">Grading system</td>
                                        <td style="border-top:none;"><?php echo strtoupper($results[0]['grading_system']); ?></td>
                                    </tr> 
                                    <?php
                                    if ($results[0]['grading_system'] == 'marks') {
                                        ?>
                                        <tr>
                                            <td>Total Marks</td>
                                            <td><?php echo $results[0]['total_marks']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Obtained Marks</td>
                                            <td><?php echo $results[0]['obtained_marks']; ?></td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td>Total CGPA</td>
                                            <td><?php echo $results[0]['total_cgpa']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Obtained CGPA</td>
                                            <td><?php echo $results[0]['obtained_cgpa']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>Percentage</td>
                                        <td><?php echo $results[0]['percentage']; ?>%</td>
                                    </tr>

                                </table>
                            </div>


                        <?php } else { ?>
                            <table class="table table-bordered dataTable" style="margin-bottom:5px !important;">
                                <tr>
                                    <td>Token number</td>
                                    <td><?php echo $results[0]['af_id']; ?></td>
                                </tr>  
                                <tr>
                                    <td>CNIC</td>
                                    <td><?php echo $results[0]['cnic']; ?></td>
                                </tr>  
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $results[0]['app_name']; ?></td>
                                </tr>  
                                <tr>
                                    <td>Father Name</td>
                                    <td><?php echo $results[0]['father_name']; ?></td>
                                </tr>  
                                <tr>
                                    <td>Religion</td>
                                    <td><?php echo $results[0]['religion_name']; ?></td>
                                </tr>  
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $results[0]['gender']; ?></td>
                                </tr>  
                                <tr>
                                    <td>Marital Status</td>
                                    <td><?php echo $results[0]['status']; ?></td>
                                </tr>  
                                <?php if ($results[0]['profession']) { ?>
                                    <tr>
                                        <td>Profession</td>
                                        <td><?php echo $results[0]['profession']; ?></td>
                                    </tr> 
                                    <?php
                                }
                                if ($results[0]['monthly_income']) {
                                    ?>
                                    <tr>
                                        <td>Monthly Income</td>
                                        <td><?php echo $results[0]['monthly_income']; ?></td>
                                    </tr> 
                                    <?php
                                }
                                if ($results[0]['dependent_family_members']) {
                                    ?>
                                    <tr>
                                        <td>Family Member</td>
                                        <td><?php echo $results[0]['dependent_family_members']; ?></td>
                                    </tr> 
                                <?php } ?>
                                <tr>
                                    <td>Applied on</td>
                                    <td><?php echo date('M-d-Y', strtotime($results[0]['appling_date'])); ?></td>
                                </tr> 
                            </table> 
                            <?php if ($results[0]['disease']) { ?>
                                <h4  style="color:#117D2C;" class="form-section">Disease & hospitalization Details</h4>
                                <table class="table table-bordered dataTable" style="margin-bottom:5px !important;">
                                    <tr>
                                        <td>Disease</td>
                                        <td><?php echo $results[0]['disease']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Doctor Name</td>
                                        <td><?php echo $results[0]['dname']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Hospital/clinic Address</td>
                                        <td><?php echo $results[0]['clinic_address']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Doctor/clinic Contact number</td>
                                        <td><?php echo $results[0]['dcontact']; ?></td>
                                    </tr> 
                                </table>
                            <?php } ?>

                            <?php if ($results[0]['gname']) { ?>
                                <h4  style="color:#117D2C;" class="form-section">Groom Details</h4>
                                <table class="table table-bordered dataTable">
                                    <tr>
                                        <td>Groom Name</td>
                                        <td><?php echo $results[0]['gname']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Father Name</td>
                                        <td><?php echo $results[0]['gfather_name']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>CNIC</td>
                                        <td><?php echo $results[0]['gcnic']; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Contact number</td>
                                        <td><?php echo $results[0]['gcontact']; ?></td>
                                    </tr> 
                                </table>
                            <?php } ?>
                            <h4  style="color:#117D2C;" class="form-section">Contact Details</h4>

                            <table class="table table-bordered dataTable">
                                <tr>
                                    <td>current Address</td>
                                    <td><?php echo $results[0]['current_address']; ?></td>
                                </tr> 
                                <tr>
                                    <td>Permanent address</td>
                                    <td><?php echo $results[0]['permenent_address']; ?></td>
                                </tr> 
                                <tr>
                                    <td>Postal Address</td>
                                    <td><?php echo $results[0]['postal_address']; ?></td>
                                </tr> 
                                <tr>
                                    <td>City</td>
                                    <td><?php echo $results[0]['city_name']; ?></td>
                                </tr> 
                                <tr>
                                    <td>Mobile Number</td>
                                    <td><?php echo $results[0]['mob_number']; ?></td>
                                </tr> 
                            </table>
                        <?php } ?>
                    </div>
                    <div class="col-lg-12">
                        <br/><br/><br/><br/><br/><br/>
                        <?php
                        if ($results[0]['sub_cat_id'] == 3) {
                            ?>
                            <div style="width:100%;border: 1px solid black;">
                                <h3 style="text-align:center;margin-top: 5px;margin-bottom: 5px;">CERTIFICATE FROM THE HEAD OF THE INSTITUTE</h3>
                                <p style="text-align:center">(Please issue to those student who did not avail/receive any kind of scholarship during calender year <?php echo date('Y'); ?>)</p>
                            </div>

                            <p style="margin-top:20px;line-height: 2.5;">
                                It is certified that Mr./Mrs. _________________________________________________________ s/d/w of Mr._________________________________________ is regular/bonafide student of this institute, studying in Class/Degree Title/Discipline __________________________________________ Part/Semester _____________________, and did not avail any kind of scholarship for the present class/semester 
                            </p>
                            <br/>
                            <p style="line-height: 2.5;"><span style="font-weight:bold;">Name and Address of the Institute</span>_______________________________________________________________<br/>_________________________________________________________________________________________________</p>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo $this->request->webroot . 'img/attest.jpg' ?>">
                        <?php } ?>
                    </div>
                    <ul>
                        <li class="d_msg">
                            <?php echo $results[0]['description']; ?>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- /Confirmation -->
        </div>
        <div class="row">
            <div class="col-sm-12" style="padding:25px;background-color: #eee6;margin-bottom: 20px">
                <a class="btn btn-success" href="<?php echo $this->request->webroot ?>">Back</a>
                <input type='button' id='btn' class="btn btn-success" value='Print' onclick="javascript:printDiv('DivIdToPrint')">
            </div>
        </div>
    </body>
</html>
