<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoload.php';

if ($_SESSION['username']) {
    $login = $_SESSION['username'];
    $userRole = $db->query("SELECT `user_type` FROM `users` WHERE `login` = '$login'")->fetch_assoc()['user_type'];
    if ($userRole == 'admin') {
        $sql = $db->query("SELECT `id`,`title`,`group_id` FROM `disciplines`");
        if ($sql->num_rows == 0) {
            echo json_encode([
                'type' => 'error',
                'title' => 'Ошибка!',
                'msg' => 'Дисциплины не найдены'
            ]);
        } else {
            while($res = $sql->fetch_assoc()) {
                $groupId = $res['group_id'];
                $group = $db->query("SELECT * FROM `groups` WHERE `id` = '$groupId'")->fetch_assoc();
                $res['group'] = $group['name'];
                $result[] = $res;
            }
            echo json_encode($result);
        }
    }
}