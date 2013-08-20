<script src='<?php echo Yii::app()->baseUrl; ?>/js/bootstrap-datetimepicker.min.js'></script>
<script src='<?php echo Yii::app()->baseUrl; ?>/js/user.js'></script>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap-datetimepicker.min.css'); ?>
<script type="text/javascript">
    $(function() {
        $('.datetimepicker4').datetimepicker({
            pickTime: false
        });
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

    <div class="row">
        <div class="span2 offset1">Password :(<span class="required">*</span>)</div>
        <?php
        echo $form->passwordField($user, 'password', array(
            'class' => 'text input span3',
            'placeholder' => 'Enter your password'
        ));
        ?>
    </div>

    <div class="row">
        <div class="span2 offset1">Birth day:<span class="required">*</span></div>
        <div class="datetimepicker4" class="input-append span7">
            <input data-format="dd-MM-yyyy" type="text" name="User[birthday]" placeholder = 'dd-MM-yyyy'></input>
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
        echo CHtml::dropDownList('tinh_2', '', $listData_province, array('id' => 'chon_tinh_2'));
        ?>

    </div>
    <div class="row">
        <div class="span2 offset1">City</div>
        <?php
        $cities = City::model()->findAll();
        $listData_city = CHtml::listData($cities, 'id', 'city_name');
        echo CHtml::dropDownList('tinh_2', '', $listData_city, array('id' => 'chon_tinh_2'));
        ?>

    </div>
    <div class="row">
        <div class="span2 offset1">District</div>
        <?php
        $districts = District::model()->findAll();
        $listData_district = CHtml::listData($districts, 'id', 'district_name');
        echo CHtml::dropDownList('tinh_2', '', $listData_district, array('id' => 'chon_tinh_2'));
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
                foreach ($hobbies as $hobby) {
                    echo "<div class='row'>";
                        echo "<div class='span3'>";
                        echo "<input type='checkbox' name= hobby[$hobby->id] value= $hobby->code >";
                        echo "</div>";
                        
                        echo "<div class='span3'>";
                        echo $hobby->name;
                        echo "</div>";
                    echo "</div>";
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