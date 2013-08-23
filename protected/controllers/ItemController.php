<?php

class ItemController extends Controller
{
    //put your code here
    public function actionIndex($year = null, $value1 = null, $value2 = null)
    {
        $criteria = new CDbCriteria();
        if ($year != null && $year != 'none') {

        }
        if ($value1 != null && $value1 != 'none') {

        }
        if ($value2 != null && $value2 != 'none') {
            $criteria->addCondition('period_id='.$value2);
        }
        $dataProvider=new CActiveDataProvider('Item', array(
            'criteria' => $criteria
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'year' => $year,
            'value1' => $value1,
            'value2' => $value2,
        ));
    }
    
    public function actionView($id)
    {
        $item = $this->loadModel($id);
        $criteria = new CDbCriteria;
        $criteria->addCondition('item_id = '.$id);
        $dataProvider=new CActiveDataProvider('Data', array(
            'criteria' => $criteria
        ));
        
        $datas = Data::model()->findByAttributes(array('item_id' => $id));
        if ($datas != NULL) {
            $new = false;
        } else {
            $new = true;
        }
        
        $this->render(
            'view', 
            array(
                'item' => $item,
                'dataProvider' => $dataProvider,
                'new' => $new,
            )
        );
    }
    
    public function actionUpdate($id)
    {
        $item = $this->loadModel($id);
        $params = $item->param()->children();

        if(sizeof($_POST) != 0) {
            $datas = $_POST[$item->id];
            foreach ($datas as $key => $value) {
                $data = Data::model()->findByAttributes(array('param_id' => $key, 'item_id' => $id));
                $data->attributes = $value;
                if(!empty($this->current_user)) {
                    $data->user_update = $this->current_user->id;
                }
                $data->save(); 
            }
            $this->redirect(array('item/view','id'=>$id));
        }
        
        $this->render(
            'update',
            array(
                'item' => $item,
                'params' => $params,
            )
        );
    }
    
    public function actionDelete($id)
    {
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }


    public function actionNewDataItem($id)
    {
        $item = $this->loadModel($id);
        $params = $item->param()->children();
        if(sizeof($_POST) != 0) {
            $datas = $_POST[$item->id];
            foreach ($datas as $key => $value) {
                $data = new Data;
                $data->attributes = $value;
                $data->item_id = $item->id;
                $data->param_id = $key;
                $data->period_id = Yii::app()->session['period'];
                $data->year = Yii::app()->session['year'];
                if(!empty($this->current_user)) {
                    $data->user_input = $this->current_user->id;
                }
                $data->status = 2;
                $data->save();
            }
            $this->redirect(array('/item/view', 'id' => $id));
        }
        $this->render(
            'newdataitem',
            array(
                'item' => $item,
                'params' => $params,
            )
        );
    }
    
    public function loadModel($id)
    {
        $model = Item::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
    
    public function actionCreate() {
        $item = new Item;
        $criteria = new CDbCriteria;
        $criteria->addCondition('parent!=:parent');
        $criteria->params = array(':parent' => 0);
        
        $criteria2 = new CDbCriteria;
        $criteria2->addCondition('parent=:parent');
        $criteria2->params = array(':parent' => 0);
        $periods = Period::model()->findAll($criteria);
        $params = Param::model()->findAll($criteria2);
        
        if(isset($_POST['Item'])) {
            $item->attributes = $_POST['Item'];
            if($item->save()) {
                Yii::app()->user->setFlash('success', 'Create item complete .');
                $this->redirect(array('/item/index'));
            }
        }
        $this->render('create', array(
            'item' => $item,
            'periods' => $periods,
            'params' => $params,
        ));
    }
}

?>
