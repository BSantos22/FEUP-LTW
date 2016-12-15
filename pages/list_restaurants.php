<?php
    session_start();

    require_once('../database/connection.php');
    require_once ('../database/restaurant.php');
    require_once ('../database/user.php');

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
?>
