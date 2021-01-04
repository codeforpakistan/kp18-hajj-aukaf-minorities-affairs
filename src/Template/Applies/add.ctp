<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <h2>Apply for fund</h2>
        <?= $this->Form->create($apply) ?>
        <?php
        echo $this->Form->control('fund_category_id', ['id' => 'category', 'empty' => 'Select type', 'options' => $fundCategories, 'class' => 'form-control']);
        ?>
        <div id="subcategory_div">
            <?php
            echo $this->Form->control('sub_category_id', ['id' => 'subcategory', 'options' => '', 'empty' => true, 'class' => 'form-control']);
//        echo $this->Form->control('date');
            ?>
        </div>

        <br/>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-block']) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="col-sm-2"></div>

</div>
