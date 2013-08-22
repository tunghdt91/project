<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'danh-gia-doan-vien-form',
	'enableAjaxValidation'=>false,
)); ?>

<table width="80%">
    <tr>
        <th width="20%"><?php echo $item->param->param_name; ?></th>
        <th width="25%">Value1</th>
        <th width="25%">Value2</th>
        <th width="30%">Value3</th>
    </tr>

    <?php 
        foreach ($params as $param) {
            echo "<tr>";
                echo "<td>";
                echo CHtml::label($param->param_name, '');
                echo "</td>";

                echo "<td>";
                echo CHtml::textField("{$item->id}[{$param->id}][value1]", $param->data->value1);
                echo "</td>";
                echo "<td>";
                echo CHtml::textField("{$item->id}[{$param->id}][value2]", $param->data->value2);
                echo "</td>";
                echo "<td>";
                echo CHtml::textField("{$item->id}[{$param->id}][value3]", $param->data->value3);
                echo "</td>";
            echo "</tr>";
        }
    ?>
</table>

<div class="row buttons">
    <?php 
        echo CHtml::submitButton('Save', array('class' => 'btn btn-info'));
        echo '&nbsp;';
        echo CHtml::submitButton(
            'Cancel',
            array(
                'class' => 'btn btn-warning',
                'submit' => array(
                    'item/index',
                )
            )
        );
    ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->