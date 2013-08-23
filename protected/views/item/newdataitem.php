<legend>
    <h3>New data item</h3>
</legend>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<?php
    echo $this->renderPartial(
        '_form',
        array(
            'item' => $item,
            'params' => $params,
        )
    );
?>