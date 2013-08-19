<?php
$this->widget('bootstrap.widgets.TbAlert');
?>
<div class="center_form">
    <div class="row text-center">
        <h1> Welcome Back </h1>
        <br>
    </div>
    <form method='post'>
        <?php echo CHtml::errorSummary($form); ?>
        <div class="row">
            <?php echo CHtml::activeTextField($form, 'username', array('class' => 'span5 offset3', 
                'placeholder' => 'Username', 'autofocus' => 'autofocus')); ?>
        </div>
        <div class="row">
            <?php echo CHtml::activePasswordField($form, 'password', array('class' => 'span5 offset3', 
                'placeholder' => 'Password')); ?>
        </div>
        <div class="row">
            <?php
                echo CHtml::dropDownList('', '', 
                    array('none' => 'Select', '2013' => '2013', '2014' => '2014'),
                    array('class' => 'span2 offset3')
                );
            ?>
        </div>
        <div class="row">
            <?php
                echo CHtml::dropDownList('', '', 
                    array('none' => 'Select', 'Quartal' => 'Quartal', 'Semeter' => 'Semeter'),
                    array('class' => 'span2 offset3')
                );
                echo '&nbsp;';
                echo CHtml::dropDownList('', '', 
                    array('none' => 'Select', 'Quartal' => 'Quartal', 'Semeter' => 'Semeter'),
                    array('class' => 'span2 offset3')
                );
            ?>
        </div>
        <div style="height:20px"></div>
        <div class="row" style="color: blue; font-size: 8px">
            <label class="span6 offset3">
                <?php echo CHtml::activeCheckBox($form, 'rememberMe'); ?>
                Remember Me
            </label>
        </div>
        <div class="row">
            <div class="span6 offset3">
                <?php echo CHtml::link('Forget Your Password', array('user/forgetPassword')); ?>
            </div>
        </div>
        <div style="height:20px"></div>

        <div class="row"><?php echo CHtml::submitButton('Login', array('class' => 'span3 offset5 btn btn-primary')); ?></div>
    </form>
</div>