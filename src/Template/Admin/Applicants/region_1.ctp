<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

<script>
    var pageStyle='portrait';
     function dateField(){
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
                    <?= $this->Form->create('search') ?>
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

                    </div>
                    <!--                    <div class="row">
                                            <div class="form-line col-lg-4" style="padding-left:25px; padding-right:0;">
                                                <br/>
                    <?php // echo $this->Form->control('category', ['type'=>'radio','class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                                            </div>
                                                                    <div class="form-line col-lg-4" style="padding-left:25px; padding-right:0;">
                                                                        <br/>
                    <?php // echo $this->Form->control('city', ['empty' => 'Select District', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $cities]); ?>
                                                                    </div>
                                                                    <div class="form-line col-lg-4" style="padding-right:0;">
                                                                        <br/>
                    <?php // echo $this->Form->control('religion', ['empty' => 'Select Religion', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $religions]); ?>
                                                                    </div>
                                        </div>-->

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
                                District report
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col">City Name</th>
                                            <th scope="col">No's of Applicant</th>
                                            <th>Remarks</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($district_wise as $dist):
//                                            debug($result);
                                            ?>
                                            <tr>
                                                <td><?php echo $dist['city_name'] ?></td>
                                                <td><?php echo $dist['total'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>

                                <br/>

                            </div>
                        </div>
                    <?php }
                    ?>
                     <?php
                    if (isset($gender_wise)) {
                        ?> 
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="min-width: 130px">Gender</th>
                                            <th scope="col" style="min-width: 130px">Applicants</th>
                                            <th>Remarks</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($gender_wise as $gen):
//                                            debug($result);
                                            ?>
                                            <tr>
                                                <td><?php echo $gen['gender'] ?></td>
                                                <td><?php echo $gen['total'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>

                                <br/>

                            </div>
                        </div>
                    <?php }
                    ?>
                    <?php
                    if (isset($religion_wise)) {
                        ?> 
                        <div class="header">
                            <h2>
                                Religion report
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="min-width: 130px">Religion Name</th>
                                            <th scope="col" style="min-width: 130px">No's of Applicants</th>
                                            <th>Remarks</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($religion_wise as $rel):
//                                            debug($result);
                                            ?>
                                            <tr>
                                                <td><?php echo $rel['religion_name'] ?></td>
                                                <td><?php echo $rel['total'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>

                                <br/>

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