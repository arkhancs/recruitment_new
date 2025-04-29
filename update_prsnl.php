<?php

include('dbConfig.php');
$sql = "select id,photo from prsnl_1 ";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $photo = $row['photo'];
        $sql = "update prsnl set photo='$photo' where id='$id'";
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