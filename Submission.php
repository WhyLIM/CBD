<!DOCTYPE html>

<html>

<head>
    <title>Submission - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <!--<script src="https://use.fontawesome.com/bf6f75a73f.js"></script>-->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.1.2/css/all.css" rel="stylesheet">
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
                            <li><a href="Biomarkers.html"><i class="fa fa-list"></i>&nbsp;&nbsp;Biomarkers</a></li>
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
                            <textarea id="Description"  name="Description" rows="8" placeholder="Brief description for this biomarker" required></textarea>
                        </label>
                        
                        <div align="center">
                            <input name="submit" type="submit" id="cbutton" value="Submit">
                        </div>
                </form>
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