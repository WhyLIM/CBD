<!DOCTYPE html>

<html>

<head>
    <title>K-Search result - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <!--<script src="https://use.fontawesome.com/bf6f75a73f.js"></script>-->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.1.2/css/all.css" rel="stylesheet">
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
        //connect to MySQL
        $con = mysqli_connect('localhost', 'cbd_limina_top', 'JfRxNRFxKXJ72RWy', 'cbd_limina_top');
        if (!$con) {
            die("Fail to connect MySQL: " . mysqli_connect_errno());
        }
        mysqli_set_charset($con, 'utf8mb4');

        $ida = $_GET['id'];
        // retrieve information 
        $query = 'SELECT 
          ID, Biomarker, Category, Location, Application, Reference_first_author, Reference_journal, Reference_year 
          FROM
          biomarker
          WHERE Biomarker like "%' . $ida . '%" 
          ORDER BY 
          ID ASC';
        $result = mysqli_query($con, $query);

        // determine number of rows in returned result
        $biomarker = mysqli_num_rows($result);
        
        if (mysqli_num_rows($result) < 1) { ?>
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
                    while ($row = mysqli_fetch_assoc($result)) {
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