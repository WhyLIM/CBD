<!DOCTYPE html>

<html>

<head>
    <title>Biomarker information - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <!--<script src="https://use.fontawesome.com/bf6f75a73f.js"></script>-->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <!--String API-->
    <script type="text/javascript" src="https://string-db.org/javascript/combined_embedded_network_v2.0.4.js"></script>
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
                    echo '<tr><td>Biomarker</td><td>' . $row[1] . '</td></tr>';
                    
                    $symbols = explode(", ", $row[1]);
                    
                    echo '<tr><td>Application</td><td>' . $row[2] . '</td></tr>';
                    echo '<tr><td>Reference</td><td>' . $row[3] . '. ' . $row[4] . '</td></tr>';
                    echo '<tr><td>PMID</td><td><a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=' . $row[5] . '" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $row[5] . ' (Click to Pubmed)</a></td></tr>';
                    ?>
                    </tbody>
                </table>
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