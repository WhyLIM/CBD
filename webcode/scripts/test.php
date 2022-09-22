<!DOCTYPE html>

<html>

<head>
    <title>CRC Biomarker Database</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <!--<script src="./require.js"></script>-->
    <!--<script src="./node_modules/require.js/test/test.js"></script>-->
    <!--<script src="./node_modules/require.js/require.min.js"></script>-->
</head>

<body>
    <div>
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
                <textarea class="textarea" name="show" id="show" cols="20" style="border: 2px solid #f0f0f0;box-shadow: 0 5px 10px #e1e5ee;resize: none;padding: 6px 6px;border-radius: 5px;font-family: LXGW;" placeholder="TP53"><?php if (isset($_POST['show'])) { echo htmlentities ($_POST['show']); }?></textarea>
                </div>
                
                <div>
                <input id="Querybutton" onclick="send_request();" type="submit" value="Query">
                <!--<input type="submit">-->
                <!--<button id="Querybutton" type="button"><div>Query</div></button>-->
                </div>
            </div> <?php
        } ?>
        </form>
    </div>
    
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
    
    // echo "<script>
    //         var inputField = document.getElementById('show');
    //         var text = inputField.value;
    //         if (!text) {
    //             text = inputField.placeholder
    //         };
    //         var proteins = text.split('\\n').join('%0d');
    //       </script>";
    // $proteins = "<script>document.writeln(proteins);</script>";
    // foreach ($proteins as $protein) {
    //     echo $protein."?";
    // }
    echo $proteins;
    $proteins = "";
    ?>
    
</body>