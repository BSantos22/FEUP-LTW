<?php
function getReviewByRestaurant($db, $id){
  $stmt = $db->prepare('SELECT * FROM review WHERE idRestaurant = ?');
  $stmt->execute(array($id));

  return $stmt->fetchAll();
}

function insertReview($db, $idReviewer, $idRestaurant, $rating, $text) {
    $stmt = $db->prepare('INSERT INTO review VALUES (NULL, ?, ?, ?, ?)');
    $stmt->execute(array($idReviewer, $idRestaurant, $rating, $text));
}


?>
