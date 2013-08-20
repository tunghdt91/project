<legend>
    <h3>All items</h3>
</legend>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        'id',
        'item_name',
        'period_id',
        'param_id',
    )));
?>