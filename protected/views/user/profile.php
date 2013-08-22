<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<legend>
    <h3>My info</h3>
</legend>
<table class='detail-view table table-striped table-condensed' id='yw1'>
    <tbody>
        <tr class='odd '>
            <th width="30%">Name :</th>
            <td><?php echo $user->name; ?></td>
     </tr>
     <tr class='odd '>
            <th>User Name</th>
            <td><?php echo $user->username; ?></td>
     </tr>
     <tr class='odd '>
            <th>Password :</th>
            <td>****** (<a href="index.php?r=user/changePassword">Change</a>)</td>
     </tr>
     <tr class='odd '>
            <th>Birthday</th>
            <td><?php echo $user->birthday; ?></td>
     </tr>
      <tr class='odd '>
            <th>Gender</th>
            <td><?php 
                if($user->gender == 'f') {
                    echo 'Female';
                } else {
                    echo 'Male';
                }?></td>
     </tr>
     <tr class='odd '>
            <th>Address:</th>
            <td><?php echo $user->address; ?></td>
     </tr>
    </tbody>
</table>
<?php
echo CHtml::button('Edit profile', array(
            'class' => 'btn btn-primary',
            'submit' => array(
                'user/update',
            ))
        );
?>