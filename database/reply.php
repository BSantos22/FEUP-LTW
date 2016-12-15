<?php

function getReplyByUser($db, $id){
    $stmt = $db->prepare('SELECT reply.id AS replyID, reply.idUser AS idUsername, reply.content AS replyContent, review.idReviewer AS idReviewer,
            review.idRestaurant AS idRestaurant, review.rating AS rating, review.text AS text, user.photopath AS userphotopath
                          FROM reply LEFT JOIN (review LEFT JOIN user ON review.idReviewer = user.username) review ON reply.idReview = review.id WHERE idUser = ?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function insertReply($db, $idReview, $idUser, $content) {
    $stmt = $db->prepare('INSERT INTO reply VALUES (NULL, ?, ?, ?)');
    $stmt->execute(array($idReview, $idUser, $content));
}
?>