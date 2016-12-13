<?php

function createRestaurant($db, $name, $username, $address, $zipcode, $city, $country, $category, $price, $opentime, $closetime) {
    $query = "INSERT INTO restaurant VALUES(NULL, ?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->execute(array($name, $username, $address, $zipcode, $city, $country, $category, $price, $opentime, $closetime, 5));
}


function updateRestaurant($db, $id, $name, $address, $zipcode, $city, $country, $category, $price, $opentime, $closetime) {
    $query = $db->prepare('UPDATE restaurant SET name = ?, address = ?, zipcode = ?, city = ?, country = ?, category = ?, price = ?, opentime = ?, closetime = ? WHERE id = ?');
    $stmt = $db->prepare($query);
    $stmt->execute(array($name, $address, $zipcode, $city, $country, $category, $price, $opentime, $closetime, $id));
}

function getAllRestaurants($db){
    $stmt = $db->prepare('SELECT * FROM restaurant');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getRestaurantById($db, $id) {
    $stmt = $db->prepare('SELECT * FROM restaurant WHERE id = ?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getRestaurantByName($db, $name) {
    $stmt = $db->prepare('SELECT * FROM restaurant WHERE name = ?');
    $stmt->execute(array($name));

    return $stmt->fetch();
}

function getRestaurantByOwner($db, $owner) {
    $stmt = $db->prepare('SELECT * FROM restaurant WHERE idOwner = ?');
    $stmt->execute(array($owner));

    return $stmt->fetchAll();
}

function searchRestaurantByName($db, $keyword) {
    $word = "%{$keyword}%";

    $stmt = $db->prepare('SELECT * FROM restaurant WHERE name LIKE ?');
    $stmt->execute(array($word));

    return $stmt->fetchAll();
}

function searchRestaurantsByKeywords($db, $keywords) {
    $entries = [];
    $final_results = [];

    foreach ($keywords as $value) {
        $result = searchRestaurantByName($db, $value);

        foreach($result as $restaurant) {
            add_entry($entries, $restaurant);
        }
    }

    usort($entries, "cmp_entries");

    /*
    foreach ($entries as $a) {
        echo nl2br ("{$a[0]['name']} - {$a[1]} \n");
    }*/

    foreach ($entries as $entry) {
        array_push($final_results, $entry[0]);
    }

    return $final_results;
}

//============================================================================================================
// Auxiliar functions

// adds an entry to an array
// array structure (entry, n_times_entered)
function add_entry(&$array, $entry) {
    $found = false;

    foreach ($array as &$member) {
        if ($member[0] == $entry) {
            $member[1]++;
            $found = true;
        }
    }

    if (!$found) {
        array_push($array, [$entry, 1]);
    }
}

// comparison function, biggest values first
function cmp_entries($a, $b) {
    if ($a[1] == $b[1]) {
        return 0;
    }

    return ($a[1] > $b[1]) ? -1 : 1;
}



?>