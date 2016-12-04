<?php
function getReviewByRestaurant($db, $id){
  $stmt = $db->prepare('SELECT * FROM review WHERE idRestaurant = ?');
  $stmt->execute(array($id));

  return $stmt->fetchAll();
}
?>
