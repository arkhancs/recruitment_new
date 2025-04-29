<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
include('dbConfig.php');

$sql = "select id, password from prsnl_old where srno >= 4690";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $pwd = $row['password'];

        $sql = "update prsnl set password='$pwd' where id='$id'";
        $result_update = mysqli_query($link, $sql);
        if ($result_update) {
            echo $id . '- Success'; 
            echo '<br>';
        }else{
            echo $id . '- fail'; 
        }
    }
    exit();
}
?>