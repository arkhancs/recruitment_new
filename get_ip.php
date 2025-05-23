<?php

date_default_timezone_set('Asia/Kolkata');
$ua = getBrowser();
//$brawser_h = implode(", ", $ua);
$ua_browser = $ua['name'];
$ua_version = $ua['version'];
$ua_platform = $ua['platform'];
//$ua_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
$ua_ip = '';
if (getenv('HTTP_CLIENT_IP')) {
    $ua_ip = getenv('HTTP_CLIENT_IP');
} else if (getenv('HTTP_X_FORWARDED_FOR')) {
    $ua_ip = getenv('HTTP_X_FORWARDED_FOR');
} else if (getenv('HTTP_X_FORWARDED')) {
    $ua_ip = getenv('HTTP_X_FORWARDED');
} else if (getenv('HTTP_FORWARDED_FOR')) {
    $ua_ip = getenv('HTTP_FORWARDED_FOR');
} else if (getenv('HTTP_FORWARDED')) {
    $ua_ip = getenv('HTTP_FORWARDED');
} else if (getenv('REMOTE_ADDR')) {
    $ua_ip = getenv('REMOTE_ADDR');
} else {
    $ua_ip = 'UNKNOWN';
}
$ua_date = date("Y-m-d");
$ua_time = date("H:i:s");

function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";
    // First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }
    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }
    return array(
        'name' => $bname,
        'version' => $version,
        'platform' => $platform
    );
}

?>