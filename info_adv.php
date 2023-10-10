<!DOCTYPE>

<html>

<head>
    <title>A-Search result - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <!-- Roboto 字体 -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script language="javascript">
        function change(id) {
            var url = "info_detail.php?id=" + id;
            //document.location.href=url;
            window.open(url);
        }
        
        function foothelp(e) {
            if (e.id == "Use") {
                var frameurl = "help/index.html#/Use";
            } else if (e.id == "Cite") {
                var frameurl = "help/index.html#/Cite";
            } else if (e.id == "Updatelog") {
                var frameurl = "help/index.html#/Updatelog";
            } else if (e.id == "Home") {
                var frameurl = "help/index.html#/";
            }
            // alert(frameurl);
            // 在 _self 打开获取不了 newwindow
            var newwindow = window.open('About.html');
            newwindow.onload = function() {
                newwindow.document.getElementsByClassName('f_content')['f_content']['src'] = frameurl;
            }
        }
    </script>
</head>

<body>
    <div class="main">
        <div class="header">
            <div class="header_resize">
                <div class="logo">
                    <div class="innerbox">
                        <h1><a href="index.html">CBD2: <br>
                                Colorectal Cancer Biomarker Database</a></h1>
                    </div>
                </div>
                <div class="menu_nav">
                    <div class="innerbox">
                        <ul class="menu">
                            <li><a href="index.html"><i class="fa fa-home"></i>&nbsp;&nbsp;Home</a></li>
                            <li class="active"><a href="Biomarkers.html"><i class="fa fa-list"></i>&nbsp;&nbsp;Biomarkers</a>
                            <ul class="submenu">
                                <li><a href="NBiomarkers.php">Non-Biomarkers</a></li>
                            </ul>
                            </li>
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
        // connect to MySQL
        $con = mysqli_connect('localhost', 'user', 'passwd', 'database');
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
        
        // Region 模糊匹配
        if ($q1 != "") {
            $sql11 = " (Region like '%" . $q1 . "%') ";
        } else {
            $sql11 = "";
        }
        // Stage 精确匹配
        if ($q2 != "") {
            if ($q1 == "") {
                $sql22 = " (Stage rlike '^" . $q2 . "$') ";
            } else {
                $sql22 = " and (Stage rlike '^" . $q2 . "$') ";
            }
        } else {
            $sql22 = "";
        }
        // Location 精确匹配
        if ($q3 != "") {
            if ($q1 == "" && $q2 == "") {
                $sql33 = " (Location rlike '^" . $q3 . "$') ";
            } else {
                $sql33 = " and (Location rlike '^" . $q3 . "$') ";
            }
        } else {
            $sql33 = "";
        }
        // Source 精确匹配
        if ($q4 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "") {
                $sql44 = " (Source rlike '^" . $q4 . "$') ";
            } else {
                $sql44 = " and (Source rlike '^" . $q4 . "$') ";
            }
        } else {
            $sql44 = "";
        }
        // Application 精确匹配
        if ($q5 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "") {
                $sql55 = " (Application rlike '^" . $q5 . "$') ";
            } else {
                $sql55 = " and (Application rlike '^" . $q5 . "$') ";
            }
        } else {
            $sql55 = "";
        }
        // First author 精确匹配
        if ($q6 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "" && $q5 == "") {
                $sql66 = " (Reference_first_author rlike '^" . $q6 . "$') ";
            } else {
                $sql66 = " and (Reference_first_author rlike '^" . $q6 . "$') ";
            }
        } else {
            $sql66 = "";
        }
        // Journal 精确匹配
        if ($q7 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "" && $q5 == "" && $q6 == "") {
                $sql77 = " (Reference_journal rlike '^" . $q7 . "$') ";
            } else {
                $sql77 = " and (Reference_journal rlike '^" . $q7 . "$') ";
            }
        } else {
            $sql77 = "";
        }
        // Year 精确匹配
        if ($q8 != "") {
            if ($q1 == "" && $q2 == "" && $q3 == "" && $q4 == "" && $q5 == "" && $q6 == "" && $q7 == "") {
                $sql88 = " (Reference_year rlike '^" . $q8 . "$') ";
            } else {
                $sql88 = " and (Reference_year rlike '^" . $q8 . "$') ";
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
        
        <div class="footer">
            <div class="innerbox">
                <div class="footer-left">
                    <h2 style="color: #d6d6d6;font-family: 'Roboto',sans-serif;font-size: 22px;">&copy; CBD2 2018-2022</h2>
                    <ul>
                        <li id="liu-logo">
                            <a href="https://liu.se/en" target="_blank"><img src="images/liu.png" style="vertical-align:middle;"></a>
                        </li>
                        <li id="suda-logo">
                            <a href="http://www.suda.edu.cn/" target="_blank"><img src="images/suda.png" style="vertical-align:middle;margin-left: -8px;"></a>
                        </li>
                        <li id="gdph-logo">
                            <a href="https://www.gdghospital.org.cn/" target="_blank"><img src="images/gdph.png" style="vertical-align:middle;margin-left: -5px;margin-top: -5px;"></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-right">
                    <h2 style="color: #d6d6d6;font-family: 'Roboto',sans-serif;font-size: 22px;">Links</h2>
                    <ul>
                        <li>
                            <a href="https://liu.se/en" target="_blank">Linköping University</a>
                        </li>
                        <li>
                            <a href="http://www.suda.edu.cn/" target="_blank">Soochow University</a>
                        </li>
                        <li>
                            <a href="https://www.gdghospital.org.cn/" target="_blank">Guangdong Provincial People's Hospital</a>
                        </li>
                        <li>
                            <i class="fa-brands fa-github"></i>&nbsp;&nbsp;<a href="https://github.com/WhyLIM/CBD" target="_blank">Open Source</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-right">
                    <h2 style="color: #d6d6d6;font-family: 'Roboto',sans-serif;font-size: 22px;">Help</h2>
                    <ul>
                        <li>
                            <a id="Use" onclick="javascript:foothelp(this); return false;" href="#">How to Use</a>
                        </li>
                        <li>
                            <a id="Cite" onclick="javascript:foothelp(this); return false;" href="#">Reference</a>
                        </li>
                        <li>
                            <a id="Updatelog" onclick="javascript:foothelp(this); return false;" href="#">Updatelog</a>
                        </li>
                        <li>
                            <a id="Home" onclick="javascript:foothelp(this); return false;" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-right">
                    <h2 style="color: #d6d6d6;font-family: 'Roboto',sans-serif;font-size: 22px;">Support</h2>
                    <ul>
                        <li>
                            <a href="https://fontawesome.com/" target="_blank">Icon</a>
                        </li>
                        <li>
                            <a href="https://docsify.js.org/#/" target="_blank">Document</a>
                        </li>
                        <li>
                            <a href="https://string-db.org/cgi/help?sessionId=bshQSgoux29C" target="_blank">APIs</a>
                        </li>
                        <li>
                            <a>Researchers Worldwide</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>