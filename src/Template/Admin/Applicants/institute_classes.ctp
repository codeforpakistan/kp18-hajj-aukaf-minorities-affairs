<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

<script>
    function funds_val(y) {
        $.ajax({
            type: 'GET',
            url: 'fundlist',
            data: 'fundofinstitute=' + y,
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
                    var fa = <?php echo isset($_GET['fundslist']) ? $_GET['fundslist'] : ''; ?>
                    $('#fundlist').append('<option value="">Select Fund</option>');
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
    function select_institute(y) {
        $.ajax({
            type: 'GET',
            url: 'fundlist',
            data: 'fund_id=' + y,
            contentType: 'json',
            success: function (data)
            {
                var data = JSON.parse(data);
                if ($.isEmptyObject(data))
                {
                    $('#institute_id').empty();
                } else
                {
                    $('#institute_id').empty();
                    var fa = <?php echo isset($this->request->data['institute_id']) ? $this->request->data['institute_id'] : ''; ?>
                    $('#institute_id').append('<option value="">Select Institute</option>');
                    $.each(data, function (key, value) {
                        var s = '';
                        console.log(value.id);
                        if (value.id == fa) {
                            var s = 'selected';
                        }
                        var Option = "<option value='" + value.id + "' " + s + ">" + value.institute_name + " </option>";
                        $('#institute_id').append(Option);
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
        $('#fundlist').change(function () {
            var value = $(this).val();
            if (value != "") {
                select_institute(value);
            } else
            {
                $('#institute_id').empty();
                $('#institute_id').append("<option value=''>--Select--</option>");
            }
        });
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
    .remove_margin_bottom{
        margin-bottom: unset !important;
    }
    .col-lg-4{
        margin-bottom: unset !important;
    }

</style>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Institutes classes 
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Reports of institute classes
                        </h2>
                    </div>
                    <div class="body">
                        <?= $this->Form->create(false, ['type' => 'get']) ?>
                        <div class="row">
                            <div class="col-lg-12 remove_margin_bottom">
                                <div class="col-lg-4">
                                    <?php echo $this->Form->control('fundsyear', ['id' => 'fundyear', 'options' => $fundslist, 'class' => 'form-control show-tick', 'label' => false, 'required']); ?>
                                    <small class="myspan">select year</small>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->control('fundslist', ['id' => 'fundlist', 'empty' => 'Select Fund', 'options' => $funds, 'class' => 'form-control show-tick', 'label' => false, 'value' => isset($_GET['fundslist']) ? $_GET['fundslist'] : '', 'required']); ?>
                                    <small class="myspan">select fund</small>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->control('institutes', ['id' => 'institute_id', 'empty' => 'Select Institute', 'options' => $ins_array, 'class' => 'form-control show-tick', 'label' => false, 'value' => isset($_GET['institutes']) ? $_GET['institutes'] : '', 'required']); ?>
                                    <small class="myspan">select Institute</small>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <button class="btn btn-primary waves-effect" type="submit" id="submit">SUBMIT</button>
                                </div>
                            </div>
                        </div>

                        <?php
                        echo $this->Form->end();
                        if (isset($institutes)) {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Class</th>
                                            <th scope="col">Total Students</th>
                                            <th scope="col">Minority Students</th>
                                            <th scope="col">Needy Students</th>
                                            <th scope="col">Textbook Cost</th>
                                            <th>Boys Uniform cost</th>
                                            <th scope="col">Girls Uniform cost</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($institutes as $institute):
                                            ?>
                                            <tr>
                                                <td><?= h($institute['class_number']); ?></td>
                                                <td><?= $institute['total_students'] ?></td>
                                                <td><?= $institute['minority_students'] ?></td>
                                                <td><?= $institute['needy_students'] ?></td>
                                                <td><?= $institute['textbook_cost'] ?></td>
                                                <td><?= $institute['boys_uniform'] ?></td>
                                                <td><?= $institute['girls_uniform']; ?></td>
                                                
                                                <td></td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>



