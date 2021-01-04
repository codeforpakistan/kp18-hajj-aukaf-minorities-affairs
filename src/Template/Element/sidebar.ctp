<style>
    div[class^="test"]
</style>
<?php
$active_p = $active_d = $addapplicant = '';
$action_array = array('index', 'addclass', 'edit', 'addapplicant');
$current_page = $this->request->params['action'];
switch ($current_page):
    case 'profile':
        $active_p = 'my_active';
        break;
    case 'dashboard':
        $active_d = 'my_active';
        break;
    case 'addapplicant':
        $addapplicant = 'my_active';
        break;
endswitch;
?>
<div id="sidebar" class="sidebar-fixed">
    <div id="sidebar-content">
        <!--=== Navigation ===-->
        <ul id="nav">
            <?php
//            debug(in_array($current_page, $action_array));
            if ($auth->user('role_id') == 2) {
                ?>
                <li>
                    <a class="<?= $active_p ?>" href="<?= $this->request->webroot; ?>Applicants/profile">
                        <i class="icon-user"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a class="<?= $active_d ?>" href="<?= $this->request->webroot; ?>Applicants/dashboard">
                        <i class="icon-dashboard"></i>
                        Dashboard
                    </a>
                </li>
            <?php } ?>


            <?php
            if ($auth->user('role_id') == 3) {
                ?>
                <li>
                    <a class="<?= ($this->request->params['controller'] == 'Institutes' && $this->request->params['action'] == 'add') ? 'my_active' : '' ?>" href="<?= $this->request->webroot; ?>Institutes/add">
                        <i class="icon-user" style="font-size: 21px;"></i>
                        Profile
                    </a>
                </li>
                <!--<li>
                                    <a class="<$addapplicant ?>" href="< $this->request->webroot; ?>Applicants/addapplicant">
                                        <i class="icon-user"></i>
                                        Add Applicants
                                    </a>
                                </li>-->
                <li class="<?php echo in_array($current_page, $action_array) ? 'open' : ''; ?>">
                    <a class="<?php echo in_array($current_page, $action_array) ? 'my_active' : ''; ?>" href="javascript:void(0);">
                        <i> 
                            <img   src="<?php echo $this->request->webroot . 'img/availablegrants.svg'; ?>" alt=""  width="24px"/>
                        </i>
                        Available Grants
                    </a>
                    <ul class="sub-menu" style="<?php echo in_array($current_page, $action_array) ? 'display:block;' : 'display:none;'; ?>">
                        <li class="open-default">
                            <?php foreach ($institute_funds as $key => $institute_fund): ?>
                                <a href="javascript:void(0);">
                                    <?php echo $institute_fund; ?>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo $this->request->webroot . 'Instituteclasses/index/' . base64_encode(base64_encode($key)); ?>">
                                            View Classes Details
                                        </a>
                                    </li>
                                </ul>
                            <li>
                                <a href="<?php echo $this->request->webroot . 'Applicants/allstudents/' . base64_encode(base64_encode($key)); ?>">
                                    View All Students
                                </a>
                            </li>
                        <?php endforeach; ?>
                </li>

            </ul>
            </li>
            <!--                <li>
                                <a class="" href="<?= $this->request->webroot; ?>Instituteclasses/addclass">
                                    <i class="icon-plus-sign-alt"></i>
                                    Add Class
                                </a>
                            </li>-->
            <!--                <li>
                                <a class="" href="<?= $this->request->webroot; ?>Instituteclasses">
                                    <i class="icon-list"></i>
                                    List of Classes
                                </a>
                            </li>-->
        <?php } ?>
        </ul>
    </div>
    <div id="divider" class="resizeable"></div>
</div>