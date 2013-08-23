<?php

class ChangePassword extends CFormModel
{

    public $oldPassword;
    public $newPassword;
    public $passwordConfirm;
    
    /*
     * author HieuND
     */
    public function rules()
    {
        return array(
            array('oldPassword', 'required', 'message' => 'Old Password không được để trống.'),
            array('newPassword', 'required', 'message' => 'New Password không được để trống.'),
            array('newPassword, passwordConfirm', 'length', 'min' => 6),
            array(
                'passwordConfirm',
                'compare',
                'compareAttribute' => 'newPassword',
                'message' => 'Nhập lại mật khẩu không giống nhau.',
            ),
        );
    }

}

?>