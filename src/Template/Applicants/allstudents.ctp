<?php
//debug();exit();
?>
<div id="content">
    <div class="container">
        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= $this->request->webroot; ?>Institutes/add">Profile</a>
                </li>
               
                <li class="current">
                    <a href="#" title="">Students</a>
                </li>
            </ul>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12" style="padding:0 25px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $this->Flash->render(); ?>
                                    </div>
                                    <br/>
                                    <h4 style="font-weight: bold;">List Of All Minority Students</h4>
                                    <br/>
                                    <table id="student_table" class="table table-responsive table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <!--<th>S.No</th>-->
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>Father CNIC</th>
                                                <th>Class</th>                                                
                                                <th>Domicile</th>
                                                <th>Religion</th>
                                                <th>Gender</th>
                                                <th>Contact Number</th>
                                                <th>Address</th>                                                
                                                <th>City</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $instituteclass):
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $instituteclass['app_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass['father_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass['cnic']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass['class_number']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass['domicile']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass['religion_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $instituteclass['gender']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $instituteclass['mob_number'];
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        echo $instituteclass['current_address'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $instituteclass['city_name'];
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div> 
                                <!-- /.row -->
                            </div> <!-- /.widget-content -->
                        </div> <!-- /.widget -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.tab-content -->
                <!--</div>-->
                <!--END TABS-->
            </div>
        </div> <!-- /.row -->

        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>