<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:Admin_login.php');
    exit;
}
//error_reporting(E_ALL ^ E_DEPRECATED);
//error_reporting(0);

include('dbConfig.php');

$post = mysqli_real_escape_string($link, $_POST['post']);
//$location = mysqli_real_escape_string($link, $_POST['location']);
//$sql = "SELECT distinct a.id,CONCAT(surname,' ',a.name,' ',fathername) as name,a.job_location, re.Name as postname,a.category,a.dob, b.grandtotal, a.email,a.mobile, a.status_check FROM prsnl a INNER JOIN exprn b ON b.id = a.id INNER JOIN edctn c ON c.id = b.id INNER JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post' and a.job_location = '$location' and a.post<>'NA' and a.name <> '' order by a.name";
/* $sql = "SELECT distinct a.id,CONCAT(surname,' ',a.name,' ',fathername) as name,re.Name as postname,a.category,a.dob, a.age, b.grandtotal, a.email,a.mobile, a.status_check, CONCAT(c.spec3,', ',c.edu3,', (',c.per3,'%), ',c.board3) as bachelor, CONCAT(c.spec4,', ',c.edu4,', (',c.per4,'%), ',c.board4) as master, CONCAT(c.spec5,', ',c.edu5,', (',c.per5,'%), ',c.board5) as phd_other FROM prsnl a INNER JOIN exprn b ON b.id = a.id INNER JOIN edctn c ON c.id = b.id INNER JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post' and a.post<>'NA' and a.name <> '' order by a.name"; */

$sql = "SELECT distinct a.id,CONCAT(prefix,a.name,' ',fathername,' ',surname, '<hr>\r\n\r','(',a.category,') ','\r\n\r',a.caste_certino,'\r\n\r',a.caste_certi_issue_year) as name,re.Name as postname, CONCAT(a.dob,'<hr>\r',' (',a.age,')') as dob, "
        . "CONCAT(b.grandtotal,'<hr>\r\n\r',"
        . "if(b.org1 != '', CONCAT('1.', b.org1,', ',pos1,', ',from1,' to ',to1,', ',pay1,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org2 != '', CONCAT('2.', b.org2,', ',pos2,', ',from2,' to ',to2,', ',pay2,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org3 != '', CONCAT('3.', b.org3,', ',pos3,', ',from3,' to ',to3,', ',pay3,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org4 != '', CONCAT('4.', b.org4,', ',pos4,', ',from4,' to ',to4,', ',pay4,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org5 != '', CONCAT('5.', b.org5,', ',pos5,', ',from5,' to ',to5,', ',pay5,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org6 != '', CONCAT('6.', b.org6,', ',pos6,', ',from6,' to ',to6,', ',pay6,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org7 != '', CONCAT('7.', b.org7,', ',pos7,', ',from7,' to ',to7,', ',pay7,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org8 != '', CONCAT('8.', b.org8,', ',pos8,', ',from8,' to ',to8,', ',pay8,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org9 != '', CONCAT('9.', b.org9,', ',pos9,', ',from9,' to ',to9,', ',pay9,'(CTC)<hr>\r\n\r'),''),"
        . "if(b.org10 != '', CONCAT('10.', b.org10,', ',pos10,', ',from10,' to ',to10,', ',pay10,'(CTC)'),'')"
        . ") as grandtotal, "
        . "(CASE WHEN c.spec3 != '' THEN 'Yes' ELSE 'No' END) as bachelor,"
        . "(CASE WHEN c.spec4 != '' THEN 'Yes' ELSE 'No' END) as master,"
        . "(CASE WHEN c.spec5 != '' THEN 'Yes' ELSE 'No' END) as phd,"
        . "CONCAT(a.email,'<hr>\r\n\r',a.mobile) as email, CONCAT(a.status_check,'\n',', ',a.status_remarks,'\n',', ',a.status_date) as status_check, CONCAT('Ph.D./Others: ',c.spec5,', ',c.edu5,', (',c.per5,'%), ',c.div5,', ',c.year5,', ',c.board5, '<hr>\r\n\r' ,'Master: ',c.spec4,', ',c.edu4,', (',c.per4,'%), ',c.div4,', ',c.year4,', ',c.board4, '<hr>\r\n\r' ,'Bachelor: ',c.spec3,', ',c.edu3,', (',c.per3,'%), ',c.div3,', ',c.year3,', ',c.board3, '<hr>\r\n\r' ,'DCA: ',c.spec7,', ',c.edu7,', (',c.per7,'%), ',c.div7,', ',c.year7,', ',c.board7) as qualification, CONCAT(d.transaction_ref_no,'\n',', ',d.dd_date,'\n',', ',d.dd_amount) as transaction_ref_no, a.regdate, d.hard_copy_received FROM prsnl a LEFT JOIN exprn b ON b.id = a.id LEFT JOIN edctn c ON c.id = b.id LEFT JOIN othrs d ON d.id = b.id left join req_experience re on re.post = a.post where a.status = 'current' and a.post <>'' and a.post = '$post' and a.post<>'NA' order by a.name";

$result = mysqli_query($link, $sql);

if ($result) {
    if (mysqli_num_rows($result) == 0) {
        $arr[] = ['', '', '', '', '', '', '', '', '', ''];
    } else {

        $result2 = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo json_encode($arr);
}
?>