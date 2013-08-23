<?php
/* @var $this LookupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lookups',
);

$this->menu=array(
	array('label'=>'Create Lookup', 'url'=>array('create')),
	array('label'=>'Manage Lookup', 'url'=>array('admin')),
);
?>

<h1>Lookups</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns' => array(
            'id',
            'name',
            'code',
            'type',
            array(
            'header'=>'Action',
            'class'=>'CButtonColumn',
            'htmlOptions'=>array("width"=>"60px"),
            ),
            ),));
?>