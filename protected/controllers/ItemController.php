<?php

class ItemController extends Controller
{
    //put your code here
    public function actionIndex()
    {
        $this->render('index');
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
        $periods = Period::model()->findAll();
        $params = Param::model()->findAll();
        
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
