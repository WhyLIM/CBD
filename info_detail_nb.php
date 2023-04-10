<!DOCTYPE html>

<html>

<head>
    <title>Biomarker information - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <!-- Roboto 字体 -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!--String API-->
    <script type="text/javascript" src="https://string-db.org/javascript/combined_embedded_network_v2.0.4.js"></script>
    <script type="text/javascript">
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

        <div class="content">
            <div class="innerbox">

                <?php
                //connect to MySQL
                $con = mysqli_connect('localhost', 'guest', 'guest_cbd', 'cbd_limina_top');
                if (!$con) {
                    die("Fail to connect MySQL: " . mysqli_connect_errno());
                }
                mysqli_set_charset($con, 'utf8mb4');
                $id = $_GET['id'];
                $query = 'SELECT * FROM `non-biomarker` where ID="' . $id . '"';
                $result = mysqli_query($con, $query);
                ?>

                <table id="info" class="tab1">
                    <caption>
                        <h2>The detail information of "
                            <?php
                            $row = mysqli_fetch_row($result);
                            if (!$result) {
                                printf("Error: %s\n", mysqli_error($con));
                                exit();
                            };
                            echo $row[1]
                            ?>"
                        </h2>
                    </caption>

                    <thead>
                        <tr>
                            <th width="15%">Items</th>
                            <th>Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        echo '<tr><td width="15%">ID</td><td>' . $row[0] . '</td></tr>';
                        echo '<tr><td>Name</td><td>' . $row[1] . '</td></tr>';

                        $symbols = explode(", ", $row[1]);

                        echo '<tr><td>Application</td><td>' . $row[2] . '</td></tr>';
                        echo '<tr><td>Reference</td><td>' . $row[3] . '. ' . $row[4] . '</td></tr>';
                        echo '<tr><td>PMID</td><td><a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=' . $row[5] . '" target="_black" style="color:#20558a;font-weight:bold;"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $row[5] . ' (Click to PubMed)</a></td></tr>';
                        ?>
                    </tbody>
                </table>
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