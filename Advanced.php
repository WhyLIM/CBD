<!DOCTYPE html>

<html>

<head>
    <title>Advanced Search - CBD</title>
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
            select.forEach(function (item) {
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
        $con = mysqli_connect('ip','user','passwd', 'database');
        if (!$con) {
            die("Fail to connect MySQL: " . mysqli_connect_errno());
        }
        mysqli_set_charset($con, 'utf8mb4');
        $query = 'SELECT 
              Region, Location, Stage, Source, Application, Reference_first_author, Reference_journal, Reference_year 
              FROM 
              biomarker';
        $result = mysqli_query($con, $query);
        // loop through the results
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            $region[] = $Region;
            $location[] = $Location;
            $stage[] = $Stage;
            $source[] = $Source;
            $apply[] = $Application;
            $first_author[] = $Reference_first_author;
            $journal[] = $Reference_journal;
            $year[] = $Reference_year;
        }
        // Duplicate
        $region = array_unique($region);
        $location = array_unique($location);
        $stage = array_unique($stage);
        $source = array_unique($source);
        $apply = array_unique($apply);
        $first_author = array_unique($first_author);
        $journal = array_unique($journal);
        $year = array_unique($year);
        
        // Sort
        asort($region);
        asort($location);
        asort($stage);
        asort($source);
        asort($apply);
        asort($first_author);
        asort($journal);
        asort($year);
        ?>
        
        <div class="content">
            <div class="innerbox">
                <div class="advance">
                    <div align="center">
                        <h2 align="center">Advanced Search
                            <span>Please fill out at least one item.</span>
                        </h2>
                        
                        <!-- 第 1 个检索 -->
                        <label>
                            <span>Region :</span>
                            <input type="text" name="searchinput1" id="searchinput1" list="regionlist" placeholder="Select or type region of research">
                            <datalist id="regionlist">
                                <?php
                                foreach ($region as $rg) {
                                   echo "<option value='" . $rg . "'>" . $rg . "</option>";
                                } ?>
                            </datalist>
                        </label>
                        
                        <!-- 第 2 个检索 -->
                        <label>
                            <span>Stage :</span>
                            <select name="searchinput2" id="searchinput2" style="color: #888" onchange="color()">
                                <option value="">Select the stage</option>
                                <?php
                                foreach ($stage as $st) {
                                   echo "<option value='" . $st . "'>" . $st . "</option>";
                                } ?>
                            </select>
                        </label>
                        
                        <!-- 第 3 个检索 -->
                        <label>
                            <span>Location :</span>
                            <select name="searchinput3" id="searchinput3" style="color: #888" onchange="color()">
                                <option value="">Select the location</option>
                                <?php
                                foreach ($location as $lo) {
                                   echo "<option value='" . $lo . "'>" . $lo . "</option>";
                                } ?>
                            </select>
                        </label>
                        
                        <!-- 第 4 个检索 -->
                        <label>
                            <span>Source :</span>
                            <select name="searchinput4" id="searchinput4" style="color: #888" onchange="color()">
                                <option value="">Select the source</option>
                                <?php
                                foreach ($source as $so) {
                                   echo "<option value='" . $so . "'>" . $so . "</option>";
                                } ?>
                            </select>
                        </label>
                        
                        <!-- 第 5 个检索 -->
                        <label>
                            <span>Application :</span>
                            <select name="searchinput5" id="searchinput5" style="color: #888" onchange="color()">
                                <option value="">Select the useage</option>
                                <?php
                                foreach ($apply as $ap) {
                                   echo "<option value='" . $ap . "'>" . $ap . "</option>";
                                } ?>
                            </select>
                        </label>
                        
                        <!-- 第 6-8 个检索 -->
                        <label>
                            <!-- First Author -->
                            <span>Reference (First Author) :</span>
                            <input type="text" name="searchinput6" id="searchinput6" list="falist" placeholder="Select or type first author">
                            <datalist id="falist">
                                <?php
                                foreach ($first_author as $fa) {
                                    echo "<option value='" . $fa . "'>" . $fa . "</option>";
                                } ?>
                            </datalist>
                            
                            <!-- Journal -->
                            <span>Reference (Journal) :</span>
                            <input type="text" name="searchinput7" id="searchinput7" list="jlist" placeholder="Select or type Journal">
                            <datalist id="jlist">
                                <?php
                                foreach ($journal as $jn) {
                                    echo "<option value='" . $jn . "'>" . $jn . "</option>";
                                } ?>
                            </datalist>
                            
                            <!-- Year -->
                            <span>Reference (Year) :</span>
                            <input type="text" name="searchinput8" id="searchinput8" list="ylist" placeholder="Select or type publication year">
                            <datalist id="ylist">
                                <?php
                                foreach ($year as $ye) {
                                    echo "<option value='" . $ye . "'>" . $ye . "</option>";
                                } ?>
                            </datalist>
                        </label>
                        
                        <!-- search 键 -->
                        <div align="center" style="padding-top: 10px;">
                            <input name="submit" type="submit" id="cbutton" value="Search" onclick="searchexc()">
                        </div>
                    </div>
                </div>
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

    <script language="javascript">
        function KeyDown() {
            if (event.keyCode == 13) {
                searchexc();
            }
        }
        
        function searchexc() {
            var searchinput1 = document.getElementById("searchinput1").value;
            var searchinput2 = document.getElementById("searchinput2").value;
            var searchinput3 = document.getElementById("searchinput3").value;
            var searchinput4 = document.getElementById("searchinput4").value;
            var searchinput5 = document.getElementById("searchinput5").value;
            var searchinput6 = document.getElementById("searchinput6").value;
            var searchinput7 = document.getElementById("searchinput7").value;
            var searchinput8 = document.getElementById("searchinput8").value;
            var url = "info_adv.php?";
            // Region
            if (searchinput1 != "") {
                if (url.substr(-1) == "?")
                    url += "id1=" + searchinput1;
            }
            // Stage
            if (searchinput2 != "") {
                if (url.substr(-1) == "?")
                    url += "id2=" + searchinput2;
                else
                    url += "&id2=" + searchinput2;
            }
            // Location
            if (searchinput3 != "") {
                if (url.substr(-1) == "?")
                    url += "id3=" + searchinput3;
                else
                    url += "&id3=" + searchinput3;
            }
            // Source
            if (searchinput4 != "") {
                if (url.substr(-1) == "?")
                    url += "id4=" + searchinput4;
                else
                    url += "&id4=" + searchinput4;
            }
            // Application
            if (searchinput5 != "") {
                if (url.substr(-1) == "?")
                    url += "id5=" + searchinput5;
                else
                    url += "&id5=" + searchinput5;
            }
            // First Author
            if (searchinput6 != "") {
                if (url.substr(-1) == "?")
                    url += "id6=" + searchinput6;
                else
                    url += "&id6=" + searchinput6;
            }
            // Journal
            if (searchinput7 != "") {
                if (url.substr(-1) == "?")
                    url += "id7=" + searchinput7;
                else
                    url += "&id7=" + searchinput7;
            }
            // Year
            if (searchinput8 != "") {
                if (url.substr(-1) == "?")
                    url += "id8=" + searchinput8;
                else
                    url += "&id8=" + searchinput8;
            }
            // 不允许 8 项全空
            if (searchinput1 == "" && searchinput2 == "" && searchinput3 == "" && searchinput4 == "" 
            && searchinput5 == "" && searchinput6 == "" && searchinput7 == "" && searchinput8 == "") {
                alert("Please fill out at least one item!");
            } else {
                window.open(url);
            }
        }
    </script>

</body>

</html>