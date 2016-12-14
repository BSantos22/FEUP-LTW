<?php
function getReplyByUser($db, $id){
    $stmt = $db->prepare('SELECT * FROM reply WHERE idUser = ?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function insertReply($db, $idReview, $idUser, $content) {
    $stmt = $db->prepare('INSERT INTO reply VALUES (NULL, ?, ?, ?)');
    $stmt->execute(array($idReview, $idUser, $content));
}
?>