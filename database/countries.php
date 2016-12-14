<?php
function getCountries($db){
    $stmt = $db->prepare('SELECT * FROM country');
    $stmt->execute();

    return $stmt->fetchAll();
}
?>