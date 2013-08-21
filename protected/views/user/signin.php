<script src='<?php echo Yii::app()->baseUrl; ?>/js/signin.js'></script>
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
            <div class="span2 offset1">User Name (<span class="required">*</span>)</div>
            <?php echo CHtml::activeTextField($form, 'username', array('class' => 'span3', 
                'placeholder' => 'Username', 'autofocus' => 'autofocus')); ?>
        </div>
        <div class="row">
            <div class="span2 offset1"> Password (<span class="required">*</span>)</div>
            <?php echo CHtml::activePasswordField($form, 'password', array('class' => 'span3', 
                'placeholder' => 'Password')); ?>
        </div>
        <div class="row">
            <div class="span2 offset1">Year</div>
             <?php
                $listData_year = CHtml::listData($years, 'code','name');
                echo CHtml::dropDownList('year', '', 
                    $listData_year ,
                    array(
                        'class' => 'span2 offset3',
                    )
                );
             ?>
        </div>
        <div class="row">
            <div class="span2 offset1">Period</div>
                <?php
                $data = Period::model()->findAllByAttributes(array('parent'=>0));
                $list = CHtml::listData($data, 'id', 'period_name');
                    echo CHtml::dropDownList('', '', 
                        $list,
                        array(
                            'id' => 'select_1',
                            'class' => 'span2 offset3'
                        )
                    );
                ?>
                <?php
                    echo CHtml::dropDownList('period', '', 
                        array() ,
                        array(
                            'id' => 'select_2',
                            'class' => 'span2 offset3',
                        )
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

        <div class="row"><?php echo CHtml::submitButton('Login', array('class' => 'span2 offset3  btn btn-primary')); ?></div>
    </form>
</div>