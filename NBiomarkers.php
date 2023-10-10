<!DOCTYPE html>

<html>

<head>
    <title>Non-Biomarkers - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <!-- Roboto 字体 -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="js/jquery.mtree.js" type="text/javascript"></script>
    <script src="js/velocity.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function KeyDown() {
            if (event.keyCode == 13) {
                searchexc();
            }
        }
        
        function clear1() {
            document.getElementById('searchinput').value = "";
        }
        
        function change(id) {
            var url = "info_detail_nb.php?id=" + id;
            //document.location.href=url;
            window.open(url);
        }
        
        function searchexc() {
            var searchinput = document.getElementById('searchinput').value;
            var url = "info.php?id=" + searchinput;
            window.open(url);
        }
        
        function help() {
            var newwindow = window.open('About.html');
            newwindow.onload = function() {
                newwindow.document.getElementsByClassName('f_content')['f_content']['src']="help/index.html#/Use";
            }
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
    <script type="text/javascript">
		$(document).ready(function() {
			$('ul.mtree').mtree();
		});
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
                                <li><a href="NBiomarkers.html">Non-Biomarkers</a></li>
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
        
        <div class="content">
            <div class="innerbox">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding: 0 10px;">
                    <tbody>
                        <tr>
                            <td colspan=2 width="100%" height="100">
                                <div align="center" style="margin: auto;margin-top: 40px;width: fit-content;">
                                    <div style="float: left;"><input type="text" name="searchinput" id="searchinput" size="60" onKeyDown="KeyDown()" placeholder="input a (non-)biomarker name"></div>
                                    <div style="float: left;"><input name="searchsubmit" id="cbutton" type="button" value="Search" 
                                        onClick="searchexc()"></div>
                                    <div style="float: left;"><input name="searchclear" id="cbutton" type="button" value="Clear" 
                                        onClick="clear1()"></div>
                                    <div style="float: left;"><input name="Help" id="cbutton" type="button" value="Help" onclick="help()"></div>
                                    <ul class="lab"><li><a href="Advanced.php">🔍 Advanced Search</a></li></ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <?php
                $con = mysqli_connect('localhost', 'user', 'passwd', 'database');
                if (!$con) {
                    die("Fail to connect MySQL: " . mysqli_connect_errno());
                }
                mysqli_set_charset($con, 'utf8mb4');
                $query = 'SELECT 
                      ID, Biomarker, Application, Reference_first_author, Reference_year 
                      FROM
                      `non-biomarker`
                      ORDER BY 
                      ID ASC';
                $result = mysqli_query($con, $query);
            
                // determine number of rows in returned result
                $biomarker = mysqli_num_rows($result);
            
                if ($biomarker == 0) {
                    header("Location: you.html");
                } else { ?>
                <div style="text-align: center;">
                    <h2>Non-biomarker list</h2>
                    <p style="text-align: center;"><?php echo $biomarker; ?> Non-biomarkers</p>
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
                        while ($row = mysqli_fetch_assoc($result)) {
                            extract($row); ?>
                            <tr onclick="change(this.id)" style="cursor:pointer;" id='<?php echo $ID ?>'>
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
                </div>
                <?php
                }?>
                
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