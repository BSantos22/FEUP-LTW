<?php
/**
 * Created by PhpStorm.
 * User: Manuel Gomes
 * Date: 19/11/2016
 * Time: 04:30
 */

/*function getUserByUsername($username) {
    global $db;
    $query = "SELECT * FROM User WHERE username = :username";
    $stmt = $db->prepare ( $query );
    $stmt->bindParam ( ':username', $username, PDO::PARAM_STR );
    $stmt->execute ();
    return $stmt->fetch ();*/