<?php
include('dbConfig.php');
$sql = "select * from proeligible";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['reg_id'];
        $sql = "update prsnl set status_check='Provisionally' where id='$id'";
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