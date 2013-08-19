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
        
        public function loadModel($id) {
            $model = User::model()->findByPk($id);
            if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
        }
        public function actionCreate() {
            $user = new User;
            if(isset($_POST['User']) ) {
                $user->attributes = $_POST['User'];
                $user->password = md5($_POST['User']['password']);
                if ($user->save()) {
                  Yii::app()->user->setFlash('success', 'Thank you ! Register Account Complete .');
                  $this->redirect(array('user/index'));
                }
            }
            $this->render('create', array(
                'user' => $user,
            ));
            
        }
        
        public function actionIndex() {
            $this->render('index');
        }
}