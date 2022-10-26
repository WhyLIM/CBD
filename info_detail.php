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
    <script>
        function send_request() {
            var protein = document.getElementById("info").rows[20].getElementsByTagName("td")[1].innerHTML.split(' ');
            getSTRING('https://string-db.org', {
                'species': '9606',
                'identifiers': protein,
                'network_flavor': 'confidence',
                'caller_identity': 'www.awesome_app.org'
            })
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
                $query = 'SELECT 
                      ID, Biomarker, Category, Discription, Region, Race, Number, `Gender_M/F`, Age, 
                      Location, Stage, Source, Experiment, Statictics, Application, Conclusion, 
                      Reference_first_author, Reference_journal, Reference_year, PMID, Addition, 
                      STRING_Name, STRING_ID, STRING_Link, Male, Female, Age_Mean
                      FROM 
                      biomarker
                      where ID="' . $id . '"';
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
                    // loop through the results: ID, Biomarker, Category, Discription, Region, Race, Number, Gender, Age, 
                    // Location, Stage, Source, Experiment, Statictics, Reference, Application, Conclusion, PMID, Addition
                    echo '<tr><td width="15%">ID</td><td>' . $row[0] . '</td></tr>';
                    echo '<tr><td>Biomarker</td><td>' . $row[1] . '</td></tr>';
                    echo '<tr><td>Category</td><td>' . $row[2] . '</td></tr>';
                    
                    $symbols = explode(", ", $row[1]);
                    
                    if (!(strpos($row[2], "Protein") === false)) {
                        // Protein
                        // print_r($row);
                        echo '<tr><td>NCBI Protein</td><td>';
                        echo '<a href="https://www.ncbi.nlm.nih.gov/protein/?term=' . $symbols[0] . '+AND+Homo+sapiens[Organism]" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $symbols[0] . ' (Click to NCBI Protein)</a>';
                        for ($index = 1; $index < count($symbols); $index++) {
                            echo '<br><a href="https://www.ncbi.nlm.nih.gov/protein/?term=' . $symbols[$index] . '+AND+Homo+sapiens[Organism]" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $symbols[$index] . '(Click to NCBI Protein)</a>';
                        }
                        echo '</td></tr>';
                        echo '<tr><td>Discription</td><td>' . $row[3] . '</td></tr>';
                        echo '<tr><td>Region</td><td>' . $row[4] . '</td></tr>';
                        echo '<tr><td>Race</td><td>' . $row[5] . '</td></tr>';
                        echo '<tr><td>Number</td><td>' . $row[6] . '</td></tr>';
                        echo '<tr><td>Gender</td><td>' . $row[7] . '</td></tr>';
                        echo '<tr><td>Age</td><td>' . $row[8] . '</td></tr>';
                        echo '<tr><td>Location</td><td>' . $row[9] . '</td></tr>';
                        echo '<tr><td>Stage</td><td>' . $row[10] . '</td></tr>';
                        echo '<tr><td>Source</td><td>' . $row[11] . '</td></tr>';
                        echo '<tr><td>Experiment</td><td>' . $row[12] . '</td></tr>';
                        echo '<tr><td>Statictics</td><td>' . $row[13] . '</td></tr>';
                        echo '<tr><td>Application</td><td>' . $row[14] . '</td></tr>';
                        echo '<tr><td>Conclusion</td><td>' . $row[15] . '</td></tr>';
                        echo '<tr><td>Reference</td><td>' . $row[16] . '. ' . $row[17] . '. '  . $row[18] . '</td></tr>';
                        echo '<tr><td>PMID</td><td><a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=' . $row[19] . '" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $row[19] . ' (Click to Pubmed)</a></td></tr>';
                        echo "<tr><td>STRING Name</td><td>" . trim($row[21]) . "</td></tr>";
                        echo "<tr><td>STRING PPI</td>
                                <td><div>
                		        <button id='Querybutton' onclick='send_request();' type='button' style='margin: 20px auto'><div><i class='fa fa-share-alt'></i>&nbsp;Show STRING PPI</div></button>
                                </div></td>
                              </tr>";
                    } elseif (!(strpos($row[2], "Circular RNA") === false) or !(strpos($row[2], "LncRNA") === false) or !(strpos($row[2], "MicroRNA") === false) or !(strpos($row[2], "DNA") === false)) {
                        // RNA & DNA
                        echo '<tr><td>Ontology</td><td>';
                        echo '<a href="https://www.ncbi.nlm.nih.gov/gene/?term=' . $symbols[0] . '+AND+Homo+sapiens[Organism]" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $symbols[0] . ' (Click to NCBI Gene)</a>';
                        for ($index = 1; $index < count($symbols); $index++) {
                            echo '<br><a href="https://www.ncbi.nlm.nih.gov/gene/?term=' . $symbols[$index] . '+AND+Homo+sapiens[Organism]" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $symbols[$index] . ' (Click to NCBI Gene)</a>';
                        }
                        echo '</td></tr>';
                        echo '<tr><td>Discription</td><td>' . $row[3] . '</td></tr>';
                        echo '<tr><td>Region</td><td>' . $row[4] . '</td></tr>';
                        echo '<tr><td>Race</td><td>' . $row[5] . '</td></tr>';
                        echo '<tr><td>Number</td><td>' . $row[6] . '</td></tr>';
                        echo '<tr><td>Gender</td><td>' . $row[7] . '</td></tr>';
                        echo '<tr><td>Age</td><td>' . $row[8] . '</td></tr>';
                        echo '<tr><td>Location</td><td>' . $row[9] . '</td></tr>';
                        echo '<tr><td>Stage</td><td>' . $row[10] . '</td></tr>';
                        echo '<tr><td>Source</td><td>' . $row[11] . '</td></tr>';
                        echo '<tr><td>Experiment</td><td>' . $row[12] . '</td></tr>';
                        echo '<tr><td>Statictics</td><td>' . $row[13] . '</td></tr>';
                        echo '<tr><td>Application</td><td>' . $row[14] . '</td></tr>';
                        echo '<tr><td>Conclusion</td><td>' . $row[15] . '</td></tr>';
                        echo '<tr><td>Reference</td><td>' . $row[16] . '. ' . $row[17] . '. '  . $row[18] . '</td></tr>';
                        echo '<tr><td>PMID</td><td><a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=' . $row[19] . '" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $row[19] . ' (Click to Pubmed)</a></td></tr>';
                        echo '<tr><td>Addition</td><td>' . $row[20] . '</td></tr>';
                    } else {
                        // Other
                        echo '<tr><td>Discription</td><td>' . $row[3] . '</td></tr>';
                        echo '<tr><td>Region</td><td>' . $row[4] . '</td></tr>';
                        echo '<tr><td>Race</td><td>' . $row[5] . '</td></tr>';
                        echo '<tr><td>Number</td><td>' . $row[6] . '</td></tr>';
                        echo '<tr><td>Gender</td><td>' . $row[7] . '</td></tr>';
                        echo '<tr><td>Age</td><td>' . $row[8] . '</td></tr>';
                        echo '<tr><td>Location</td><td>' . $row[9] . '</td></tr>';
                        echo '<tr><td>Stage</td><td>' . $row[10] . '</td></tr>';
                        echo '<tr><td>Source</td><td>' . $row[11] . '</td></tr>';
                        echo '<tr><td>Experiment</td><td>' . $row[12] . '</td></tr>';
                        echo '<tr><td>Statictics</td><td>' . $row[13] . '</td></tr>';
                        echo '<tr><td>Application</td><td>' . $row[14] . '</td></tr>';
                        echo '<tr><td>Conclusion</td><td>' . $row[15] . '</td></tr>';
                        echo '<tr><td>Reference</td><td>' . $row[16] . '. ' . $row[17] . '. '  . $row[18] . '</td></tr>';
                        echo '<tr><td>PMID</td><td><a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=' . $row[19] . '" target="_black"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;' . $row[19] . ' (Click to Pubmed)</a></td></tr>';
                        echo '<tr><td>Addition</td><td>' . $row[20] . '</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
                
                <center>
                    <div id="stringEmbedded"></div>
                </center>
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