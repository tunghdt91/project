<?php

class UserController extends Controller
{
        /*@author Mr_Khoai
         */
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
        
        /*@author Mr_Khoai
         */
        public function actionDataSignin() {
           if (!Yii::app()->request->isAjaxRequest) {
            $this->render('/site/error', array(
                'code' => 403,
                'message' => 'Forbidden',
            ));
            Yii::app()->end();
           }
           if (isset($_POST['value'])) {
            $results = array();
            $criteria = new CDbCriteria();
            $criteria->condition = "parent = ({$_POST['value']})";
            $kqs = Period::model()->findAll($criteria);
            foreach ($kqs as $kq) {
                 $results[$kq->id] = $kq->period_name;
            }
            echo json_encode($results);
           }
        }
        /*@author Mr_Khoai
         */
        public function actionDataCity() {
            if(!Yii::app()->request->isAjaxRequest) {
                $this->render('/site/error', array(
                    'code' => 403,
                    'message' => 'Forbidden',
                ));
                Yii::app()->end();
            }          
            if(isset($_POST['value'])) {
                $results = array();
                $criteria = new CDbCriteria();
                $criteria->condition = "id_province = ({$_POST['value']})";
                $kqs = City::model()->findAll($criteria);
                foreach ($kqs as $kq) {
                     $results[$kq->id] = $kq->city_name;
                }
                echo json_encode($results);
            }
        }
        
        public function actionDataDistrict() {
            if(!Yii::app()->request->isAjaxRequest) {
                $this->render('/site/error', array(
                    'code' => 403,
                    'message' => 'Forbidden',
                ));
                Yii::app()->end();
            }          
            if(isset($_POST['value'])) {
                $results = array();
                $criteria = new CDbCriteria();
                $criteria->condition = "id_city = ({$_POST['value']})";
                $kqs = District::model()->findAll($criteria);
                foreach ($kqs as $kq) {
                     $results[$kq->id] = $kq->district_name;
                }
                echo json_encode($results);
            }
        }
        /*@author Mr_Khoai
         */
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
            $hobbies = Lookup::model()->findAll();
            
            if(isset($_POST['User']) ) {
                $tmp = '';
                foreach ($hobbies as $hobby) {
                    if(isset($_POST['hobby'][$hobby->id])) {
                        $tmp .= $_POST['hobby'][$hobby->id];
                    }
  
                }
                $user->attributes = $_POST['User'];
                $user->hobby = $tmp;
                if (!empty($_POST['User']['birthday'])) {
                    $user->birthday = DateTime::createFromFormat('d-m-Y', $_POST['User']['birthday'])->format('Y-m-d');
                }
                $user->password = md5($_POST['User']['password']);
                if ($user->save()) {
                  Yii::app()->user->setFlash('success', 'Thank you ! Register Account Complete .');
                  $this->redirect(array('user/index'));
                }
            }
            
            $this->render('create', array(
                'user' => $user,
                'hobbies' => $hobbies,
            ));
            
        }
        
        public function actionIndex() {
            $this->render('index');
        }
}