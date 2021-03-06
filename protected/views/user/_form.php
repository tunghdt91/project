<script src='<?php echo Yii::app()->baseUrl; ?>/js/bootstrap-datetimepicker.min.js'></script>
<script src='<?php echo Yii::app()->baseUrl; ?>/js/signin.js'></script>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap-datetimepicker.min.css'); ?>
<script type="text/javascript">
    $(function() {
        $('.datetimepicker4').datetimepicker({
            pickTime: false
        });
        $('#select_province').val(<?php echo $user->province_id ?>);
    });
</script>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'doanvien-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
        ));
?>
&nbsp;&nbsp;&nbsp;&nbsp;<p class="note"> Field have <span class="required">*</span> is required .</p>
<?php echo $form->errorSummary($user); ?>
<div class="user_form">
    <div class="row">
        <div class="span2 offset1">Name :</div>
        <?php
        echo $form->textField($user, 'name', array(
            'class' => 'text input span3',
            'placeholder' => 'Enter your Name',
        ));
        ?>
    </div>
    <div class="row">
        <div class="span2 offset1">User Name :(<span class="required">*</span>)</div>
        <?php
        echo $form->textField($user, 'username', array(
            'class' => 'text input span3',
            'placeholder' => 'Enter your user name',
        ));
        ?>
    </div>

    <?php
        if ($user->isNewRecord) {
            echo '<div class="row">';
            echo '<div class="span2 offset1">Password :(<span class="required">*</span>)</div>';
            echo $form->passwordField($user, 'password', array(
                'class' => 'text input span3',
                'placeholder' => 'Enter your password'
            ));
            echo '</div>';
        }
    ?>

    <div class="row">
        <div class="span2 offset1">Birth day:<span class="required">*</span></div>
        <div class="datetimepicker4" class="input-append span7">
            <input class="span3" data-format="yyyy-MM-dd" value ="<?php echo $user->birthday; ?>" type="text" name="User[birthday]" placeholder = 'dd-MM-yyyy'></input>
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="span2 offset1">Gender</div>
        <div class="span7">
            <?php
            echo $form->radioButtonList($user, 'gender', array('m' => 'Male', 'f' => 'Female'), array('separator' => '&nbsp; &nbsp;',
                'labelOptions' => array('style' => 'display:inline'),
            ));
            ?>
        </div>
    </div>

    <div class="row">
        <div class="span2 offset1">Province</div>
        <?php
        $provinces = Province::model()->findAll();
        $listData_province = CHtml::listData($provinces, 'id', 'province_name');
        echo CHtml::dropDownList('User[province_id]', '', 
            array('none' => 'Select') + $listData_province,
            array(
                'id' => 'select_province'
            ));
        ?>

    </div>
    <div class="row">
        <div class="span2 offset1">City</div>
        <?php
        echo CHtml::dropDownList('User[city_id]', '', 
            array('none' => 'Select'), 
            array(
                'id' => 'select_city',
                'disabled' => $user->isNewRecord,
            )
        );
        ?>

    </div>
    <div class="row">
        <div class="span2 offset1">District</div>
        <?php
        echo CHtml::dropDownList('User[district_id]', '', 
            array('none' => 'Select'), 
            array(
                'id' => 'select_district',
                'disabled' => $user->isNewRecord,
            )
        );
        ?>

    </div>
    <div class="row">
        <div class="span2 offset1">Address</div>
        <?php
        echo $form->textArea($user, 'address', array('class' => 'span4', 'rows' => 3,
            'placeholder' => 'Enter your address'));
        ?>
    </div>

    <div class="row">
        <div class="span2 offset1">Hobby</div>
        <div class="span5">
            <?php 
                $hbs = explode('.', $user->hobby);
                foreach ($hobbies as $key => $hobby) {
                    $checked = '';
                    settype($key, 'String');
                    if (is_int(array_search($key, $hbs))) {
                        $checked = "checked";
                    };
                    echo "<div class='row'>";
                        echo "<div class='span3'>";
                        echo "<input type='checkbox' name= hobby[$hobby->id] value= $hobby->code $checked >";
                        echo "</div>";
                        echo "<div class='span3'>";
                        echo $hobby->name;
                        echo "</div>";
                    echo "</div>";
                    $checked = '';
                }
            ?>
        </div>

    </div>
    <div class="clear"></div>
    <?php
    echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Update', array('class' => 'btn btn-info')
    );
    ?>
</div>
<?php $this->endWidget(); ?>