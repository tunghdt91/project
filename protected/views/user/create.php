<legend>
    <h3>Register new Account</h3>
</legend>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
    <?php echo $this->renderPartial('_form', array(
        'user' => $user,
        )
     ); ?>