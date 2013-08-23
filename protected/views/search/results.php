<div class="clear2"></div>
<div class="row">
    <?php
        $users_count = count($users_found);
        $items_count = count($items_found);
        if ($users_count + $items_count == 0) {
            echo "<p style='color: red;'>Sorry, No results found.</p>";
        } else {
            echo "<p style='color: blue;'>Search results with keyword: 
                <span style='color: red; font-weight: bold;'> \"{$key_word}\" </span></p>";
        }
        if ($users_count) {
            echo "<h3>User ({$users_count})</h3>";
            echo '<div class="none"></div>';
            foreach ($users_found as $user) {
               $link_to_profile = Yii::app()->createUrl("user/view",array("id"=>$user[0]->id));
               echo "<a href = $link_to_profile>".$user[0]->username."</a><br/>";
            }
        }
        
        if ($items_count) {
            echo "<h3>Items ({$items_count})</h3>";
            foreach ($items_found as $item) {
               $link_to_item = Yii::app()->createUrl("item/view",array("id"=>$item[0]->id));
               echo "<a href = $link_to_item>".$item[0]->item_name."</a><br/>";
            }
        }
    ?>
</div>