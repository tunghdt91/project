<div class='clear'></div>
<?php
    $this->widget('bootstrap.widgets.TbAlert');
?>
<legend>
    <h3>List User(<span style='color: red;'><?php echo sizeof($users); ?></span>)</h3>
</legend>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'menu-grid',
    'dataProvider'=>$dataProvider,
    'columns' => array(
        'id',
        array(
            'class'=>'CLinkColumn',
            'header'=>'username',
            'labelExpression'=>'$data->username' ,
            'urlExpression'=>'Yii::app()->createUrl("user/view",array("id"=>$data->id))',
        ),
        'birthday',
        'address',
         array(
            'class'=>'CButtonColumn',
             'htmlOptions'=>array("width"=>"100px"),
        ),
    )));
?>