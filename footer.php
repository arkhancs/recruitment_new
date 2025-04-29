<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-9">Care : we expect heavy load on the website towards the last date for applying. please, therefore, apply well before the closing date to avoid network congestion / disconnection & inability to register your application.</div>
            <div class="col-md-3 text-right"> <?php

                function getUserIpAddr() {
                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    return $ip;
                }

                $ip = getUserIpAddr();
                ?>
                <?php
                include 'dbConfig.php';
                $d = date("Y-m-d H:i:s");
                $qry = "SELECT * FROM ipdb WHERE ip = '$ip'";
                $result = mysqli_query($link, $qry);
                $num = mysqli_num_rows($result);
                if ($num == 0) {
                    $qry3 = "INSERT INTO ipdb(ip, create_date) VALUES ('$ip', '$d')";
                    mysqli_query($link, $qry3);
                    $qry1 = "SELECT * FROM counter WHERE id = 0";
                    $result1 = mysqli_query($link, $qry1);
                    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                    $count = $row1['visiters'];
                    $count = $count + 1;
                    $qry2 = "UPDATE counter SET visiters = '$count' WHERE id = 0";
                    $result2 = mysqli_query($link, $qry2);
                } else {
                    $qry1 = "SELECT * FROM counter WHERE id = 0";
                    $result1 = mysqli_query($link, $qry1);
                    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                    $count = $row1['visiters'];
                }
                $numlength = strlen((string) $count);
                ?>
                Total visitors since 
                <?php
                echo date('d-M-Y') . ':<br>';
                $count;
                echo $stri = (string) $count;
                ?></div>
        </div>
    </div>
</footer>