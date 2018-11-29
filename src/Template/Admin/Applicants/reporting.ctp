<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>css/jquery-ui.css">
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/jquery.min.js"></script>
<script>
    var pageStyle = 'landscape';
    function dateField() {
        if ($('#date_field').prop('checked')) {
            return {text: ' Date __________________\n', bold: true, fontSize: 14, alignment: 'right'};
        } else {
            return '';
        }
    }
    function header() {
        var header_text = '';
        if ($('#dynamic-header').val() == '') {
            header_text += "List Of " + $("#applicant_status option:selected").text() + ' Applicants of ' + $("#fundlist option:selected").text() + " for year " + $("#fundyear option:selected").text();
            if ($('#city').length != 0 && $('#city').val() != '') {
                header_text += ', District: ' + $("#city option:selected").text();
            }
            if ($('#religion').length != 0 && $('#religion').val() != '') {
                header_text += ', Religion: ' + $("#religion option:selected").text();
            }
            if ($('#cnic').length != 0 && $('#cnic').val() != '') {
                header_text += ', CNIC: ' + $("#cnic").val();
            }
        } else {
            header_text = $('#dynamic-header').val();
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
    .small_summary{
        /*display:block;*/
        margin-bottom: 10px;
        font-size: 16px;
        color:green;
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
                            <div class="form-line col-lg-3">
                                <?php echo $this->Form->control('fundsyear', ['id' => 'fundyear', 'options' => $fundslist, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                                <small class="myspan">select year</small>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $this->Form->control('fundslist', ['id' => 'fundlist', 'options' => '', 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                                <small class="myspan">select fund</small>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $this->Form->control('status', ['id' => 'applicant_status', 'options' => ['all' => 'All', 'selected' => 'Selected', 'notselected' => 'Not Selected', 'distributed' => 'Distributed'], 'class' => 'form-control show-tick', 'label' => false]); ?>
                                <small class="myspan">select applicant's status</small>
                            </div>
                            <div class="form-line col-lg-3">
                                <?php echo $this->Form->control('city', ['empty' => 'Select District', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $cities]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-line col-lg-3">
                                <br/>
                                <?php echo $this->Form->control('religion', ['empty' => 'Select Religion', 'class' => 'form-control show-tick show sub_categ', 'label' => false, 'options' => $religions]); ?>
                            </div>
                            <div class="form-line col-lg-3">
                                <br/>
                                <?php echo $this->Form->control('cnic', ['placeholder' => 'Search by cnic', 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                                <small class="myspan">CNIC with dashes</small>

                            </div>
                            <div class="form-line col-lg-3">
                                <br/>
                                <?php echo $this->Form->control('token', ['placeholder' => 'Search by Token number', 'class' => 'form-control show-tick show sub_categ', 'label' => false]); ?>
                            </div>
                            <div class="col-lg-3">
                                <br/>
                                <?php
                                echo $this->Form->control('gender', ['label' => false, 'type' => 'radio', 'label' => false, 'escape' => false, 'options' => array('male' => '&nbsp;Male', 'female' => '&nbsp;Female', '' => '&nbsp;Both'), 'templates' => [
                                        'nestingLabel' => '{{hidden}}<div class="col-lg-4">{{input}}<label{{attrs}}>{{text}}</label></div>',
                                        'radioWrapper' => '{{label}}'
                                ]]);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-line col-lg-3">
                                <!--<br/>-->
                                <?php echo $this->Form->control('user_id', ['class' => 'form-control datepicker', 'empty' => 'All Users', 'options' => $users_have_access, 'label' => false]); ?>
                                <small class="myspan">Select to view record inserted by user</small>
                            </div>
                            <div class="form-line col-lg-3">
                                <!--<br/>-->
                                <?php echo $this->Form->control('sdate', ['class' => 'form-control datepicker', 'placeholder' => 'From Date', 'label' => false]); ?>
                            </div>
                            <div class="form-line col-lg-3">
                                <!--<br/>-->
                                <?php echo $this->Form->control('edate', ['class' => 'form-control datepicker', 'placeholder' => 'To Date', 'label' => false]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="margin:10px 0;">
                            <div class="col-lg-12">
                                <p style="color:gray;margin-bottom:10px;">Select fields to include in table</p>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Created By', ['value' => 'created_by', 'secure' => false, 'id' => 'created_by', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="created_by">Created By(operator)</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Modified By', ['value' => 'modified_by', 'secure' => false, 'id' => 'modified_by', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="modified_by">Modified By(operator)</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Monthly Income', ['value' => 'monthly_income', 'secure' => false, 'id' => 'monthly_income', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="monthly_income">Income</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Family Members', ['value' => 'dependent_family_members', 'secure' => false, 'id' => 'dependent_family_members', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="dependent_family_members">Family Members</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Current Address', ['value' => 'current_address', 'secure' => false, 'id' => 'current_address', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="current_address">Current Address</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Permenent Address', ['value' => 'permenent_address', 'secure' => false, 'id' => 'permenent_address', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="permenent_address">Permenent Address</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Postal Address', ['value' => 'postal_address', 'secure' => false, 'id' => 'postal_address', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="postal_address">Postal Address</label>
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
                                <?php echo $this->Form->checkbox('fields.Cheque Number', ['value' => 'check_number', 'secure' => false, 'id' => 'check_number', 'hiddenField' => false, 'class' => 'filled-in']); ?>
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
                                <?php echo $this->Form->checkbox("fields.Applicant's Signature", ['secure' => false, 'id' => 'signature', 'hiddenField' => false, 'class' => 'filled-in']); ?>
                                <label for="signature">Signature</label>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Form->checkbox('fields.Review', ['secure' => false, 'id' => 'remarks', 'hiddenField' => false, 'class' => 'filled-in']); ?>
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
                        <div class="header" style="padding:15px 20px 0 20px;border-top: 1px solid rgba(204, 204, 204, 0.35);border-bottom: none;background-color: #eee4;">
                            <span class="small_summary" id="t_amount">Amount to distribute : <?php echo ($count_amount[0]['total_amount'] != null) ? $count_amount[0]['total_amount'] : '0' ?></span>
                            <br/>
                            <span class="small_summary" id="t_applicant">Total Applicants : <?php echo ($count_amount[0]['total_applicants'] != null) ? $count_amount[0]['total_applicants'] : '0'; ?></span>
                            <br/><br/>
                        </div>
                        <div class="body" style="padding: 8px 20px;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col" style="width:75px;">Token No</th>
                                            <th scope="col" style="width: 130px">Applicant Name</th>
                                            <th scope="col">Father/Husband Name</th>
                                            <th scope="col">CNIC</th>
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
                                                    if ($k == 'Review') {
                                                        ?>
                                                        <th scope="col">Review&nbsp;|&nbsp;Remarks</th>
                                                    <?php } else { ?>
                                                        <th scope="col"><?php echo $k; ?></th>
                                                        <?php
                                                    }

                                                endforeach;
                                            }
                                            ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($results as $key => $result):
                                            ?>
                                            <tr>
                                                <td></td>
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
                                                        <td scope="col">
                                                            <?php echo ($df=='created_by'||$df=='modified_by')? $users_have_access[$result[$df]]:@$result[$df]; ?>
                                                        </td>
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

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" style="margin:100px auto;width:750px">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: 1px solid #eee;padding: 10px 25px 10px 25px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Set Header For PDF</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12" style="margin-bottom:10px;">
                                <?php echo $this->Form->control('dynamic_header', ['class' => 'form-control', 'placeholder' => 'Enter text to be displayed on PDF header', 'label' => false]); ?>
                            </div>
                            <div class="col-lg-12" style="margin-bottom:10px;">
                                <?php echo $this->Form->checkbox('date_field', ['secure' => false, 'id' => 'date_field', 'hiddenField' => false, 'class' => 'filled-in', 'checked']); ?>
                                <label for="date_field">Check the field to display Date on PDF</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Done</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>


