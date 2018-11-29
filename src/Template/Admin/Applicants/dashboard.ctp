<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/ajax.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/maps.js?key=AIzaSyB2sTxnS9sy-B_UvMRt3Cpqjf-shChqee4&libraries=places&callback=Map"></script>
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        height: 450px;
    }

    .t_app{
        border-right: 1px solid #ddd;
    }
    .analysis{
        margin: unset;
    }

    @media screen and (max-width: 768px) {

        .an{
            margin-top: 175px !important;
        }
    }

    @media screen and (max-width: 500px) {

        .an{
            margin-top: 175px !important;
        }
    }

</style>
<script>
    $(document).ready(function() {

    $('#dist<?php echo $i; ?>').change(function() {

    var value = $(this).val();
    var d = $(this).val();
    var value1 = $('#fund_name<?php echo $i; ?>').val();
    var relig_append =<?php echo $i; ?>;
    if (value != "")
    {
    $.ajax({
    type: 'GET',
            url: 'district',
            data:'value=' + value + '&value1=' + value1,
            contentType: 'json',
            success: function(data)
            {
            //                 alert(JSON.parse(data));

            var data = JSON.parse(data);
            //alert(data);

            if ($.isEmptyObject(data))
            {

            var total_empty = $('#total<?php echo $i; ?>').empty();
            var total1_empty = $('#total1<?php echo $i; ?>').empty();
            var religion_empty = $('#relig<?php echo $i; ?>').empty();
            var app = "<h2  style='margin-left:35%;' >0</h2>";
            var app1 = "0";
            $('#total<?php echo $i; ?>').append(app);
            $('#total1<?php echo $i; ?>').append(app1);
            distct(app1, d, value1, total_empty, religion_empty, relig_append);
            }
            else
            {

            $('#total<?php echo $i; ?>').empty();
            $('#total1<?php echo $i; ?>').empty();
            $.each(data, function(key, value){
            if (value.ap) {
            var app = "<h2  style='margin-left:35%;' id='h2' >" + value.ap + "</h2>";
            var app1 = value.ap;
            distct(app1, d, value1, total_empty, total1_empty, relig_append);
            $('#total<?php echo $i; ?>').append(app);
            $('#total1<?php echo $i; ?>').append(app1);
            }
            else{

            app = "<h2  style='margin-left:35%;' >0</h2>";
            app1 = "0";
            $('#total<?php echo $i; ?>').append(app);
            $('#total1<?php echo $i; ?>').append(app1);
            }

            });
            }
            }, error: function(error) {
    // alert(JSON.stringify(error));
    }


    });
    }
    else
    {
    $('#sub_categ').empty();
    $('#sub_categ').append("<option value=''>--Select--</option>");
    //alert(value);
    }

    });
    });</script>

<section class="content">
    <div class="container-fluid">
        <!-- Google Maps -->
        <div class="block-header">
            <h2>
                Dashboard
            </h2>
        </div>
        <?php
        $i = 0;
        foreach ($funds as $fund):
