<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Applicants
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= __('View Applicants') ?>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href='<?= $this->request->webroot . 'admin/Applicants/add'; ?>'>Add Applicants</a></li>
                                    <li><a href='<?= $this->request->webroot . 'admin/Applicants'; ?>'>View Applicants</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="body">
                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <h3><?= h($applicant->name) ?></h3>
                                <tr>
                                    <th scope="row"><?= __('Id') ?></th>
                                    <td><?= $this->Number->format($applicant->id) ?></td>
                                </tr>  
                                <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <td><?= h($applicant->name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Father Or Husband Name') ?></th>
                                    <td><?= h($applicant->father_name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Religion') ?></th>
                                    <td><?= ($applicant->has('religion') ? $this->Html->link($applicant->religion->religion_name, ['controller' => 'Religions', 'action' => 'view', $applicant->religion->id]) : '') ?></td>
                                </tr>

                                <tr>
                                    <th scope="row"><?= __('Cnic') ?></th>
                                    <td><?= h($applicant->cnic) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Gender') ?></th>
                                    <td><?= h($applicant->gender) ?></td>
                                </tr>
                                <tr>
                                    <?php if (!empty($applicant['maritalstatus'])): ?>
                                        <th scope="row"><?= __('Marital Status') ?></th>
                                        <td><?= $applicant->has('maritalstatus') ? $this->Html->link($applicant->maritalstatus->status, ['controller' => 'Maritalstatus', 'action' => 'view', $applicant->maritalstatus->id]) : '' ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <?php if (!empty($applicant['groom_or_bride_name'])): ?>
                                        <th scope="row"><?= __('Groom Or Bride Name') ?></th>
                                        <td><?= h($applicant->groom_or_bride_name) ?></td>
                                    <?php endif; ?>
                                </tr>

                                <tr>
                                    <?php if (!empty($qualifications[0]['education_system'])): ?>
                                        <th scope="row"><?= __('Education System') ?></th>
                                        <td><?= h($qualifications[0]['education_system']) ?></td>
                                    <?php endif; ?>
                                </tr> 
                                <tr>
                                    <?php if (!empty($qualifications[0]['grading_system'])): ?>
                                        <th scope="row"><?= __('Grading System') ?></th>
                                        <td><?= h($qualifications[0]['grading_system']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($qualifications[0]['obtained_cgpa'])): ?>
                                        <th scope="row"><?= __('Obtained CGPA') ?></th>
                                        <td><?= h($qualifications[0]['obtained_cgpa']) ?></td>
                                    <?php endif; ?>
                                </tr>

                                <tr>
                                    <?php if (!empty($qualifications[0]['total_cgpa'])): ?>
                                        <th scope="row"><?= __('Total CGPA') ?></th>
                                        <td><?= h($qualifications[0]['total_cgpa']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($qualifications[0]['obtained_marks'])): ?>
                                        <th scope="row"><?= __('Obtained Marks') ?></th>
                                        <td><?= h($qualifications[0]['obtained_marks']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($qualifications[0]['total_marks'])): ?>
                                        <th scope="row"><?= __('Total Marks') ?></th>
                                        <td><?= h($qualifications[0]['total_marks']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($qualifications[0]['degree_awarding']['name'])): ?>
                                        <th scope="row"><?= __('Degree Awarding') ?></th>
                                        <td><?= h($qualifications[0]['degree_awarding']['name']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($qualifications[0]['institute']['name'])): ?>
                                        <th scope="row"><?= __('Institute') ?></th>
                                        <td><?= h($qualifications[0]['institute']['name']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($qualifications[0]['discipline']['discipline'])): ?>
                                        <th scope="row"><?= __('Discipline') ?></th>
                                        <td><?= h($qualifications[0]['discipline']['discipline']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($qualifications[0]['qualification_level']['name'])): ?>
                                        <th scope="row"><?= __('Qualification Level') ?></th>
                                        <td><?= h($qualifications[0]['qualification_level']['name']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($fund['fund_name'])): ?>
                                        <th scope="row"><?= __('Fund Name') ?></th>
                                        <td><?= h($fund['fund_name']) ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if (!empty($applicant->applicantaddresses)): ?>

                                        <th scope="row"><?= __('Current Address') ?></th>
                                        <td><?= h($applicant['applicantaddresses'][0]['current_address']) ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?= __('Permanent Address') ?></th>
                                        <td><?= h($applicant['applicantaddresses'][0]['permenent_address']) ?></td>
                                    </tr>

                                    <tr>

                                        <th scope="col"><?= __('Distict') ?></th>

                                        <td><?= $city['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="col"><?= __('Postal Address') ?></th>
                                        <td><?= h($applicant['applicantaddresses'][0]['postal_address']) ?></td>
                                    </tr>

                                <?php endif; ?>

                                <?php if (!empty($applicant->applicant_household_details)): ?>
                                    <tr>
                                        <th scope="col"><?= __('Dependent Family Members') ?></th>

                                        <td><?= h($applicant['applicant_household_details'][0]['dependent_family_members']) ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if (!empty($applicant->applicantincomes)): ?>
                                    <tr>
                                        <th scope="col"><?= __('Monthly Income') ?></th>
                                        <td><?= $applicant['applicantincomes'][0]['monthly_income'] ?></td>
                                    </tr>

                                <?php endif; ?>
                                <?php if (!empty($applicant->applicantcontacts)): ?>
                                    <?php 
                                    foreach ($applicant['applicantcontacts'] as $each_k=>$each_num):
                                    ?>
                                    <tr>
                                        <th scope="col">Mobile Number <?php echo $each_k+1 ?></th>
                                        <td><?= $each_num['mob_number'] ?></td>
                                    </tr>
                                    <?php endforeach;?>

                                <?php endif; ?>
                                <?php if (!empty($applicant->applicantprofessions)): ?>
                                    <tr>
                                        <th scope="col"><?= __('Profession') ?></th>
                                        <td><?= $applicant['applicantprofessions'][0]['profession'] ?></td>
                                    </tr>

                                <?php endif; ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>



