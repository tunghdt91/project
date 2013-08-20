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
    
    public function actionNewItemData($id)
    {
        $item = $this->loadModel($id);
        $params = $item->param()->children();
        $this->render(
            'new_data',
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
        $periods = Period::model()->findAll($criteria);
        $params = Param::model()->findAll($criteria);
        
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
