<?php
use Cake\Datasource\ConnectionManager;
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>
    var pageStyle = 'portrait';
    function dateField() {
        return '';
    }
    function header() {
        var header_text = "List Of " + $("#applicant_status option:selected").text() + ' Applied Applicants From  Different Districts to ' + $("#fundlist option:selected").text();
        if ($('#city').length != 0 && $('#city').val() != '') {
            header_text += ', District: ' + $("#city option:selected").text();
        }
        if ($('#religion').length != 0 && $('#religion').val() != '') {
            header_text += ', Religion: ' + $("#religion option:selected").text();
        }
        if ($('#cnic').length != 0 && $('#cnic').val() != '') {
            header_text += ', CNIC: ' + $("#cnic").val();
        }
        return header_text;

    }
    function funds_val(y) {
        $.ajax({
            type: 'GET',
            url: 'fundlist',
            data: 'value=' + y,
            contentType: 'json',
            success: function (data)
            {
                var data = JSON.parse(data);
                if ($.isEmptyObject(data))
                {
                    $('#fundlist').empty();
                } else
                {
                    $('#fundlist').empty();
                    var fa = <?php echo isset($this->request->data['fundslist']) ? $this->request->data['fundslist'] : ''; ?>

                    $.each(data, function (key, value) {
                        var s = '';
                        if (value.id == fa) {
                            var s = 'selected';
                        }
                        var Option = "<option value='" + value.id + "' " + s + ">" + value.fund_name + " </option>";
                        $('#fundlist').append(Option);
                    });

                }

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }

    $(function () {
        if ($('#fundyear').val()) {
            funds_val($('#fundyear').val());
        }

        $('#fundyear').change(function () {
            var value = $(this).val();
            if (value != "") {
                funds_val(value);
            } else
            {
                $('#fundlist').empty();
                $('#fundlist').append("<option value=''>--Select--</option>");
            }

        });


    });
</script>

<style>
    .table-responsive {
        overflow-x: unset !important;
    }
    #DataTables_Table_0_wrapper{
        overflow: auto;
    }
    #DataTables_Table_0{
        background-color: white; 
    }
    .myspan{
        margin-left: 15px;
        color:gray;
        font-style: italic;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <h4 style="padding: 15px 15px;">Generate Region/Religion wise Reporting</h4>
                    <?= $this->Form->create('search', ['type' => 'GET']) ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-line col-lg-4">
                                <?php echo $this->Form->control('fundsyear', ['id' => 'fundyear', 'options' => $fundslist, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                                <small class="myspan">select year</small>
                            </div>
                            <div class="col-sm-4">
                                <?php echo $this->Form->control('fundslist', ['id' => 'fundlist', 'options' => '', 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                                <small class="myspan">select fund</small>

                            </div>
                            <div class="col-sm-4">
                                <?php echo $this->Form->control('status', ['id' => 'applicant_status', 'options' => ['all' => 'All', 'selected' => 'Selected', 'notselected' => 'Not Selected', 'distributed' => 'Distributed'], 'class' => 'form-control show-tick', 'label' => false]); ?>
                                <small class="myspan">select applicant's status</small>

                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="col-sm-6">
                                <?php echo $this->Form->control('sdate', ['class' => 'form-control datepicker', 'placeholder' => 'From Date', 'label' => false, 'value' => isset($_GET['sdate']) ? $_GET['sdate'] : '']); ?>
                            </div>
                            <div class="col-sm-6">
                                <?php echo $this->Form->control('edate', ['class' => 'form-control datepicker', 'placeholder' => 'To Date', 'label' => false, 'value' => isset($_GET['edate']) ? $_GET['edate'] : '']); ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <br/>
                                <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                                <br/><br/>
                            </div>  
                        </div>  
                    </div>
                    <?php
                    echo $this->Form->end();
                    if (isset($district_wise)) {
                        ?> 
                        <div class="header">
                            <h2>
                                Gender report
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="min-width: 130px">Gender</th>
                                            <th scope="col" style="min-width: 130px">Applicants</th>
                                            <th>Remarks</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $g_t = 0;
                                        foreach ($gender_wise as $gen):
                                            $g_t += $gen['total'];
//                                            debug($result);
                                            ?>
                                            <tr>
                                                <td><?php echo ucwords($gen['gender']); ?></td>
                                                <td><?php echo $gen['total'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td style="text-align:right;">Total: </td>
                                            <td><?php echo $g_t ?></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>

                                <br/>

                            </div>
                        </div>

                        <div class="header">
                            <h2>
                                Religion report
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="min-width: 130px">Religion Name</th>
                                            <th scope="col" style="min-width: 130px">No's of Applicants</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $r_t = 0;
                                        foreach ($religion_wise as $rel):
                                            $r_t += $rel['total'];
                                            ?>
                                            <tr>
                                                <td><?php echo $rel['religion_name'] ?></td>
                                                <td><?php echo $rel['total'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td style="text-align:right;">Total: </td>
                                            <td><?php echo $r_t ?></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="header">
                            <h2>
                                District report
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">District</th> 
                                            <th scope="col">Religion wise</th>
                                            <th scope="col">Total Applicant</th>
                                            <th>Remarks</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $d_t = 0;
                                        foreach ($district_wise as $dist):
                                            $d_t += $dist['total'];
                                            $each_religion = $conn->execute(
                                                    'SELECT r.religion_name as religion_name,count(ap.religion_id) as total FROM applicant_funddetails as af'
                                                    . ' INNER JOIN applicants as ap ON ap.id=af.applicant_id '
                                                    . ' INNER JOIN religions as r ON r.id=ap.religion_id '
                                                    . ' INNER JOIN applicantaddresses as aad ON ap.id=aad.applicant_id'
                                                    . ' INNER JOIN cities as c ON c.id=aad.city_id'
                                                    . ' where aad.city_id=' . $dist['city_id'] . ' AND af.fund_id=' . $_GET['fundslist'] . '  GROUP BY ap.religion_id');

                                            $r_wise = $each_religion->fetchAll('assoc');
                                            ?>
                                            <tr>
                                                <td style="display: flex;justify-content: center;align-items: center;min-height:90px;"><?php echo $dist['city_name'] ?></td>
                                                <td>
                                                    <table style="border:1px solid #ccc;border-collapse: collapse;width:100%">
                                                        <?php
                                                        foreach ($r_wise as $value):
                                                            ?>
                                                            <tr>
                                                                <th style="border:1px solid #ccc;"><?php echo $value['religion_name'] ?></th>
                                                                <td style="border:1px solid #ccc;"><?php echo $value['total']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>

                                                </td>
                                                <td><?php echo $dist['total'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td colspan="2" style="text-align:right;">Total: </td>
                                            <td><?php echo $d_t ?></td>
                                            <td></td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php
                                        $g_pdf = '&pdf=1';
                                        if (isset($_GET['pdf'])) {
                                            $g_pdf = '';
                                        }
                                        ?>
                                        <a href="<?php echo $_SERVER['REQUEST_URI'] . $g_pdf ?>" target="_blank" class="btn btn-info">Generate PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>