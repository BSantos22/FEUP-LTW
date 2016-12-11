<?php

include_once('../database/connection.php');
include_once('../database/restaurant.php');

// split user search into keywords by non-alphanumeric characters(accepts latin supplement/extended characters)
$keywords = preg_split("/[^a-zA-Z0-9À-ỳ]/u", $_GET['search']);
$search_results = searchRestaurantsByKeywords($db, $keywords);

foreach ($search_results as $restaurant) {
    foreach($restaurant as $a) {
        echo($a);
        echo nl2br ("\n");
    }

}

?>
