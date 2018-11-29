<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fund $fund
 */
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>js/ajax.js"></script>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Funds
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit Fund</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href='<?= $this->request->webroot . 'admin/funds'; ?>'>View Funds</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?= $this->Form->create($fund, ['id' => 'form_validation']) ?>

                        <div class="form-group form-float">

                            <div class="form-line">
                                <?php echo $this->Form->control('fund_category_id', ['empty' => 'Select Fund Category', 'options' => $fundCategories, 'id' => 'fund_categ', 'class' => 'form-control show-tick', 'label' => false]); ?>

                            </div>
                        </div>
                        <div class="form-group form-float">

                            <div class="form-line">
                                <?php echo $this->Form->control('sub_category_id', ['empty' => 'Select Fund Sub Category', 'options' => $subCategories, 'id' => 'sub_categ', 'class' => 'form-control show-tick', 'label' => false]); ?>

                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('fund_name', ['class' => 'form-control']); ?>
                                <label class="form-label">Fund Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('total_amount', ['class' => 'form-control']); ?>
                                <label class="form-label">Total Amount</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('fund_for_year', ['class' => 'form-control']); ?>
                                <label class="form-label">Fund For Year</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('institute_students', ['class' => 'form-control']); ?>
                                <label class="form-label">Percent of student per institutes</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo $this->Form->text('last_date', ['class' => 'form-control', 'type' => 'date']); ?>
                                <label class="form-label"></label>
                            </div>
                        </div>

                        <?php echo $this->Form->checkbox('active', ['class' => 'filled-in', 'checked' => 'checked', 'id' => 'remember_me']); ?>

                        <label for="remember_me">Status</label>
                        <br>





                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->


    </div>
</section>



<script>$(document).ready(function () {
        $('#fund_categ').change(function () {
            var value = $(this).val();
            //alert(value);
            //return false;


            if (value != "")
            {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost/cake3.6/admin/funds/subcategory',
                    data: 'value=' + value,
                    contentType: 'json',
                    success: function (data)
                    {

                        // alert(data);
                        var data = JSON.parse(data);


                        if ($.isEmptyObject(data))
                        {

                            $('#sub_categ').empty();


                        } else
                        {

                            $('#sub_categ').empty();

                            $.each(data, function (key, value) {



                                var Option = "<option value='" + value.id + "'>" + value.type_of_fund + " </option>";





                                //alert(Option);
                                // var value1 = $('#sub_categ').val();
                                ///lert(value1+'sub_categ');


                                $('#sub_categ').append(Option);
                                //alert($('#sub_categ').val('h'));  
                                //alert('sub_categ='+s.val());
                            });




                        }
                    }, error: function (error) {
                        // alert(JSON.stringify(error));
                    }


                });
            } else
            {
                $('#sub_categ').empty();
                $('#sub_categ').append("<option value=''>--Select--</option>");
                //alert(value);
            }

        });

    });
</script>






