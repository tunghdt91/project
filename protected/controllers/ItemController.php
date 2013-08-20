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
        $dataProvider = new CActiveDataProvider(
            'Item',
            array('criteria' => array(
                'condition' => "parent_id = $id",
            ))
        );
        
        $this->render(
            'view', 
            array(
                'item' => $item,
                'dataProvider' => $dataProvider,
            )
        );
    }


    public function actionNewDataItem($id)
    {
        $item = $this->loadModel($id);
        $params = $item->param()->children();
        if(sizeof($_POST) != 0) {
            $datas = $_POST[$item->id];
            foreach ($datas as $key => $value) {
                $save = false;
                $dt = new Data;
                $dt->item_id = $item->id;
                $dt->param_id = $key;
                $dt->period_id = $item->period_id;
                foreach ($value as $key1 => $value1) {
                    $t = "value{$key1}";
                    if ($value1 != "") {
                        $dt->$t = $value1;
                        $save = true;
                    } else {
                        $dt->$t = NULL;
                    }
                }
                $dt->dttm_input = date('Y-m-d H:i:s', time());
                $dt->user_input = $this->current_user->id;
                $dt->status = 2;
                if ($save) {
                    if ($dt->save()) {
                        $this->redirect(array('/item/newdataitem', 'id' => $id));
                    }
                }
            }
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
