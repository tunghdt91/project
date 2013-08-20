<?php
$this->widget('bootstrap.widgets.TbAlert');
?>
<div class="center_form">
    <div class="row text-center">
        <h1>Đổi mật khẩu</h1>
    </div>
    <div style="height:50px"></div>
    <form method='post'>
        <?php echo CHtml::errorSummary($form); ?>
        <div class="row">
            <?php echo CHtml::activePasswordField($form, 'oldPassword', array('class' => 'span6 offset3', 
                'placeholder' => 'Current password', 'autofocus' => 'autofocus')); ?>
        </div>
        <div class="row">
            <?php echo CHtml::activePasswordField($form, 'newPassword', array('class' => 'span6 offset3', 
                'placeholder' => 'New password')); ?>
        </div>
        <div class="row">
            <?php echo CHtml::activePasswordField($form, 'passwordConfirm', array('class' => 'span6 offset3', 
                'placeholder' => 'Confirm new password')); ?>
        </div>
        <div style="height:20px"></div>
        <div class="row"><?php echo CHtml::submitButton('Đổi mật khẩu', array('class' => 'offset5 btn btn-primary')); ?></div>
    </form>
</div>