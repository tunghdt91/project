<legend>
    <h3>Update Profile Account</h3>
</legend>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
    <?php echo $this->renderPartial('_form', array(
        'user' => $user,
        'hobbies' => $hobbies,
        )
     ); ?>