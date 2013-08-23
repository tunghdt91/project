<script src='<?php echo Yii::app()->baseUrl; ?>/js/signin.js'></script>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        array(
            'name'=>$item->item_name,
            'value'=>'$data->param->param_name',
        ),
        array(
            'name'=>'value1',
            'value'=>'$data? ($data->value1 ? $data->value1 : "") : ""',
        ),
        array(
            'name'=>'value2',
            'value'=>'$data? ($data->value2 ? $data->value2 : "") : ""',
        ),
        array(
            'name'=>'value3',
            'value'=>'$data? ($data->value3 ? $data->value3 : "") : ""',
        ),
)));
if ($new) {
    echo CHtml::submitButton(
        'New Data',
        array(
            'class' => 'btn btn-primary',
            'submit' => array(
                'item/newdataitem',
                'id' => $item->id,
            )
        )
    );
} else {
    echo CHtml::submitButton(
        'Update data',
        array(
            'class' => 'btn btn-primary',
            'submit' => array(
                'item/update',
                'id' => $item->id,
            )
        )
    );
}
?>