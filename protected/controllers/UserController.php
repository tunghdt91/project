<?php

class UserController extends Controller
{
	public function actionSignIn()
	{
            $form = new SigninForm;
            if (isset($_POST['SigninForm'])) {
                $form->attributes = $_POST['SigninForm'];
                if ($form->validate() && $form->login()) {
                    Yii::app()->request->redirect(Yii::app()->user->returnUrl);
                }
            }
            $this->render('signin', array(
                'form' => $form
                )
            );
	}

	public function actionSignout()
        {
            Yii::app()->user->logout();
            Yii::app()->request->redirect($this->createUrl('home/index'));
        }
}