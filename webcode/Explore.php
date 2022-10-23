<!DOCTYPE html>

<html>

<head>
    <title>Explore - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome 矢量图标 -->
    <!--<script src="https://use.fontawesome.com/bf6f75a73f.js"></script>-->
    <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.1.2/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="./js/jquery-3.6.0.min.js"></script>
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
                text = inputField.placeholder;
                document.getElementById("show").value = text;
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
        
        // // 没做完的加载动画，不会写
        // function loading() {
        //     // window.open("loading.html", "_self");
        //     // if (document.readyState == "complete") {
        //         // window.open("loading.html", _self);
        //     // }
        //     // document.getElementsByClassName("main") = "<iframe src='loading.html' frameborder='0' scrolling='no' style='width: 100%;height: 100%'></iframe>";
        //     // document.write("<iframe src='loading.html' frameborder='0' scrolling='no' style='width: 100%;height: 100%'></iframe>")
        //     let createMask = () => {
        //         // 如果已存在就不再创建
        //         if (document.getElementById("loading")){
        //             return true;
        //         }
        //         let mask = document.createElement("iframe");
        //             mask.id = "loading";
        //             mask.className = "loading";
        //             mask.src = "loading.html"
        //         // 把 mask 添加到 body 里。
        //         document.body.appendChild(mask);
        //         // 控制 <html> 标签的样式
        //         document.documentElement.classList.add("htmlMask");
        //         // 加载完成去掉遮罩
        //         if (document.readyState == "complete") {
        //             deleteMask();
        //         }
        //     }
        //     // 删除遮罩
        //     let deleteMask = () => {
        //         let mask;
        //         // 如果 mask 存在，就删除
        //         if (mask = document.getElementById("loading")) {
        //             // 移除 mask 上的点击事件
        //             mask.removeEventListener("click", deleteMask);
        //             // 删除 mask 标签
        //             mask.parentNode.removeChild(mask);
        //             // 去掉 <html> 标签的特定样式
        //             document.documentElement.classList.remove("htmlMask");
        //         }
        //     }
        // }
    </script>
    <script>
        // var _LoadingHtml = '<iframe id="loadingframe" width="100%" height="100%" class="hide" marginwidth="0" marginheight="0" frameborder="0" src="loading.html"></iframe>';
        // // 呈现loading效果
        // document.write(_LoadingHtml);
        // // 监听加载状态改变
        // document.onreadystatechange = completeLoading;
        // // 加载状态为complete时移除loading效果
        // function completeLoading() {
        //     if (document.readyState == "complete") {
        //         var loadingMask = document.getElementById('loadingframe');
        //         loadingMask.parentNode.removeChild(loadingMask);
        //     }
        // }
    </script>
</head>

