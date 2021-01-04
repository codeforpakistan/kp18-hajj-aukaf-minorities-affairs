<div class="tab-pane" id="education"><div class="col-md-12">
    <?= $this->Form->create($qualification) ?>
    <fieldset>
        <legend><?= __('Add Qualification') ?></legend>
        <?php
//            echo $this->Form->control('applicant_id', ['options' => $applicants]);
        echo $this->Form->control('qualification_level_id', ['class' => 'form-control', 'options' => $qualificationLevels]);
        echo $this->Form->control('discipline_id', ['class' => 'form-control', 'options' => $disciplines]);
        
//        echo $this->Form->control('Institute.institute_id', ['class' => 'form-control', 'options' => $institutes]);
       
        echo $this->Form->control('degree_awarding_id', ['class' => 'form-control', 'options' => $degreeAwardings]);
        echo $this->Form->control('education_system', ['class' => 'form-control']);
        echo $this->Form->control('grading_system', ['class' => 'form-control']);
        echo $this->Form->control('total_cgpa', ['class' => 'form-control']);
        echo $this->Form->control('obtained_cgpa', ['class' => 'form-control']);
        echo $this->Form->control('total_marks', ['class' => 'form-control']);
        echo $this->Form->control('obtained_marks', ['class' => 'form-control']);
        echo $this->Form->control('percentage', ['class' => 'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>