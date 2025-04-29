<?php
error_reporting(0);
include "dbConfig.php";
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>HR Recruitment </title>
        <script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
        <script type="text/javascript" language="javascript" src="js/validate.js"></script>
        <script type="text/javascript" language="javascript" src="js/script.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"></link>
        <link rel="stylesheet" href="css/jquery-ui.css"></link>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="dtpicker/jquery-1.10.2.js"></script>
        <script src="dtpicker/jquery-ui.js"></script>
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></link>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css"></link>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <style>
            .btn {
                background-color: white;
                color: black;
                padding: 8px 10px;
                font-size: 16px;
                cursor: pointer;
            }
            .default {
                border-color: #e7e7e7;
                color: black;

            }

            .default:hover {
                background: #e7e7e7;
            }
        </style>
    </head>
    <body>
        <?php if ($_SESSION['is_login'] == 'true') { ?>
            <div class="container" style="padding-top:10px;">

                <div align="center" style="padding-top:10px;">
                    <img style="pull-center" src="images/logo1.png" height="80" />
                    <h3 style="color:#000080">
                        <b> HR Recruitment <?php echo date("Y"); ?>
                        </b>
                    </h3>

                    <hr/>
                </div>

            </div>
            <div class="container" >
                <?php
                $sql = "select * from req_experience order by id desc";
                $result = mysqli_query($link, $sql);
                ?>

                <div class="pull-right"><b>     <h4 style="color:#337ab7; display: inline-block;" >Welcome <?php echo $_SESSION['user'] . ","; ?></h4>
                        <a  href="logout.php" style="display:inline-block"><i class="fas fa-power-off"  style="font-size:20px"></i></a></b><?php } ?></div>
            <br/>

            <div align="center">    <?php if ($_SESSION['is_login'] == 'true') { ?><select class="form-control" style="width:40%" id="post" name="post">
                        <option value=""><b>Select Post</b></option>
                        <?php
                        if ($result) {

                            if (mysqli_num_rows($result) == 0) {
                                
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['category'] != '') {
                                        $post_name = $row['Name'] . '(' . $row['category'] . ')';
                                        ?>
                                        <option value="<?php echo $row['post_id'] . $row['category'] . '-' . $row['sequence'] . '-' . $row['year']; ?>"><?php echo $row['Name'] . '(' . $row['category'] . ')'; ?> </option>    

                                        <?php
                                    } else {
                                        $post_name = $row['Name'];
                                        ?>
                                        <option value="<?php echo $row['post_id'] . '-' . $row['sequence'] . '-' . $row['year']; ?>"><?php echo $row['Name']; ?> </option>    
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

            </div>
            <br> <br>
                    <div class="container" style="margin-bottom: 20px" >
                        <table id="example" class="table table-striped table-bordered" style="width:100%;" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Post</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>DOB</th>
                                    <th>Mobile</th>
                                    <th>Print</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    </body>  <?php
                } else {
                    header("location:Login.php");
                    exit;
                }
                ?></html>
                <script type="text/javascript">
                    $('#example').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'copyHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            }, {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                        ],

                        "columns": [{
                                "data": "id", "defaultContent": "<i>NULL</i>"
                            }, {
                                "data": "post", "defaultContent": "<i>NULL</i>"
                            }, {
                                "data": "name", "defaultContent": "<i>NULL</i>"
                            }, {
                                "data": "category", "defaultContent": "<i>NULL</i>"
                            }, {
                                "data": "dob", "defaultContent": "<i>NULL</i>"
                            },
                            {
                                "data": "mobile", "defaultContent": "<i>NULL</i>"
                            }, {"data": "printapplication",
                                "orderable": false,
                                "searchable": false, "className": "text-center",
                                "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                    var a = '<a href="candidate_application.php?id=' + row.id + '" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>'; // row object contains the row data
                                    return a;
                                }
                            }
                        ]

                    });
                    $('.dt-button').addClass('btn btn-default');
                    $('select').on('change', function () {

                        $("#example").dataTable().fnDestroy();
                        //$('#example').show();
                        $('#example').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                            ],
                            "processing": true,
                            "ajax": {
                                "url": "LoadCandidatesdetails.php",
                                "dataSrc": "",
                                "data": {"post": $(this).val()}, "type": "POST",
                            },
                            "columns": [{
                                    "data": "id", "defaultContent": "<i>NULL</i>"
                                }, {
                                    "data": "post", "defaultContent": "<i>NULL</i>"
                                }, {
                                    "data": "name", "defaultContent": "<i>NULL</i>"
                                }, {
                                    "data": "category", "defaultContent": "<i>NULL</i>"
                                }, {
                                    "data": "dob", "defaultContent": "<i>NULL</i>"
                                },
                                {
                                    "data": "mobile", "defaultContent": "<i>NULL</i>"
                                }, {"data": "printapplication",
                                    "orderable": false,
                                    "searchable": false, "className": "text-center",
                                    "render": function (data, type, row, meta) { // render event defines the markup of the cell text 
                                        var a = '<a href="candidate_application.php?id=' + row.id + '" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>'; // row object contains the row data
                                        return a;
                                    }
                                }
                            ]

                        });
                        $('.dt-button').addClass('btn btn-default');
                    });

                </script>
