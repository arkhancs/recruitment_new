<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:./index.php');
    exit;
}
//export.php  
include('dbConfig.php');

$post = $_POST["post"];
//$sql = "select prsnl.*,edctn.*,exprn.* from prsnl join edctn on edctn.id=prsnl.id join exprn on exprn.id=prsnl.id where post ='$post' and prsnl.status='current'";
$sql = "SELECT a.id,CONCAT(surname,' ',a.name,' ',fathername, '\n','(',a.category,') ',a.caste_certino,', ',a.caste_certi_issue_year) as name,"
        . "CONCAT(a.dob,' (',a.age,')') as dob,"
        . "(CASE WHEN c.spec5 != '' THEN 'Yes' ELSE 'No' END) as phd_degree,"
        . "(CASE WHEN c.spec4 != '' THEN 'Yes' ELSE 'No' END) as master_degree,"
        . "(CASE WHEN c.spec3 != '' THEN 'Yes' ELSE 'No' END) as bachelor_degree,"
        . "CONCAT(c.spec5,', ',c.edu5,', (',c.per5,'%), ',c.div5,', ',c.year5,', ',c.board5) as phd_other,"
        . "CONCAT(c.spec4,', ',c.edu4,', (',c.per4,'%), ',c.div4,', ',c.year4,', ',c.board4) as Master,"
        . "CONCAT(c.spec3,', ',c.edu3,', (',c.per3,'%), ',c.div3,', ',c.year3,', ',c.board3) as Bachelor,"
        . "b.grandtotal,"
        . "if(b.org1 != '', CONCAT('1.', b.org1,', ',pos1,', ',from1,' to ',to1,', ',pay1,'(CTC)'),'') as Exp1,"
        . "if(b.org2 != '', CONCAT('2.', b.org2,', ',pos2,', ',from2,' to ',to2,', ',pay2,'(CTC)'),'') as Exp2,"
        . "if(b.org3 != '', CONCAT('3.', b.org3,', ',pos3,', ',from3,' to ',to3,', ',pay3,'(CTC)'),'') as Exp3,"
        . "if(b.org4 != '', CONCAT('4.', b.org4,', ',pos4,', ',from4,' to ',to4,', ',pay4,'(CTC)'),'') as Exp4,"
        . "if(b.org5 != '', CONCAT('5.', b.org5,', ',pos5,', ',from5,' to ',to5,', ',pay5,'(CTC)'),'') as Exp5,"
        . "if(b.org6 != '', CONCAT('6.', b.org6,', ',pos6,', ',from6,' to ',to6,', ',pay6,'(CTC)'),'') as Exp6,"
        . "if(b.org7 != '', CONCAT('7.', b.org7,', ',pos7,', ',from7,' to ',to7,', ',pay7,'(CTC)'),'') as Exp7,"
        . "if(b.org8 != '', CONCAT('8.', b.org8,', ',pos8,', ',from8,' to ',to8,', ',pay8,'(CTC)'),'') as Exp8,"
        . "if(b.org9 != '', CONCAT('9.', b.org9,', ',pos9,', ',from9,' to ',to9,', ',pay9,'(CTC)'),'') as Exp9,"
        . "if(b.org10 != '', CONCAT('10.', b.org10,', ',pos10,', ',from10,' to ',to10,', ',pay10,'(CTC)'),'') as Exp10,"
        . "CONCAT(a.email,', ',a.mobile) as contact,"
        . "CONCAT(a.status_check,', ',a.status_remarks,'\n',', ',a.status_date) as status_check,"
		. "CONCAT(a.address,', ',a.city,', ',a.pincode,', ',s.name) as MailAddress,"
		. "CONCAT(a.paddress,', ',a.pcity,', ',a.ppincode,', ',s.name) as PerAddress,"
        . "d.transaction_ref_no, a.regdate, d.hard_copy_received FROM prsnl a "
        . "INNER JOIN exprn b ON b.id = a.id "
        . "INNER JOIN edctn c ON c.id = b.id "
        . "INNER JOIN othrs d ON d.id = b.id "
		. "INNER JOIN states s ON s.id = a.state "
        . "left join req_experience re on re.post = a.post "
        . "where a.status = 'current' and a.post = '$post'";
		
$result = mysqli_query($link, $sql);
$filename = $post.".csv";
header("Content-Type: text/csv");
header('Content-Disposition: attachment; filename=' . $filename);
$flag = false;
$fp = fopen('php://output', 'w');

if (mysqli_num_rows($result) > 0) {


    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    $array_key[] = array_keys($array[0]);
    $values = array_values($array);


    foreach ($array_key as $key => $value) {
        fputcsv($fp, $value);
        fputcsv($fp, "\n");
    }

    foreach ($values as $value) {
        fputcsv($fp, $value);
        fputcsv($fp, "\n");
    }
}

fclose($fp);
exit();
?>
