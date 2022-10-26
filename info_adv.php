<!DOCTYPE>

<html>

<head>
    <title>A-Search result - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <!--<script src="https://use.fontawesome.com/bf6f75a73f.js"></script>-->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <script language="javascript">
        function change(id) {
            var url = "info_detail.php?id=" + id;
            //document.location.href=url;
            window.open(url);
        }
    </script>
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="header_resize">
                <div class="logo">
                    <div class="innerbox">
                        <h1><a href="index.html">CBD: <br>
                                Colorectal Cancer Biomarker Database</a></h1>
                    </div>
                </div>
                <div class="menu_nav">
                    <div class="innerbox">
                        <ul>
                            <li><a href="index.html"><i class="fa fa-home"></i>&nbsp;&nbsp;Home</a></li>
                            <li class="active"><a href="Biomarkers.html"><i class="fa fa-list"></i>&nbsp;&nbsp;Biomarkers</a></li>
                            <li><a href="Submission.php"><i class="fa fa-upload"></i>&nbsp;&nbsp;Submission</a></li>
                            <li><a href="Download.html"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;Download</a></li>
                            <li><a href="Explore.php"><i class="fa fa-flask"></i>&nbsp;&nbsp;Explore</a></li>
                            <li><a href="About.html"><i class="fa fa-file-text"></i>&nbsp;&nbsp;About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        /* Report all errors except E_NOTICE */
        error_reporting(E_ALL ^ E_NOTICE);
        //connect to MySQL
        $con = mysqli_connect('localhost', 'guest', 'guest_cbd', 'cbd_limina_top');
        if (!$con) {
            die("Fail to connect MySQL: " . mysqli_connect_errno());
        }
        mysqli_set_charset($con, 'utf8mb4');
        
        $q1 = $_GET["id1"];
        $q2 = $_GET["id2"];
        $q3 = $_GET["id3"];
        $q4 = $_GET["id4"];
        $q5 = $_GET["id5"];
        $q6 = $_GET["id6"];
        $q7 = $_GET["id7"];
        $q8 = $_GET["id8"];
        
        if ($q1 != "") {
            $sql11 = " (Region like '%" . $q1 . "%') ";
        } else {
            $sql11 = "";
        }
        
        if ($q2 != "") {
            if ($q1 == "") {
                $sql22 = " (Stage rlike '^" . $q2 . "$') ";
            } else {
                $sql22 = " and (Stage rlike '^" . $q2 . "$') ";
            }
        } else {
            $sql22 = "";
        }
        
        if ($q3 != "") {
            if ($q1 == "" && $q2 == "") {
                $sql33 = " (Location rlike '^" . $q3 . "$') ";
            } else {
                $sql33 = " and (Location rlike '^" . $q3 . "$') ";
            }
        } else {
            $sql33 = "";
        }
        
        if ($q4 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "") {
                $sql44 = " (Source rlike '^" . $q4 . "$') ";
            } else {
                $sql44 = " and (Source rlike '^" . $q4 . "$') ";
            }
        } else {
            $sql44 = "";
        }
        
        if ($q5 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "") {
                $sql55 = " (Application rlike '^" . $q5 . "$') ";
            } else {
                $sql55 = " and (Application rlike '^" . $q5 . "$') ";
            }
        } else {
            $sql55 = "";
        }
        
        if ($q6 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "" && $q5 == "") {
                $sql66 = " (Reference_first_author like '%" . $q6 . "%') ";
            } else {
                $sql66 = " and (Reference_first_author like '%" . $q6 . "%') ";
            }
        } else {
            $sql66 = "";
        }
        
        if ($q7 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "" && $q5 == "" && $q6 == "") {
                $sql77 = " (Reference_journal like '%" . $q7 . "%') ";
            } else {
                $sql77 = " and (Reference_journal like '%" . $q7 . "%') ";
            }
        } else {
            $sql77 = "";
        }
        
        if ($q8 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "" && $q5 == "" && $q6 == "" && $q7 == "") {
                $sql88 = " (Reference_year like '%" . $q8 . "%') ";
            } else {
                $sql88 = " and (Reference_year like '%" . $q8 . "%') ";
            }
        } else {
            $sql88 = "";
        }
        
        // retrieve information 
        $sql = "SELECT 
          ID, Stage, Biomarker, Source, Location, Region, Category, Application, 
          Reference_first_author, Reference_journal, Reference_year 
          FROM
          biomarker
          WHERE " . $sql11 . $sql22 . $sql33 . $sql44 . $sql55 . $sql66 . $sql77 . $sql88 . " 
          ORDER BY ID ASC";
        // echo $sql;
        $result = mysqli_query($con, $sql);

        // determine number of rows in returned result
        $biomarker = mysqli_num_rows($result);

        if (mysqli_num_rows($result) < 1) { ?>
        <div class="content">
            <div class="innerbox">
                <h2 style="text-align: center;">No Results Found</h2>
                <h3 style="text-align: center;">Please click the "Return" button to return to the search page.</h3>
                <div align="center" style="padding-top: 10px;">
                    <input name="return" type="button" id="cbutton" value="Return" onclick="window.open('Advanced.php', '_self')">
                </div>
        <?php
        } else { ?>
        <div class="content">
            <div class="innerbox">
                <h2 style="text-align: center;">The search result for Advanced Search</h2>
                <p style="text-align: center;"><?php echo $biomarker; ?> Biomarkers</p>
                <table class="tab" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Biomarker</th>
                            <th>Category</th>
                            <th>Region</th>
                            <th>Location</th>
                            <th>Stage</th>
                            <th>Source</th>
                            <th>Application</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                    // loop through the results
                    while ($row = mysqli_fetch_assoc($result)) {
                        extract($row); ?>
                        <tr onclick="change(this.id)" style="cursor:pointer;" id='<?php echo $ID ?>'>
                            <?php
                            echo '<td>' . $ID . '</td>';
                            echo '<td>' . $Biomarker . '</td>';
                            echo '<td>' . $Category . '</td>';
                            echo '<td>' . $Region . '</td>';
                            echo '<td>' . $Location . '</td>';
                            echo '<td>' . $Stage . '</td>';
                            echo '<td>' . $Source . '</td>';
                            echo '<td>' . $Application . '</td>';
                            echo '<td>' . $Reference_first_author . '. ' . $Reference_journal . '. ' . $Reference_year . '</td>';
                            ?>
                        </tr> <?php
                    }?>
                    </tbody>
                </table>
        <?php
        } ?>
            </div>
        </div>
    </div>
    
    <table height="90" cellspacing="0" cellpadding="0" class="footer">
        <tbody>
            <tr>
                <td style="text-align:center;vertical-align:middle;">
                    <div class="innerbox">
                        <p style="text-align: center;margin-top: 20px;">
                            <a href="http://www.suda.edu.cn/" target="_blank"><img src="images/suda.png" style="vertical-align:middle;"></a>
                            <a style="font-size: 30px;color: white;vertical-align: -5px;"> | </a>
                            <a href="https://www.gdghospital.org.cn/" target="_blank"><img src="images/gdph.png" style="vertical-align:middle;"></a>
                        </p>
                        <p style="text-align: center;">
                            <a style="color: white">Copyright &copy; 2018-2022 Colorectal Cancer Biomarker Database (CBD)</a><br>
                            <a href="http://sysbio.suda.edu.cn/" target="_blank" style="color:white;text-decoration:none;">Center for Systems Biology, Soochow University</a><a style="color: white"> | </a>
                            <a href="https://www.gdghospital.org.cn/" target="_blank" style="color:white;text-decoration:none;">Guangdong Provincial People's Hospital</a><br>
                            <a style="color: white">All Rights Reserved.</a>
                        </p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    
</body>

</html>