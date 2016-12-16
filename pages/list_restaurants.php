<?php
    session_start();

    require_once('../database/connection.php');
    require_once ('../database/restaurant.php');
    require_once ('../database/user.php');

    if (isset($_GET['search-type'])) {
        $_SESSION['search-type'] = $_GET['search-type'];
    }

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);

        if (isset($_GET['search'])) {
            $array = str_split($_GET['search']);
            $keywords = preg_split("/[^a-zA-Z0-9À-ỳ]/u", $_GET['search']);
            $filters = getFiltersArray();

            if ($array[0] == null && empty($filters)) {
                $result = getAllRestaurants($db);
            }
            else {
                $_SESSION['search'] = $_GET['search'];
                $result = searchRestaurantsByKeywords($db, $keywords, $_GET['search-type'], $filters);
            }
        }
        else {
            $result = getAllRestaurants($db);
        }

        $restaurants = $result;
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }


    $_SESSION['restaurants'] = order($restaurants);
    $cssStyle = "../styles/listrestaurantstyle.css";

    require('../templates/header.php');
    require('../templates/list_restaurants.php');
    require('../templates/footer.php');


    function getFiltersArray() {
        $filters = [];

        // Check if there are filters
        if (isset($_GET['amount'])) {
            // Check if every filter is empty
            $n = 0;
            for ($i = 0; $i < count($_GET['amount']); $i++) {
                if (intval($_GET['amount'][$i]) < 1 || intval($_GET['amount'][$i]) > 5) {
                    $n++;
                }
            }

            // If yes ignore the filters
            if ($n != count($_GET['amount'])) {
                for ($i = 0; $i < count($_GET['amount']); $i++) {
                    if (intval($_GET['amount'][$i]) < 1 || intval($_GET['amount'][$i]) > 5) {
                        continue;
                    }

                    $column = $_GET['filter-type'][$i];
                    $operator = $_GET['filter-operator'][$i];
                    $value = intval($_GET['amount'][$i]);

                    array_push( $filters, [$column, $operator, $value]);
                }
            }
        }

        return $filters;
    }

    function order($restaurants) {
        if ((isset($_SESSION['type']) && isset($_SESSION['orientation']) && isset($_SESSION['porientation']))) {
            $type = $_SESSION['type'];
            $orient = $_SESSION['orientation'];
            $ptype = $_SESSION['ptype'];
            $porient = $_SESSION['porientation'];
        }
        else {
            return $restaurants;
        }

        switch($type) {
            case 0:
                if ($orient == 0) {
                    return $restaurants;
                }
                else {
                    return array_reverse($restaurants, false);
                }
                break;
            case 1:
                if ($orient == 0) {
                    usort($restaurants, "cmpnamedesc");
                }
                else {
                    usort($restaurants, "cmpnameasc");
                }
                break;
            case 2:
                if ($orient == 0) {
                    usort($restaurants, "cmpratdesc");
                }
                else {
                    usort($restaurants, "cmpratasc");
                }
                break;
            case 3:
                if ($orient == 0) {
                    usort($restaurants, "cmppricedesc");
                }
                else {
                    usort($restaurants, "cmppriceasc");
                }
                break;
        }

        return $restaurants;
    }

    function cmpnamedesc($a, $b) { if($a['name'] == $b['name']){return 0;} return ($a['name'] > $b['name']) ? -1 : 1;};
    function cmpnameasc($a, $b) { if($a['name'] == $b['name']){return 0;} return ($a['name'] < $b['name']) ? -1 : 1;};
    function cmpratdesc($a, $b) { if($a['reviewersRating'] == $b['reviewersRating']){return 0;} return ($a['reviewersRating'] > $b['reviewersRating']) ? -1 : 1;};
    function cmpratasc($a, $b) { if($a['reviewersRating'] == $b['reviewersRating']){return 0;} return ($a['reviewersRating'] < $b['reviewersRating']) ? -1 : 1;};
    function cmppricedesc($a, $b) { if($a['price'] == $b['price']){return 0;} return ($a['price'] > $b['price']) ? -1 : 1;};
    function cmppriceasc($a, $b) { if($a['price'] == $b['price']){return 0;} return ($a['price'] < $b['price']) ? -1 : 1;};

?>