<body onload="send_request();">
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
                            <li><a href="Submission.php"><i class="fa fa-upload"></i>&nbsp;&nbsp;Submission</a></li>
                            <li><a href="Download.html"><i class="fa fa-cloud-download"></i>&nbsp;&nbsp;Download</a></li>
                            <li class="active"><a href="Explore.php"><i class="fa fa-flask"></i>&nbsp;&nbsp;Explore</a></li>
                            <li><a href="About.html"><i class="fa fa-file-text"></i>&nbsp;&nbsp;About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content">
            <div class="innerbox">
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
                                $con = mysqli_connect('localhost', 'guest', 'guest_cbd', 'cbd_limina_top');
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
                                    header("Location: Explore.php");
                                } else { ?>
                                    <div class="input">
                                        <div id="select" style="width:185px;overflow:auto;float: left;box-shadow: 0 5px 10px #e1e5ee;border-radius: 5px;">
                                            <select id="markerlist" multiple="multiple" style="border-color: white;font-family: LXGW;padding: 6px 6px;outline: 0;overflow: hidden;">
                                                <?php
                                                // loop through the results
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    extract($row);
                                                    echo '<option value=' . $String_Name . '>' . $String_Name . '&nbsp;&nbsp;&nbsp;(' . $Biomarker . ')</option>';
                                                } ?>
                                            </select>
                                            
                                            <!--Set the height of the markerlist select-->
                                            <script type="text/javascript">
                                                var sel = document.getElementById("markerlist");
                                                sel.size = sel.options.length;
                                            </script>
                                        </div>
                                        
                                        <div>
                                            <textarea class="textarea" name="show" id="show" cols="20" style="border: 2px solid #f0f0f0;height: -webkit-fill-available;box-shadow: 0 5px 10px #e1e5ee;resize: none;padding: 6px 6px;border-radius: 5px;font-family: LXGW;" placeholder="TP53"><?php if (isset($_POST['show'])) { echo htmlentities ($_POST['show']); }?></textarea>
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
                            // echo 'proteins: ' . $proteins;
                            ?>
                            </td>
                            
                            <td width="1%"></td>
                            
                            <td style="vertical-align: top;" width="72%" height="100%">
                                <p><b>Network:</b></p>
                                <div id="stringEmbedded"></div>
                            </td>
                        </tr>
                        
                        <tr style="height: -webkit-fill-available;">
                            <td style="vertical-align: top;">
                                <p><b><?php if ($text != "") { echo "Network Stats:"; };?></b></p>
                                <div>
                                    <table id="stats">
                                        <?php
                                        if ($text != "") {
                                            $urlhead = 'https://string-db.org/api/json/ppi_enrichment?identifiers=';
                                            $parameters = '&species=9606';
                                            $url = $urlhead . $proteins . $parameters;
                                            // echo $url;
                                            $json = json_decode(file_get_contents($url), true);
                                        }
                                        ?>
                                        <thead id="stats_head">
                                            <?php
                                            if ($text != "") {
                                                echo "<tr><th>Parameters</th><th>Value</th></tr>";
                                            }
                                            ?>
                                        </thead>
                                        <tbody id="stats_body">
                                            <?php
                                            if ($text != "") {
                                                echo "<tr><td>Number of Nodes: </td><td>" . $json[0]["number_of_nodes"] . "</td></tr>";
                                                echo "<tr><td>Number of Edges: </td><td>" . $json[0]["number_of_edges"] . "</td></tr>";
                                                echo "<tr><td>Average Node Degree: </td><td>" . $json[0]["average_node_degree"] . "</td></tr>";
                                                echo "<tr><td>Local Clustering Coefficient<img src='images/question.png' class='question' height='20px' title='Local STRING network clusters or simply STRING clusters are precomputed protein clusters derived by hierarchically clustering the full STRING network using an average linkage algorithm.'>: </td><td>" . $json[0]["local_clustering_coefficient"] . "</td></tr>";
                                                echo "<tr><td>Expected Number of Edges<img src='images/question.png' class='question' height='20px' title='If your network has significantly more interactions than expected, it means that your proteins have more interactions among themselves than what would be expected for a random set of proteins of the same size and degree distribution drawn from the genome. Such an enrichment indicates that the proteins are at least partially biologically connected, as a group.'>: </td><td>" . $json[0]["expected_number_of_edges"] . "</td></tr>";
                                                echo "<tr><td>P Value: </td><td>" . $json[0]["p_value"] . "</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            
                            <td></td>
                            
                            <td rowspan=2 style="vertical-align: top;">
                                <p><b><?php if ($text != "") { echo "Functional Enrichments:"; }?></b></p>
                                <?php
                                if ($text != "") {
                                    $colortab = <<<EOD
                                    <div style="margin-bottom: 25px;">
                                        <table class="colortab">
                                            <tr>
                                                <td bgcolor="#ffb142" height="25" width="50"></td>
                                                <td>Subcellular localization (COMPARTMENTS)</td>
                                                <td bgcolor="#33d9b2" height="25" width="50"></td>
                                                <td>Biological Process (Gene Ontology)</td>
                                                <td bgcolor="#ff5252" height="25" width="50"></td>
                                                <td>Cellular Component (Gene Ontology)</td>
                                                <td bgcolor="#34ace0" height="25" width="50"></td>
                                                <td>Molecular Function (Gene Ontology)</td>
                                            </tr>
                                            <tr style="height: 3px;"></tr>
                                            <tr>
                                                <td bgcolor="#B33771" height="25" width="50"></td>
                                                <td>Tissue expression (TISSUES)</td>
                                                <td bgcolor="#eb2f06" height="25" width="50"></td>
                                                <td>Disease-gene associations (DISEASES)</td>
                                                <td bgcolor="black" height="25" width="50"></td>
                                                <td>Annotated Keywords (UniProt)</td>
                                                <td bgcolor="#f78fb3" height="25" width="50"></td>
                                                <td>KEGG Pathways</td>
                                            </tr>
                                            <tr style="height: 3px;"></tr>
                                            <tr>
                                                <td bgcolor="#BDC581" height="25" width="50"></td>
                                                <td>Protein Domains (SMART)</td>
                                                <td bgcolor="#2daec1" height="25" width="50"></td>
                                                <td>Protein Domains and Features (InterPro)</td>
                                                <td bgcolor="#8854d0" height="25" width="50"></td>
                                                <td>Protein Domains (Pfam)</td>
                                                <td bgcolor="#20558a" height="25" width="50"></td>
                                                <td>Reference publications (PubMed)</td>
                                            </tr>
                                            <tr style="height: 3px;"></tr>
                                            <tr>
                                                <td bgcolor="#778beb" height="25" width="50"></td>
                                                <td>Reactome Pathways</td>
                                                <td bgcolor="#a5b1c2" height="25" width="50"></td>
                                                <td>WikiPathways</td>
                                                <td bgcolor="#4b6584" height="25" width="50"></td>
                                                <td>Human Phenotype (Monarch)</td>
                                                <td bgcolor="#e17055" height="25" width="50"></td>
                                                <td>Local network cluster (STRING)</td>
                                            </tr>
                                        </table>
                                    </div>
EOD;
                                    echo $colortab;
                                } ?>
                                
                                <div>
                                    <table id="Enrichment">
                                        <?php
                                        if ($text != "") {
                                            $urlhead = 'https://string-db.org/api/json/enrichment?identifiers=';
                                            $url = $urlhead . $proteins;
                                            // echo $url;
                                            $json = json_decode(file_get_contents($url), true);
                                        }
                                        ?>
                                        <thead id="Enrichment_head">
                                            <?php
                                            if ($text != "") {
                                                echo "<tr style='width: calc(100% - 7px);'>" .
                                                            "<th>Term</th>" .
                                                            "<th>Count In Network<img src='images/question.png' class='question' height='20px' title='The first number indicates how many proteins in your network are annotated with a particular term. The second number indicates how many proteins in total (in your network and in the background) have this term assigned.'></th>" .
                                                            "<th>P value</th>" .
                                                            "<th>FDR<img src='images/question.png' class='question' height='20px' title='False Discovery Rate: This measure describes how significant the enrichment is. Shown are p-values corrected for multiple testing within each category using the Benjamini–Hochberg procedure.'></th>" .
                                                            "<th width='48%'>Description</th>" .
                                                            "</tr>";
                                            };
                                            ?>
                                        </thead>
                                        <tbody id="Enrichment_body">
                                            <!--Getting functional enrichment-->
                                            <?php
                                            if ($text != "") {
                                                // echo count($json);
                                                // var_dump($json);
                                                $enrichment = "";
                                                foreach ($json as $js_single) {
                                                    $category = $js_single["category"];
                                                    $count = $js_single["number_of_genes"] . " in " . $js_single["number_of_genes_in_background"];
                                                    // color
                                                    if ($category == "COMPARTMENTS") {
                                                        // Compartments
                                                        $urltext = explode(":", $js_single["term"])[1];
                                                        $urlhead = "https://compartments.jensenlab.org/Entity?order=textmining,knowledge,predictions&knowledge=10&textmining=10&predictions=10&type1=-22&type2=9606&id1=GO:";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#ffb142";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $js_single["term"] . "</a>";
                                                    } elseif ($category == "Process") {
                                                        // Process
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "http://amigo.geneontology.org/amigo/term/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#33d9b2";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "Component") {
                                                        // Component
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "http://amigo.geneontology.org/amigo/term/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#ff5252";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "Function") {
                                                        // Function
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "http://amigo.geneontology.org/amigo/term/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#34ace0";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "TISSUES") {
                                                        // Tissues
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://tissues.jensenlab.org/Entity?order=textmining,knowledge,experiments&knowledge=10&experiments=10&textmining=10&type1=-25&type2=9606&id1=";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#B33771";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "DISEASES") {
                                                        // Diseases
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://diseases.jensenlab.org/Entity?order=textmining,knowledge,experiments&textmining=10&knowledge=10&experiments=10&type1=-26&type2=9606&id1=";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#eb2f06";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "Keyword") {
                                                        // Keyword
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://www.uniprot.org/keywords/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "black";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "KEGG") {
                                                        // KEGG
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://www.kegg.jp/kegg-bin/show_pathway?";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#f78fb3";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "SMART") {
                                                        // SMART
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "http://smart.embl-heidelberg.de/smart/do_annotation.pl?DOMAIN=";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#BDC581";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "InterPro") {
                                                        // InterPro
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://www.ebi.ac.uk/interpro/entry/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#2daec1";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "Pfam") {
                                                        // Pfam
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://pfam.xfam.org/family/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#8854d0";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "PMID") {
                                                        // PMID
                                                        $urltext = explode(":", $js_single["term"])[1];
                                                        $urlhead = "https://pubmed.ncbi.nlm.nih.gov/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#20558a";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $js_single["term"] . "</a>";
                                                    } elseif ($category == "RCTM") {
                                                        // RCTM
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://reactome.org/content/detail/R-";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#778beb";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "WikiPathways") {
                                                        // WikiPathways
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://www.wikipathways.org/index.php/Pathway:";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#a5b1c2";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "HPO") {
                                                        // HPO
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://monarchinitiative.org/phenotype/";
                                                        $url = $urlhead . $urltext;
                                                        $color = "#4b6584";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } elseif ($category == "NetworkNeighborAL") {
                                                        // NetworkNeighborAL
                                                        $urltext = $js_single["term"];
                                                        $urlhead = "https://string-db.org/cgi/network?network_cluster_id=";
                                                        $url = $urlhead . $urltext . "&input_query_species=9606";
                                                        $color = "#e17055";
                                                        $term = "<a href='" . $url . "' target='_blank' style='color:" . $color . ";font-weight:bold;'>" . $urltext . "</a>";
                                                    } else {
                                                        $term = $js_single["term"];
                                                        $url = "";
                                                    }
                                                    $enrichment .= "<tr onclick=\"window.open('" . $url . "')\" style='cursor:pointer;'>
                                                        <td style='width: 105px;'>" .
                                                        $term . "</td><td>" .
                                                        $count . "</td><td>" .
                                                        $js_single["p_value"] . "</td><td>" .
                                                        $js_single["fdr"] . "</td><td width='48%'>" .
                                                        $js_single["description"] . "</td></tr>";
                                                }
                                                echo $enrichment;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: top;">
                                <p><b><?php if ($text != "") { echo "Topological Parameters:"; }?></b></p>
                                <div id="topo"></div>
                                <?php
                                if ($text != "") {
                                    $urlhead = 'https://string-db.org/api/json/network?identifiers=';
                                    $url = $urlhead . $proteins . $parameters;
                                    // echo $url;
                                    $command = "/home/anaconda3/bin/python3.9 scripts/compute.py " . $url;
                                    // echo $command;
                                    $table = "";
                                    exec($command, $output);
                                    foreach ($output as $line) {
                                        $table .= $line;
                                    }
                                    echo $table;
                                };
                                ?>
                            </td>
                        </tr>
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