//            debug($fund);
            ?>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="row" style="padding: 10px;">
                            <div class="col-sm-12 col-xs-12 col-lg-3 col-md-2" style="padding: 5px 20px;float:right;">
                                <?php echo $this->Form->control('Applicantaddresses.city_id', ['empty' => 'Select District', 'id' => 'dist' . $i, 'options' => $city, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-lg-9 col-md-2">
                                <h4 style="margin-left:50px;"><input  type="hidden" id="fund_name<?php echo $i; ?>" value="<?= $fund['fund_name'] ?>" ><?= $fund['fund_name'] ?></h4>
                            </div>
                        </div>

                        <input type="hidden" id="total_ap<?php echo $i; ?>" value="<?php echo $fund['ap'] ?>"/> 
                        <?php
                        $query1 = $conn->execute('SELECT religion_name,count(religion_id) As re,color as co '
                                . ' FROM applicants  as app '
                                . 'inner join applicant_funddetails as det  ON app.id=det.applicant_id '
                                . 'inner join funds as ap ON ap.id=det.fund_id '
                                . 'inner join religions as re ON re.id=app.religion_id '
                                . 'where active=' . 1 . ' AND fund_name= "' . $fund['fund_name'] . '" GROUP BY religion_id');
                        $regs = $query1->fetchAll('assoc');
                        ?>
                        <div class="body" style="border-top:1px solid #ddd;">
                            <div class="table-responsive">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 t_app" >
                                    <div class="col-lg-8"><h4>Total Applicants</h4></div>
                                    <div class="col-lg-12"> <img  style="margin-left:30%; "  src="<?php echo $this->request->webroot; ?>img/users.png"/></div>   
                                    <div class="col-lg-12" id="total<?php echo $i; ?>">
                                        <h2  style="margin-left:35%; "> 
                                            <?php
                                            if ($fund['ap']) {
                                                echo $fund['ap'];
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </h2>
                                    </div>   
                                    <div class="col-lg-12" >
                                        <p  id='' style="margin-left:10%; "><span id="total1<?php echo $i; ?>"> <?php
                                                if ($fund['ap']) {
                                                    echo $fund['ap'];
                                                } else {
                                                    ?>0<?php } ?></span> applied for <?php
                                            if ($fund['ap']) {
                                                echo $fund['fund_name'];
                                            }
                                            ?>
                                        </p>
                                    </div> 
                                </div>
                                <div class="col-lg-3 col-sm-12 col-xs-12 "><h4>Statistics</h4></div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="">
                                    <div id="relig<?php echo $i; ?>">  
                                        <?php
                                        if (isset($regs)) {
                                            foreach ($regs as $reg):;
                                                ?>
                                                <div class="col-lg-3 col-sm-12 col-xs-12" style="margin-bottom: 7px !important;"><?php echo $reg['religion_name']; ?></div>
                                                <div class="progress col-lg-9 col-md-9 col-sm-12 col-xs-12" style="padding:0;margin-bottom: 15px;">
                                                    <div class="progress-bar <?php echo $reg['co']; ?>" title="<?php echo round(($reg['re'] * 100) / $fund['ap']); ?>% total=<?php echo $reg['re'] ?>" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($reg['re'] * 100) / $fund['ap']); ?>%"><?php echo round(($reg['re'] * 100) / $fund['ap']); ?>% total=<?php echo $reg['re'] ?></div>
                                                </div>
                                                <?php
                                            endforeach;
                                        } else {
                                            ?>
                                        </div>
                                        <div class="col-lg-3">Christians</div> 
                                        <div class="progress">
                                            <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"><?php echo round(($reg['re'] * 100) / $fund['ap']); ?>%</div>
                                        </div>
                                        <div class="col-lg-3"> Sikhs</div> 
                                        <div class="progress">
                                            <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%">72%</div>
                                        </div>
                                        <div class="col-lg-3">Kalash</div> 
                                        <div class="progress">
                                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">95%</div>
                                        </div>
                                        <div class="col-lg-3">Ahmadiyas</div> 
                                        <div class="progress">
                                            <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%">87%</div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
        <?php
        $i++;
    endforeach;
    ?>     

    <div class="row clearfix">

        <!-- Bar Chart -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-sm-2" style="float:right;">
<!--                                    <select class="form-control show-tick">
                                <option value="">-- 2018 --</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>-->
                    </div>
                    <h2>Analysis</h2>
                    <ul class="header-dropdown m-r--5">
                        <!--                                <li class="dropdown">
                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li><a href="javascript:void(0);">Action</a></li>
                                                                <li><a href="javascript:void(0);">Another action</a></li>
                                                                <li><a href="javascript:void(0);">Something else here</a></li>
                                                            </ul>
                                                        </li>-->
                    </ul>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12" style="height:100px; margin-top: 40px;">
                    <div class="col-lg-2 col-sm-12 col-xs-12"><b>Applicants</b></div>
                    <div class="col-lg-2 col-sm-12 col-xs-12" style=""><p style="width:20px;height: 20px;float: left; border-radius: 50%;background-color:blue; margin-right:10px; "></p> Education</div>
                    <div class="col-lg-2 col-sm-12 col-xs-12"><p style="width:20px;height: 20px;float: left; border-radius: 50%;background-color:#004d40; margin-right:10px; "></p>Marriage</div>
                    <div class="col-lg-2  col-sm-12 col-xs-12"><p style="width:20px;height: 20px;float: left; border-radius: 50%;background-color:palegoldenrod; margin-right:10px; "></p> ADP</div>
                    <div class="col-lg-2  col-sm-12 col-xs-12"><p style="width:20px;height: 20px;float: left; border-radius: 50%;background-color:powderblue; margin-right:10px; "></p> Health</div>

                </div>
                <div class="analysis an body">
                    <canvas id="bar_chart" height="100"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Bar Chart -->
    </div>
    <!-- Markers -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="col-lg-2 col-sm-6 col-xs-12" style="margin-bottom:10px;float:right;">
                        <?php echo $this->Form->control('fundslist', ['empty' => 'Select funds', 'id' => 'fundlist', 'options' => '', 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                    </div>
                    <div class="col-sm-2 col-sm-6 col-xs-12" style="margin-bottom:10px;float:right;">
                        <?php echo $this->Form->control('fundsyear', ['empty' => 'Select Year', 'id' => 'fundyear', 'options' => $fundslist, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                    </div>
                    <h2>
                        Minorities Locations
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <!--                                <li class="dropdown">
                                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li><a href="javascript:void(0);">Action</a></li>
                                                                <li><a href="javascript:void(0);">Another action</a></li>
                                                                <li><a href="javascript:void(0);">Something else here</a></li>
                                                            </ul>
                                                        </li>-->
                    </ul>
                </div>
                <div class="body " style=" height: 500px;">
                    <div id="map" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

                </div>
            </div>
        </div>
    </div>
    <!-- #END# Markers -->

</div>
</section>

<script>

// This example adds a marker to indicate the position of Bondi Beach in Sydney,
// Australia.
    function initMap(data = null) {

    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
            center: {lat: 34.9526, lng: 72.3311}


    });
    var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
    if (data){
    $.each(data, function(key, value){
    //alert(value.latitude);JSON.stringify

    var lat = parseFloat(value.latitude);
    var lang = parseFloat(value.longitude);
    // alert(lat);
    var beachMarker = new google.maps.Marker({
    position: {lat: lat, lng:lang },
            map: map,
            title: value.city
            //icon: image
    });
    });
    }
    else if (data == ''){
    // alert(data);
    var beachMarker = new google.maps.Marker({
    position: {lat: '', lng:'' },
            map: map,
            title: ''
            //icon: image
    });
    }
    else{
<?php
if (isset($ceety)) {

    foreach ($ceety as $city) {
        ?>
            var beachMarker = new google.maps.Marker({
            position: {lat:<?php echo $city['latitude'] ?>, lng: <?php echo $city['longitude'] ?>},
                    map: map,
                    title: '<?php echo $city['city'] ?>'
            });
        <?php
    }
}
?>

    }
    }
</script>
<script>$(document).ready(function() {
    $('#fundlist').change(function() {
    var value = $(this).val();
    //alert(value);
    //return false;


    if (value != "")
    {
    $.ajax({
    type: 'GET',
            url: 'dashboard_map',
            data: 'value=' + value,
            contentType: 'json',
            success: function(data)
            {

            //  alert(data);
            var data = JSON.parse(data);
            if ($.isEmptyObject(data))
            {
            //alert(data.empty(););

            //data.empty();
            if (data)
            {
            data = "";
            // alert(data);

            initMap(data);
            }

            }
            else
            {

            initMap(data);
            }
            }, error: function(error) {
    // alert(JSON.stringify(error));
    }


    });
    }
    else
    {
    $('#sub_categ').empty();
    $('#sub_categ').append("<option value=''>--Select--</option>");
    //alert(value);
    }

    });
    });</script>


</script>



<script>
    $(document).ready(function() {
    $('#fundyear').change(function() {
    var value = $(this).val();
    //alert(value);
    //return false;


    if (value != "")
    {
    $.ajax({
    type: 'GET',
            url: 'fundlist',
            data: 'value=' + value,
            contentType: 'json',
            success: function(data)
            {

            // alert(data);
            var data = JSON.parse(data);
            if ($.isEmptyObject(data))
            {

            $('#fundlist').empty();
            }
            else
            {

            $('#fundlist').empty();
            var op = "<option value=''> Select funds</option>";
            $('#fundlist').append(op);
            $.each(data, function(key, value){


            var Option = "<option value='" + value.fund_name + "'>" + value.fund_name + " </option>";
            //alert(Option);
            // var value1 = $('#sub_categ').val();
            ///lert(value1+'sub_categ');


            $('#fundlist').append(Option);
            //alert($('#sub_categ').val('h'));  
            //alert('sub_categ='+s.val());
            });
            }
            }, error: function(error) {
    // alert(JSON.stringify(error));
    }


    });
    }
    else
    {
    $('#fundlist').empty();
    $('#fundlist').append("<option value=''>--Select--</option>");
    //alert(value);
    }

    });
    });</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2sTxnS9sy-B_UvMRt3Cpqjf-shChqee4&libraries=places&callback=initMap" async defer></script>
<script>
    $(function () {


    // new Chart(document.getElementById("radar_chart").getContext("2d"), getChartJs('radar'));
    //new Chart(document.getElementById("pie_chart").getContext("2d"), getChartJs('pie'));
    });
    $(document).ready(function() {

    var value = $(this).val();
    //alert(value);
    //return false;


    $.ajax({
    type: 'GET',
            url: 'fundsanalysis',
            data: 'value=' + value,
            contentType: 'json',
            success: function(data)
            {


            var data = JSON.parse(data);
            //alert(data);

            if ($.isEmptyObject(data))
            {




            }
            else
            {
            //alert(data);
            new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar', data));
            }
            }, error: function(error) {
    // alert(JSON.stringify(error));
    }


    });
    });
    function getChartJs(type, data) {
    //alert(data);
    var config = null;
    if (type === 'line') {
    config = {
    type: 'line',
            data: {

            labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                    label: "My First dataset",
                            data: [65, 59, 80, 81, 56, 55, 40],
                            borderColor: 'rgba(0, 188, 212, 0.75)',
                            backgroundColor: 'rgba(0, 188, 212, 0.3)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                            pointBorderWidth: 1
                    }, {
                    label: "My Second dataset",
                            data: [28, 48, 40, 19, 86, 27, 90],
                            borderColor: 'rgba(233, 30, 99, 0.75)',
                            backgroundColor: 'rgba(233, 30, 99, 0.3)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                            pointBorderWidth: 1
                    }]
            },
            options: {
            responsive: true,
                    legend: false
            }
    }
    }
    else if (type === 'bar') {
<?php $count = $total_funds[0]['count']; ?>
    config = {
    type: 'bar',
            data: {
            labels: [<?php foreach ($query_fund1s as $query_fund1s) { ?>"<?php echo $query_fund1s["fund_for_year"]; ?>",<?php } ?> ],
                    datasets: [  <?php foreach ($query_funds as $query_funds) { ?> {

                        label: '<?php echo $query_funds["fund_name"]; ?>',
                                data: [<?php echo $query_funds["fundcount"] * 100 / $count; ?>, ],
                                backgroundColor: 'rgba(0, 188, 212, 0.8)'

                        },<?php } ?>
                    ]


            },
            options: {
            responsive: true,
                    legend: false
            }
    }


    }
    else if (type === 'bar1') {
    config = {
    type: 'bar1',
            data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Number", "December"],
                    datasets: [{
                    label: "Education",
                            data: [65, 59, 80, 81, 56, 55, 40, 30, 48, 40, 20, 10, 45],
                            backgroundColor: 'rgba(0, 188, 212, 0.8)'
                    }, {
                    label: "Marriage",
                            data: [28, 48, 40, 19, 86, 27, 90, 70, 60, 80, 60, 42],
                            backgroundColor: 'rgba(233, 30, 99, 0.8)'
                    },
                    {
                    label: "ADP",
                            data: [28, 48, 40, 19, 86, 27, 90, 70, 60, 80, 60, 42],
                            backgroundColor: 'rgba(233, 30, 99, 0.8)'
                    }

                    ]
            },
            options: {
            responsive: true,
                    legend: false
            }
    }
    }
    else if (type === 'radar') {
    config = {
    type: 'radar',
            data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                    label: "My First dataset",
                            data: [65, 25, 90, 81, 56, 55, 40],
                            borderColor: 'rgba(0, 188, 212, 0.8)',
                            backgroundColor: 'rgba(0, 188, 212, 0.5)',
                            pointBorderColor: 'rgba(0, 188, 212, 0)',
                            pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                            pointBorderWidth: 1
                    }, {
                    label: "My Second dataset",
                            data: [72, 48, 40, 19, 96, 27, 100],
                            borderColor: 'rgba(233, 30, 99, 0.8)',
                            backgroundColor: 'rgba(233, 30, 99, 0.5)',
                            pointBorderColor: 'rgba(233, 30, 99, 0)',
                            pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                            pointBorderWidth: 1
                    }]
            },
            options: {
            responsive: true,
                    legend: false
            }
    }
    }
    else if (type === 'pie') {
    config = {
    type: 'pie',
            data: {
            datasets: [{
            data: [225, 50, 100, 40],
                    backgroundColor: [
                            "rgb(233, 30, 99)",
                            "rgb(255, 193, 7)",
                            "rgb(0, 188, 212)",
                            "rgb(139, 195, 74)"
                    ],
            }],
                    labels: [
                            "Pink",
                            "Amber",
                            "Cyan",
                            "Light Green"
                    ]
            },
            options: {
            responsive: true,
                    legend: false
            }
    }
    }
    return config;
    }
</script>
<!-- Jquery Core Js -->
<script src="<?php echo $this->request->webroot; ?>plugins/jquery/jquery.min.js"></script>


<!-- Chart Plugins Js -->
<script src="<?php echo $this->request->webroot; ?>plugins/chartjs/Chart.bundle.js"></script>

<!-- Custom Js -->



<!-- GMaps PLugin Js -->
<script src="<?php echo $this->request->webroot; ?>plugins/gmaps/gmaps.js"></script>




</body>

</html>
