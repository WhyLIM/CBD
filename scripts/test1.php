<!DOCTYPE html>

<html>

<head>
    <title>CRC Biomarker Database</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>

    <!-- Embed the STRING's javascript -->
    <script type="text/javascript" src="https://string-db.org/javascript/combined_embedded_network_v2.0.4.js"></script>
    <script type="text/javascript">
        function clear_input() {
            document.getElementById("show").value = "";
        }
        
        function send_request() {
            var inputField = document.getElementById('show');
            var text = inputField.value;
            if (!text) {
                text = inputField.placeholder
            }; // placeholder
            var proteins = text.split('\n');
            /* the actual API query */
            getSTRING('https://string-db.org', {
                'species': '9606',
                'identifiers': proteins,
                'network_flavor': 'confidence',
                'caller_identity': 'www.awesome_app.org'
            })
        }
    </script>

</head>

<!-- HTML CODE -->

<body onload='send_request();'>
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
                            <li><a href="index.html">Home</a></li>
                            <li><a href="Biomarkers.html">Biomarkers</a></li>
                            <li><a href="Document.html">Document</a></li>
                            <li><a href="Submission.php">Submission</a></li>
                            <li><a href="Download.html">Download</a></li>
                            <li><a href="About Us.html">About Us</a></li>
                            <li class="active"><a href="Explore.php">Explore</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="content_resize_b">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td colspan=3 width="100%">
                                <center>
                                    <h2>Explore Anything</h2>
                                    <h3 style="text-align: justify;">The Explore page is designed to allow the user to select or type in any biomarkers (and other proteins) of interest to obtain the interaction network between them, and to allow the user to query the network for relevant information such as topological parameters, enrichment information, etc. Currently only human species (NCBI taxon ID: 9606) is supported.</h3>
                                </center>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top;" width="27%">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                <div style="float: top;">
                                    <p style="width: 360px;"><b>Note: </b>The list on the left is the biomarkers with String Name recorded in CBD. You can select any of them, and then they will be displayed in the text box on the right. Of course, in the text box, you can also manually type the protein you want to query.</p>
                                </div>

                                <?php
                                $con = mysqli_connect('localhost', 'cbd_limina_top', 'JfRxNRFxKXJ72RWy', 'cbd_limina_top');
                                if (!$con) {
                                    die("Fail to connect MySQL: " . mysqli_connect_errno());
                                }
                                mysqli_set_charset($con, 'utf8mb4');
                                $query = 'SELECT 
                                      Biomarker, String_Name 
                                      FROM 
                                      biomarker 
                            		  WHERE Category="Protein" AND String_Name <>"" AND String_Name <>"NA"
                                      ORDER BY
                                      String_Name ASC';
                                $result = mysqli_query($con, $query);

                                // determine number of rows in returned result
                                $biomarker = mysqli_num_rows($result);

                                if ($biomarker == 0) {
                                    header("Location: Explore.html");
                                } else { ?>
                                    <div class="input">
                                        <div id="select" style="width:185px;overflow:auto;float: left;box-shadow: 0 5px 10px #e1e5ee;border-radius: 5px;">
                                            <select id="markerlist" multiple="multiple" style="border-color: white;font-family: LXGW;padding: 6px 6px;outline: 0;overflow: hidden;">
                                                <?php
                                                // loop through the results
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    extract($row);
                                                    echo '<option value=' . $String_Name . '>' . $String_Name . '&nbsp;&nbsp;(' . $Biomarker . ')</option>';
                                                } ?>
                                            </select>
                                            
                                            <!--Set the height of the markerlist select-->
                                            <script type="text/javascript">
                                                var sel = document.getElementById("markerlist");
                                                sel.size = sel.options.length;
                                            </script>
                                        </div>

                                        <div>
                                            <textarea class="textarea" name="show" id="show" cols="20" style="border: 2px solid #f0f0f0;height: -webkit-fill-available;box-shadow: 0 5px 10px #e1e5ee;resize: none;padding: 6px 6px;border-radius: 5px;font-family: LXGW;" placeholder='TP53'></textarea>
                                        </div>
                                    </div>
                                    
                                    <div style="display: flex;justify-content: space-around;">
                                        <button id="Clearbutton" onclick="clear_input();" type="button"><div>Clear</div></button>
                                        <!--<input id="Clearbutton" onclick="clear_input();" type="submit" value="Clear">-->
                                        <input id="Querybutton" onclick="send_request();" type="submit" value="Query">
                                    </div> <?php
                                } ?>
                            </form>
                                    
                            <script type="text/javascript">
                                document.getElementById('markerlist').onchange = function() {
                                    if (this.options[0].value == -1) {
                                        this.options[0] = null
                                    };
                                    if (document.getElementById('show').value == "") {
                                        document.getElementById('show').value = this.value
                                    } else {
                                        document.getElementById('show').value += "\n" + this.value
                                    }
                                };
                            </script>
                                    
                            <?php
                            $text = trim($_REQUEST['show']);
                            $proteins = implode("%0d", explode("\r\n", $text));
                            echo 'proteins: ' . $proteins;
                            ?>
                            </td>
                        </tr>

                        <tr style="height: -webkit-fill-available;">
                            <td style="vertical-align: top;">
                                <p><b><?php echo "Network Stats:" ?></b></p>
                                <div>
                                    <table id="stats">
                                        <?php
                                        $urlhead = 'https://string-db.org/api/json/ppi_enrichment?identifiers=';
                                        $parameters = '&species=9606';
                                        $url = $urlhead . $proteins . $parameters;
                                        echo $url;
                                        $json = json_decode(file_get_contents($url), true);
                                        ?>
                                        <thead id="stats_head">
                                            <?php
                                            echo "<tr><th>Parameters</th><th>Value</th></tr>";
                                            ?>
                                        </thead>
                                        <tbody id="stats_body">
                                            <?php
                                            echo "<tr><td>Number of Nodes: </td><td>" . $json[0]["number_of_nodes"] . "</td></tr>";
                                            echo "<tr><td>Number of Edges: </td><td>" . $json[0]["number_of_edges"] . "</td></tr>";
                                            echo "<tr><td>Average Node Degree: </td><td>" . $json[0]["average_node_degree"] . "</td></tr>";
                                            echo "<tr><td>Local Clustering Coefficient: </td><td>" . $json[0]["local_clustering_coefficient"] . "</td></tr>";
                                            echo "<tr><td>Expected Number of Edges: </td><td>" . $json[0]["expected_number_of_edges"] . "</td></tr>";
                                            echo "<tr><td>P Value: </td><td>" . $json[0]["p_value"] . "</td></tr>";
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>

                            <td></td>

                            <td rowspan=2 style="vertical-align: top;">
                                <p><b><?php echo "Functional Enrichments:" ?></b></p>
                                <div>
                                    <table id="Enrichment">
                                        <?php
                                        $urlhead = 'https://string-db.org/api/json/enrichment?identifiers=';
                                        $url = $urlhead . $proteins;
                                        echo $url;
                                        $json = json_decode(file_get_contents($url), true);
                                        ?>
                                        <thead id="Enrichment_head">
                                            <?php
                                            echo "<tr style='width: calc(100% - 1em);'>" .
                                                        "<th>Term</th>" .
                                                        "<th>Count In Network</th>" .
                                                        "<th>P value</th>" .
                                                        "<th>FDR</th>" .
                                                        "<th width='48%'>Description</th>" .
                                                        "</tr>";
                                            ?>
                                        </thead>
                                        <tbody id="Enrichment_body">
                                            <!--Getting functional enrichment-->
                                            <?php
                                            // echo count($json);
                                            // var_dump($json);
                                            $enrichment = "";
                                            foreach ($json as $js_single) {
                                                $count = $js_single["number_of_genes"] . " in " . $js_single["number_of_genes_in_background"];
                                                $enrichment .= "<tr><td style='width: 105px;'>" .
                                                    $js_single["term"] . "</td><td>" .
                                                    $count . "</td><td>" .
                                                    $js_single["p_value"] . "</td><td>" .
                                                    $js_single["fdr"] . "</td><td width='48%'>" .
                                                    $js_single["description"] . "</td></tr>";
                                            }
                                            echo $enrichment;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: top;">
                                <p><b><?php echo "Topological Parameters:"?></b></p>
                                <div id="topo"></div>
                                <?php
                                $urlhead = 'https://string-db.org/api/json/network?identifiers=';
                                $url = $urlhead . $proteins . $parameters;
                                echo $url;
                                $command = "/home/anaconda3/bin/python3.9 ../scripts/compute.py " . $url;
                                // echo $command;
                                $table = "";
                                exec($command, $output);
                                foreach ($output as $line) {
                                    $table .= $line;
                                }
                                echo $table;
                                ?>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>