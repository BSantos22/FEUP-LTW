<?php

function createRestaurant($db, $name, $username, $address, $zipcode, $city, $country, $category, $price, $opentime, $closetime) {
    $query = "INSERT INTO restaurant VALUES(NULL, ?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->execute(array($name, $username, $address, $zipcode, $city, $country, $category, $price, $opentime, $closetime, 0.0, 'defaultphoto.png'));
}

function updateRestaurant($db, $id, $name, $street, $zipcode, $city, $country, $category, $price, $opentime, $closetime) {
    $query = "UPDATE restaurant SET name = ?, street = ?, zipcode = ?, city = ?, country = ?, category = ?, price = ?, opentime = ?, closetime = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($name, $street, $zipcode, $city, $country, $category, $price, $opentime, $closetime, $id));
}

function updateRestaurantPhoto($db, $id, $photo) {
    $query = "UPDATE restaurant SET restaurantphoto = ?  WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($photo, $id));
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

function searchRestaurant($db, $parameter ,$keyword, $filters) {
    $results = [];
    $word = "%{$keyword}%";

    $query = 'SELECT * FROM restaurant WHERE ';
    $n = 0;

    switch($parameter) {
        case "name":
            $query .= 'name LIKE ?';
            $n = 1;
            break;
        case "street":
            $query .= 'street LIKE ?';
            $n = 1;
            break;
        case "zipcode":
            $query .= 'zipcode LIKE ?';
            $n = 1;
            break;
        case "city":
            $query .= 'city LIKE ?';
            $n = 1;
            break;
        case "country":
            $query .= 'country LIKE ?';
            $n = 1;
            break;
        case "category":
            $query .= 'category LIKE ?';
            $n = 1;
            break;
    }

    $values = [];
    foreach($filters as $filter) {
        switch ($filter[0]) {
            case "rating":
                if ($n == 1) {
                    $query .= ' AND ';
                }
                $query .= 'CAST(reviewersRating AS INT)';
                $n = 1;
                break;
            case "price":
                if ($n == 1) {
                    $query .= ' AND ';
                }
                $query .= 'CAST(price AS INT)';
                $n = 1;
                break;
        }

        switch($filter[1]) {
            case "equal":
                $query .= ' = ?';
                break;
            case "bigger":
                $query .= ' > ?';
                break;
            case "smaller":
                $query .= ' < ?';
                break;
            case "bigger-equal":
                $query .= ' >= ?';
                break;
            case "smaller-equal":
                $query .= ' <= ?';
                break;
        }

        array_push($values, $filter[2]);
    }


    $stmt = $db->prepare($query);

    // Filter only search
    if (strlen($keyword) == 0) {
        $stmt->execute($values);
        $results = $stmt->fetchAll();
    }

    // Keyword and filter search
    for ($i=1; $i<strlen($keyword); $i++) {
        $approximate_word = $word;
        $approximate_word[$i] = '_';

        $execute = array_merge(array($approximate_word), $values);

        $stmt->execute($execute);
        $result = $stmt->fetchAll();
        $results = array_merge($results, $result);
    }

    return $results;
}

function searchRestaurantsByKeywords($db, $keywords, $type, $filters) {
    $entries = [];
    $final_results = [];

    // Filter only search
    if ($keywords[0] == null) {
        $result = searchRestaurant($db, "", "", $filters);

        foreach($result as $restaurant) {
            add_entry($entries, $restaurant);
        }
    }

    // Keyword and filter search
    foreach ($keywords as $value) {
        $result = [];

        switch($type) {
            case "restaurant":
                $result = searchRestaurant($db, "name", $value, $filters);
                break;
            case "location":
                $result1 = searchRestaurant($db, "street", $value, $filters);
                $result2 = searchRestaurant($db, "zipcode", $value, $filters);
                $result3 = searchRestaurant($db, "city", $value, $filters);
                $result4 = searchRestaurant($db, "country", $value, $filters);
                $result = array_merge($result1, $result2, $result3, $result4);
                break;
            case "category":
                $result = searchRestaurant($db, "category", $value, $filters);
                break;
        }


        foreach($result as $restaurant) {
            add_entry($entries, $restaurant);
        }
    }

    usort($entries, "cmp_entries");

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