<?php
function getReviewsByRestaurant($db, $id){
  $stmt = $db->prepare('SELECT * FROM review WHERE idRestaurant = ?');
  $stmt->execute(array($id));

  return $stmt->fetchAll();
}

function getReviewsByReviewer($db, $username){
    $stmt = $db->prepare('SELECT review.idReviewer AS reviewer, review.rating AS rating, review.text AS text, restaurant.name AS restaurantname, restaurant.id AS restaurantid
                          FROM review LEFT JOIN restaurant ON review.idRestaurant = restaurant.id WHERE idReviewer = ?');
    $stmt->execute(array($username));

    return $stmt->fetchAll();
}

function insertReview($db, $idReviewer, $idRestaurant, $rating, $text) {
    $stmt = $db->prepare('INSERT INTO review VALUES (NULL, ?, ?, ?, ?)');
    $stmt->execute(array($idReviewer, $idRestaurant, $rating, $text));
}
?>
