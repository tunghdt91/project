<?php

class SearchController extends Controller {
    
    public function actionIndex($key_word) {
        
        $users = User::model()->findAll();
        $as = new ApproximateSearch($users, array('username', 'name') , $key_word);
        $users_found = $as->search();
        
        $items = Item::model()->findAll();
        $as = new ApproximateSearch($items, array('item_name'), $key_word);
        $items_found = $as->search();
        $this->render('results', array(
            'users_found' => $users_found,
            'items_found' => $items_found,
            'key_word' => $key_word,
        ));
    }
}

?>