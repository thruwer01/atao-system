<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload.php';

if ($_SESSION['username']) {
    $login = $_SESSION['username'];

    $sql = $db->query("SELECT * FROM `groups`");
    while($result = $sql->fetch_assoc()) {
        $res[] = $result;
    }
    echo json_encode($res);
    
}