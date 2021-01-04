<?php
$personal_active = 'active';
$education_active = '';
//debug();exit();
//if ($this->request->session()->read('qualification_info') != null) {

if (isset($_GET['success']) && $_GET['success'] <> '') {
    $personal_active = '';
    $education_active = 'active';
}
$progress_bar = 10;

if (!empty($applicant) || $applicant <> null) {
    $progress_bar += 50;
    if (!empty($applicant->qualifications) || $applicant->qualifications <> null) {
        $progress_bar += 30;
    }
}
//debug($applicant->qualifications);exit;
//debug($progress_bar);
//exit;
?>
<div id="content">
    <div class="container">

        <!-- Breadcrumbs line -->
        <div class="crumbs">
            <ul id="breadcrumbs" class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?= $this->request->webroot; ?>Applicants/dashboard">Dashboard</a>
                </li>
                <li class="current">
                    <a href="#" title="">My Profile</a>
                </li>

        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-success" style="width: <?= $progress_bar ?>%"></div>
                    <p style="text-align:right;"><?= $progress_bar ?>%</p>
                </div>
                <!-- Tabs-->
                <div class="tabbable tabbable-custom tabbable-full-width">
                    <ul class="nav nav-tabs">
                        <!--<li class="active"><a href="#tab_overview" data-toggle="tab">Overview</a></li>-->
                        <li class="<?= $personal_active ?>"><a style="font-size: 12px;" href="#personal_info" data-toggle="tab">Personal Detail</a></li>
                        <?php if ($applicant <> null || $applicant <> '') { ?>
                            <li class="<?= $education_active ?>"><a style="font-size: 12px;" href="#education" data-toggle="tab">Education</a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content row">
                        <div class="col-md-12">
                            <?= $this->Flash->render() ?>
                        </div>
                        <?php echo $this->element('personal_info', ['personal_active' => $personal_active]); ?>

                        <?php
                        if ($applicant <> null || $applicant <> '') {
                            echo $this->element('educational_info', ['education_active' => $education_active]);
                        }
                        ?>

                    </div> <!-- /.tab-content -->
                </div>
                <!--END TABS-->
            </div>
        </div> <!-- /.row -->
        <!-- /Page Content -->
    </div>
    <!-- /.container -->

</div>