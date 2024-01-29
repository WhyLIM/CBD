<!DOCTYPE html>

<html>

<head>
    <title>K-Search result - CBD</title>
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
        //connect to MySQL
        $con = mysqli_connect('ip','user','passwd', 'database');
        if (!$con) {
            die("Fail to connect MySQL: " . mysqli_connect_errno());
        }
        mysqli_set_charset($con, 'utf8mb4');

        $ida = $_GET['id'];
        // retrieve information 
        $query1 = 'SELECT 
                   ID, Biomarker, Category, Location, Application, Reference_first_author, Reference_journal, Reference_year 
                   FROM 
                   biomarker 
                   WHERE Biomarker like "%' . $ida . '%" 
                   ORDER BY 
                   ID ASC';
        $result1 = mysqli_query($con, $query1);
        
        $query2 = 'SELECT 
                   ID, Biomarker, Application, Reference_first_author, Reference_year 
                   FROM 
                   `non-biomarker` 
                   WHERE Biomarker like "%' . $ida . '%" 
                   ORDER BY 
                   ID ASC';
        $result2 = mysqli_query($con, $query2);
        
        // determine number of rows in returned result
        $biomarker = mysqli_num_rows($result1);
        $nbiomarker = mysqli_num_rows($result2);
        
        if (mysqli_num_rows($result1) + mysqli_num_rows($result2) < 1) { ?>
        <div class="content">
            <div class="content_resize_b">
                <h2 style="text-align: center;">No Results Found</h2>
                <h3 style="text-align: center;">Please click the "Return" button to return to the search page.</h3>
                <div align="center" style="padding-top: 10px;">
                    <input name="return" type="button" id="cbutton" value="Return" onclick="window.open('Biomarkers.html', '_self')">
                </div>
        <?php
        } else { ?>
        <div class="content">
            <div class="innerbox">
                <h2 style="text-align: center;">The search result for the key word "<?php echo $ida ?>" </h2>
                <p style="text-align: center;"><?php echo $biomarker; ?> Biomarkers</p>
                <table class="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Biomarker</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Application</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                    // loop through the results
                    while ($row = mysqli_fetch_assoc($result1)) {
                        extract($row); ?>
                        <tr onclick="change(this.id)" style="cursor:pointer;" id='<?php echo $ID ?>'>
                            <?php
                            echo '<td>' . $ID . '</td>';
                            echo '<td>' . $Biomarker . '</td>';
                            echo '<td>' . $Category . '</td>';
                            echo '<td>' . $Location . '</td>';
                            echo '<td>' . $Application . '</td>';
                            echo '<td>' . $Reference_first_author . '. ' . $Reference_journal . '. ' . $Reference_year . '</td>';
                            ?>
                        </tr> <?php 
                        } ?>
                    </tbody>
                </table>
                
                <p></p>
                
                <p style="text-align: center;"><?php echo $nbiomarker; ?> Non-biomarkers</p>
                <table class="tab">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Biomarker</th>
                            <th>Application</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                    // loop through the results
                    while ($row = mysqli_fetch_assoc($result2)) {
                        extract($row); ?>
                        <tr id='<?php echo $ID ?>'>
                            <?php
                            echo '<td>' . $ID . '</td>';
                            echo '<td>' . $Biomarker . '</td>';
                            echo '<td>' . $Application . '</td>';
                            echo '<td>' . $Reference_first_author . '. ' . $Reference_year . '</td>';
                            ?>
                        </tr> <?php
                    } ?>
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