<legend>
    <h3>Create new Item</h3>
</legend>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'item-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
        ));
?>
<?php echo $form->errorSummary($item); ?> 
<div class="item-form">
    <div class="row">
        <div class="span2 offset1">Item Name :</div>
        <?php
        echo $form->textField($item, 'item_name', array(
            'class' => 'text input span3',
            'placeholder' => 'Enter name new Item',
        ));
        ?>
    </div>
    <div class="row">
        <div class="span2 offset1">Period</div>
        <?php
        $listData_period = CHtml::listData($periods, 'id', 'period_name');
        echo CHtml::dropDownList('Item[period_id]', '', $listData_period);
        ?>
    </div>

    <div class="row">
        <div class="span2 offset1">Params</div>
        <?php
        $listData_param = CHtml::listData($params, 'id', 'param_name');
        echo CHtml::dropDownList('Item[param_id]', '', $listData_param);
        ?>
    </div>

    <div class="clear"></div>
    <div class='row'>
        <div class='span3'></div>
        <?php
        echo CHtml::submitButton($item->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-info')
        );
        ?>
    </div>
</div>
<?php $this->endWidget(); ?>