<?php
  function getRestaurantReviewByID($id) {
    global $db;
    
    $stmt = $db->prepare('SELECT * FROM review WHERE id = ?');
    $stmt->execute(array($id));
    
    return $stmt->fetchAll();  
  }

  function getRestaurantReviewByRestaurant($id) {
    global $db;
    
    $stmt = $db->prepare('SELECT * FROM review WHERE idRestaurant = ?');
    $stmt->execute(array($id));
    
    return $stmt->fetchAll();  
  }
  
  function getRestaurantReviewByUser($id) {
    global $db;
    
    $stmt = $db->prepare('SELECT * FROM review WHERE idReviewer = ?');
    $stmt->execute(array($id));
    
    return $stmt->fetchAll();  
  }
?>
