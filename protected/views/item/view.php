<script src='<?php echo Yii::app()->baseUrl; ?>/js/signin.js'></script>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        array(
            'name'=>$item->item_name,
            'value'=>'$data->param_name',
        ),
        array(
            'name'=>'value1',
            'value'=>'$data->data? ($data->data->value1 ? $data->data->value1 : "") : ""',
        ),
        array(
            'name'=>'value2',
            'value'=>'$data->data? ($data->data->value2 ? $data->data->value2 : "") : ""',
        ),
        array(
            'name'=>'value3',
            'value'=>'$data->data? ($data->data->value3 ? $data->data->value3 : "") : ""',
        ),
        array(
            'class'=>'CLinkColumn',
            'header'=>'action',
            'label'=>'view' ,
            'urlExpression'=>'Yii::app()->createUrl("item/view",array("id"=>$data->id))',
        ),
)));
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
?>