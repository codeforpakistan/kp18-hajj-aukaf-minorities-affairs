<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Auqaf, hajj, Religious & Minority Affairs</title>
        <!--<link rel="icon" href="<?php // echo $this->request->webroot;                ?>img/index.png" type="image/x-icon">-->
        <!-- Latest compiled and minified CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--> 
        <script language="javascript" type="text/javascript">
            function printDiv(divID) {
                //Get the HTML of div
//                var divElements = $('#'+divID).innerHTML;
                var divElements = document.getElementById(divID).innerHTML;

                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                        "<html><head><title></title></head><body>" +
                        divElements + "</body>";

                //Print Page
                window.print();

                //Restore orignal HTML
                document.body.innerHTML = oldPage;
            }
            window.onafterprint = function () {
//                alert('yes');
                window.location = "<?php echo $this->request->webroot; ?>";
            }
        </script>


    </head>
    <body>

        <div id="DivIdToPrint">
            <!--=== Confirmation ===-->

            <div style="margin-left:20px;">
                <div style="width: 100%">

                    <div style="width: 20%;padding: 5px 0px 10px 0px;float: left;">
                        <!--<a class="col-sm-10" href="">-->
                        <img style="height: 100%;" src="<?php echo $this->request->webroot ?>img/logo.png" alt="logo" />
                        <!--</a>-->
                    </div>
                    <div  style="width: 80%;color:white; float: left;">
                        <h2 style="color:green;font-size: 28px;">Auqaf, Hajj, Religious & Minority Affairs</h2>
                    </div>
                </div>

                <h3  style="color:#117D2C;clear:both; padding-top: 20px " >Personal Info</h3>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Token number:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['af_id']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">CNIC:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['cnic']; ?></p>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Name:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['app_name']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Father Name</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['father_name']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Religion:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['religion_name']; ?></p>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Gender:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['gender']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Marital Status:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['status']; ?></p>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Profession:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['profession']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Monthly Income:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['monthly_income']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Family members:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['dependent_family_members']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">current Address:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['current_address']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Permanent address:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['permenent_address']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Postal Address:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['postal_address']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">City:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['city_name']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Mobile Number:</label>
                    <div class="col-md-5">
                        <p><?php echo $results[0]['mob_number']; ?></p>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                    <label class="control-label col-md-3">Applied on: </label>
                    <div class="col-md-5">
                        <p><?php echo date('M-d-Y', strtotime($results[0]['appling_date'])); ?></p>
                    </div>
                </div>

            </div>
            <!-- /Confirmation -->
        </div>
        <div class="row">
            <div class="col-sm-12">
                <input type='button' id='btn' class="btn btn-success" value='Print' onclick="javascript:printDiv('DivIdToPrint')">
            </div>

        </div>

    </body>
</html>
