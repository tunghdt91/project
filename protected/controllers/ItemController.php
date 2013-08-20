<?php

class ItemController extends Controller
{
    //put your code here
    public function actionIndex()
    {
        die("index");
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
}

?>
