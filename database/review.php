<?php
function getReviewsByRestaurant1($db, $id){
    $stmt = $db->prepare('SELECT review.id AS reviewID, review.idReviewer AS idReviewer, review.rating AS rating, review.text AS text, user.name AS username, user.photopath AS usernamephotopath
                          FROM review LEFT JOIN user ON review.idReviewer = user.username WHERE idRestaurant = ?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}


function getReviewsByRestaurant($db, $id){
    $stmt = $db->prepare('SELECT reply.id AS replyID, reply.idUser AS idOwner, reply.content AS replyContent, review.idReviewer AS idReviewer, reviewer.photopath AS reviewerphotopath,
            review.id AS reviewID, review.idRestaurant AS idRestaurant, review.rating AS rating, review.text AS text, owner.username AS ownerusername, owner.photopath AS ownerphotopath
                          FROM review LEFT JOIN (reply LEFT JOIN user owner ON reply.idUser = owner.username) reply ON review.id = reply.idReview LEFT JOIN user reviewer ON review.idReviewer = reviewer.username WHERE idRestaurant = ?');
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
