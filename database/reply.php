<?php

function getReplyByUser($db, $id){
    $stmt = $db->prepare('SELECT reply.id AS replyID, reply.idUser AS idUsername, reply.content AS replyContent, review.idReviewer AS idReviewer,
            review.idRestaurant AS idRestaurant, review.rating AS rating, review.text AS text, user.photopath AS userphotopath, restaurant.name AS restaurantname
                          FROM reply LEFT JOIN (review LEFT JOIN user ON review.idReviewer = user.username LEFT JOIN restaurant on review.idRestaurant = restaurant.id) review ON reply.idReview = review.id WHERE idUser = ?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function insertReply($db, $idReview, $idUser, $content) {
    $stmt = $db->prepare('INSERT INTO reply VALUES (NULL, ?, ?, ?)');
    $stmt->execute(array($idReview, $idUser, $content));
}
?>