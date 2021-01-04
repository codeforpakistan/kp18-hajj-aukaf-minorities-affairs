<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>
    var pageStyle = 'landscape';
    function dateField() {
        return {text: ' Date __________________\n', bold: true, fontSize: 14, alignment: 'right'};
    }
    function header() {
        var header_text = "List Of " + $("#applicant_status option:selected").text() + ' Applicants of ' + $("#fundlist option:selected").text() + " for year " + $("#fundyear option:selected").text();
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
    function subcat(fund_id) {

        $.ajax({
            type: "GET",
            contentType: 'json',
            url: "services",
            data: "fund_subcategory=" + fund_id,
            success: function (data) {
                if (data == 2) {
                    $("#marriage_grant").show();
                } else {
                    $("#marriage_grant").hide();
                    $("#marriage_grant :input").prop('checked', false);
                }
                if (data == 4) {
                    $("#health_grant").show();
                } else {
                    $("#health_grant").hide();
                    $("#health_grant :input").prop('checked', false);
                }
            }, error: function (error) {
                alert(json.stringify(error));
            }
        });

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
                    if ($('#fundlist').val() != '') {
                        subcat($('#fundlist').val());
                    }
                }

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }

    $(function () {
        $("#check_all").click(function () {
            $('input:checkbox[name^=fields]:visible').prop('checked', this.checked);
        });
        $('#fundlist').change(function () {
            subcat($(this).val());
        });
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
                    <h4 style="padding: 15px 15px;">Reporting</h4>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('city', ['empty' => 'Select District', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $cities]); ?>
                            </div>
                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('religion', ['empty' => 'Select Religion', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $religions]); ?>
                            </div>
                            <!--                        <div class="form-line col-lg-3" style="padding-left: 25px;padding-right:0;">
                                                        <br/>
                            <?php // echo $this->Form->control('fund_id', ['empty' => 'Select Funds', 'class' => 'form-control show-tick show sub_categ', 'id' => 'fund_id', 'label' => false, 'options' => @$funds]);  ?>
                                                    </div>-->

                            <div class="form-line col-lg-4">
                                <br/>
                                <?php echo $this->Form->control('cnic', ['placeholder' => 'Search by cnic', 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                                <small class="myspan">CNIC with dashes</small>

                            </div>
                            <div class="form-line col-lg-4">
                                <!--<br/>-->
                                <?php echo $this->Form->control('token', ['placeholder' => 'Search by Token number', 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="margin:10px 0;">
                            <div class="col-lg-12">
                                <p style="color:gray;margin-bottom:10px;">Select fields to include in table</p>
                            </div>
                            <?php
//                            $this->Form->unlockField('fields.monthly_income');
                            ?>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Monthly Income', ['value' => 'monthly_income', 'secure' => false, 'id' => 'monthly_income', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="monthly_income">Income</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Family Members', ['value' => 'dependent_family_members', 'secure' => false, 'id' => 'dependent_family_members', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="dependent_family_members">Family Members</label>
                            </div>
                            <div id="health_grant"  style="display:none">
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Disease', ['value' => 'disease', 'secure' => false, 'id' => 'disease', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="disease">Disease</label>
                                </div>
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Doctor Name', ['value' => 'dname', 'secure' => false, 'id' => 'dname', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="dname">Doctor Name</label>
                                </div>
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Doctor Contact', ['value' => 'dcontact', 'secure' => false, 'id' => 'dcontact', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="dcontact">Doctor contact</label>
                                </div>
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Clinic Address', ['value' => 'clinic_address', 'secure' => false, 'id' => 'clinic_address', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="clinic_address">Clinic Address</label>
                                </div>
                            </div>
                            <!--                        </div>
                                                    <div class="col-lg-12" style="margin:10px 0;">-->
                            <div id="marriage_grant" style="display:none">
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Groom Name', ['value' => 'gname', 'secure' => false, 'id' => 'gname', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="gname">Groom Name</label>
                                </div>
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Groom Father Name', ['value' => 'gfather_name', 'secure' => false, 'id' => 'gfather_name', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="gfather_name">Groom Father Name</label>
                                </div>
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Groom CNIC', ['value' => 'gcnic', 'secure' => false, 'id' => 'gcnic', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="gcnic">Groom CNIC</label>
                                </div>
                                <div class="col-lg-2">
                                    <?php echo $this->Form->checkbox('fields.Groom Contact', ['value' => 'gcontact', 'secure' => false, 'id' => 'gcontact', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                    <label for="gcontact">Groom Contact</label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Amount Recived', ['value' => 'amount_recived', 'secure' => false, 'id' => 'amount_recived', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="amount_recived">Amount Received</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Check Number', ['value' => 'check_number', 'secure' => false, 'id' => 'check_number', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="check_number">Cheque No</label>
                            </div>
                            <!--                        </div>
                            
                                                    <div class="col-lg-12" style="margin:10px 0;">-->
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Appling Date', ['value' => 'appling_date', 'secure' => false, 'id' => 'appling_date', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="appling_date">Applying Date</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Payment Date', ['value' => 'payment_date', 'secure' => false, 'id' => 'payment_date', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="payment_date">Payment Date</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Signature', ['secure' => false, 'id' => 'signature', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="signature">Signature</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Remarks', ['secure' => false, 'id' => 'remarks', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="remarks">Remarks</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('checkall', ['secure' => false, 'id' => 'check_all', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="check_all" style="font-weight:bold;font-size: 14px;">Check All</label>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <!--<br/>-->
                                <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                            </div>
                        </div>

                    </div>
                    <br/>
                    <?php
                    echo $this->Form->end();
                    if (isset($results)) {
                        ?> 
                        <div class="header">
                            <h2>
                                Result of all selected applicants
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col" style="width:75px;">Token No</th>
                                            <th scope="col" style="width: 130px">Applicant Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Cnic</th>
                                            <?php if ($results[0]['sub_cat'] == 3) { ?>
                                                <th scope="col">Qualification</th>
                                                <th scope="col">Discipline</th>
                                                <th scope="col">Percentage</th>
                                                <th scope="col">Recent Class</th>
                                                <th scope="col">Current Class</th>
                                            <?php } ?>
                                            <th scope="col">District</th>
                                            <th scope="col">Religion</th>
                                            <?php
                                            if (isset($this->request->data['fields'])) {
                                                foreach ($this->request->data['fields'] as $k => $df):
                                                    ?>
                                                    <th scope="col"><?php echo $k; ?></th>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($results as $key => $result):
//                                            debug($result);
                                            ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= h($result['af_id']) ?></td>
                                                <td><?= ucfirst($result['app_name']) ?></td>
                                                <td><?= ucfirst($result['father_name']) ?></td>
                                                <td><?= h($result['cnic']) ?></td>
                                                <!--<td>< h($result['gender']) ?></td>-->

                                                <?php if ($result['sub_cat'] == 3) { ?>
                                                    <td><?= $result['qualification_name']; ?></td>
                                                    <td><?= $result['discipline']; ?></td>
                                                    <td><?= $result['percentage']; ?></td>
                                                    <td><?= $result['recent_class']; ?></td>
                                                    <td><?= $result['current_class']; ?></td>
                                                <?php } ?> 

                                                <td><?= h($result['city_name']) ?></td>
                                                <td><?= h($result['religion_name']) ?></td>
                                                <?php
                                                if (isset($this->request->data['fields'])) {
                                                    foreach ($this->request->data['fields'] as $k => $df):
                                                        ?>
                                                        <td scope="col"><?php echo @$result[$df]; ?></td>
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>


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
                    <br/>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>