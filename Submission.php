<!DOCTYPE html>

<html>

<head>
    <title>Submission - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <!-- Roboto 字体 -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script>
        function color() {
            var select = document.querySelectorAll("select");
            select.forEach(function(item) {
                if (item.value == "") {
                    item.style.color = "#888";
                } else {
                    item.style.color = "";
                }
            });
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
                            <li><a href="Biomarkers.html"><i class="fa fa-list"></i>&nbsp;&nbsp;Biomarkers</a>
                                <ul class="submenu">
                                    <li><a href="NBiomarkers.php">Non-Biomarkers</a></li>
                                </ul>
                            </li>
                            <li class="active"><a href="Submission.php"><i class="fa fa-upload"></i>&nbsp;&nbsp;Submission</a></li>
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
                if (isset($_GET['error']) && $_GET['error'] != '') {
                    echo '<div id="error">' . $_GET['error'] . '</div>';
                }
                ?>

                <form action="commit.php?action=add&type=marker" method="post" class="submission">
                    <div align="center">
                        <h2>New biomarker submission form
                            <span>Please fill all the texts in the fields.</span>
                        </h2>

                        <label>
                            <span>Biomarker Name* :</span>
                            <input id="submit" type="text" name="Biomarker" placeholder="Name of your biomarker" required>
                        </label>

                        <label>
                            <span>Biological Category* :</span>
                            <input id="submit" type="text" name="Category" list="categorylist" placeholder="Select or type the category" required>
                            <datalist id="categorylist">
                                <option>Protein</option>
                                <option>RNA</option>
                                <option>CircRNA</option>
                                <option>LncRNA</option>
                                <option>MicroRNA</option>
                                <option>OtherRNA</option>
                                <option>DNA</option>
                                <option>Other</option>
                            </datalist>
                        </label>

                        <label>
                            <span>Biomarker Type* :</span>
                            <select id="submit" name="Application" style="color: #888" onchange="color()" required>
                                <option value="">Select the useage</option>
                                <option value="Diagnosis">Diagnosis</option>
                                <option value="Diagnosis, Prognosis">Diagnosis, Prognosis</option>
                                <option value="Diagnosis, Prognosis, Treatment">Diagnosis, Prognosis, Treatment</option>
                                <option value="Diagnosis, Treatment">Diagnosis, Treatment</option>
                                <option value="Prognosis">Prognosis</option>
                                <option value="Prognosis, Treatment">Prognosis, Treatment</option>
                                <option value="Treatment">Treatment</option>
                            </select>
                        </label>

                        <label>
                            <span>Location* :</span>
                            <select id="submit" name="Location" style="color: #888" onchange="color()" required>
                                <option value="">Select the loaction</option>
                                <option value="Colon">Colon</option>
                                <option value="Rectum">Rectum</option>
                                <option value="Colon, Rectum">Colon, Rectum</option>
                            </select>
                        </label>

                        <label>
                            <span>Your Name* :</span>
                            <input id="submit" type="text" name="Contributor" placeholder="Enter your name" required>
                        </label>

                        <label>
                            <span>PubMed ID* :</span>
                            <input id="submit" type="number" name="PMID" placeholder="PMID of research for this biomarker" required min="1" max="99999999">
                        </label>

                        <label>
                            <span>Your E-mail* :</span>
                            <input id="submit" type="email" name="Email" placeholder="Your E-mail to contact" required>
                        </label>

                        <label>
                            <span>Description* :</span>
                            <textarea id="Description" name="Description" rows="8" placeholder="Brief description for this biomarker" required></textarea>
                        </label>

                        <div align="center">
                            <input name="submit" type="submit" id="cbutton" value="Submit">
                        </div>
                    </div>
                </form>
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