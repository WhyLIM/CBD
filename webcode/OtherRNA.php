<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        function change(id) {
            var url = "info_detail.php?id=" + id;
            //document.location.href=url;
            window.open(url);
        }
    </script>
</head>

<body>
    <?php
    $con = mysqli_connect('localhost', 'guest', 'guest_cbd', 'cbd_limina_top');
    if (!$con) {
        die("Fail to connect MySQL: " . mysqli_connect_errno());
    }
    mysqli_set_charset($con, 'utf8mb4');
    $query = 'SELECT 
          ID, Biomarker, Location, Application, Reference_first_author, Reference_journal, Reference_year 
          FROM
          biomarker
		  WHERE Category="CircRNA" or Category="SnoRNA" OR Category="PiRNA"
          ORDER BY 
          ID ASC';
    $result = mysqli_query($con, $query);

    // determine number of rows in returned result
    $biomarker = mysqli_num_rows($result);

    if ($biomarker == 0) {
        header("Location: you.html");
    } else { ?>
    <div style="text-align: center;">
        <h2>OtherRNA biomarker list</h2>
        <p style="text-align: center;"><?php echo $biomarker; ?> biomarkers</p>
        <table class="tab">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Biomarker</th>
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
                    echo '<td>' . $Location . '</td>';
                    echo '<td>' . $Application . '</td>';
                    echo '<td>' . $Reference_first_author . '. ' . $Reference_journal . '. ' . $Reference_year . '</td>';
                    ?>
                </tr> <?php
            } ?>
            </tbody>
        </table>
    </div>
    <?php
    }?>
    
</body>

</html>