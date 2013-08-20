<script src='<?php echo Yii::app()->baseUrl; ?>/js/signin.js'></script>
<legend>
    <h3>All items</h3>
</legend>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php
echo CHtml::button('Show Search ', array('id' => 'show_search', 'class' => 'btn btn-primary'));
?>
<hr>

<?php echo CHtml::beginForm('', 'get', array('id' => 'form_search', 'hidden' => 'hidden')); ?>
<div>
    <div class="row">
        <?php
        echo CHtml::dropDownList('year', '', array('none' => 'Year') + array('2013' => '2013', '2014' => '2014'), array(
            'class' => 'span2 offset3',
            )
        );
        ?>
        <?php
        $data = Period::model()->findAllByAttributes(array('parent' => 0));
        $list = CHtml::listData($data, 'id', 'period_name');
        echo CHtml::dropDownList('value1', '', array('none' => 'Select') + $list, array(
            'id' => 'select_1',
            'class' => 'span2 offset3'
            )
        );
        ?>
        <?php
        echo CHtml::dropDownList('value2', '', array('none' => 'Select'), array(
            'id' => 'select_2',
            'class' => 'span2 offset3',
            'disabled' => true,
            )
        );
        ?>
    </div>
</div>
<div>
    <?php echo CHtml::submitButton('Search', array('id' => 'search-button', 'class' => 'btn btn-primary')); ?>
</div>
<?php echo CHtml::endForm(); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        'id',
        'item_name',
         array(
            'name'=>'period_id',
            'value'=>'$data->period->period_name',
        ),
        array(
            'name'=>'period_id',
            'value'=>'$data->param->param_name',
        ),
    )));
?>