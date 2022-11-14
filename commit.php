<?php
//connect to MySQL
$con = mysqli_connect('localhost', 'user', 'password', 'database');
if (!$con) {
    die("Fail to connect MySQL: " . mysqli_connect_errno());
}

switch ($_GET['action']) {
    case 'add':
        switch ($_GET['type']) {
            case 'marker':
                $error = array();
                $Biomarker = isset($_POST['Biomarker']) ?
                    trim($_POST['Biomarker']) : '';
                if (empty($Biomarker)) {
                    $error[] = urlencode('Please enter the name of biomarker.');
                }
                $Category = isset($_POST['Category']) ?
                    trim($_POST['Category']) : '';
                if (empty($Category)) {
                    $error[] = urlencode('Please choose or type category of your biomarker.');
                }
                $Application = isset($_POST['Application']) ?
                    trim($_POST['Application']) : '';
                if (empty($Application)) {
                    $error[] = urlencode('Please select useage of your biomarker.');
                }
                $Location = isset($_POST['Location']) ?
                    trim($_POST['Location']) : '';
                if (empty($Location)) {
                    $error[] = urlencode('Please select the location of your biomarker.');
                }
                $Contributor = isset($_POST['Contributor']) ?
                    trim($_POST['Contributor']) : '';
                if (empty($Contributor)) {
                    $error[] = urlencode('Please leave your real name.');
                }
                $PMID = isset($_POST['PMID']) ?
                    trim($_POST['PMID']) : '';
                if (empty($PMID)) {
                    $error[] = urlencode('Please enter PMID for the research of your biomarker.');
                }
                $Email = isset($_POST['Email']) ?
                    trim($_POST['Email']) : '';
                if (empty($Email)) {
                    $error[] = urlencode('Please enter an E-mail to contact.');
                }
                $Description = isset($_POST['Description']) ?
                    trim($_POST['Description']) : '';
                if (empty($Description)) {
                    $error[] = urlencode('Please enter a brief description.');
                }
                
                if (empty($error)) {
                    $query = "INSERT INTO submission 
                    (`Biomarker`, `Category`, `Application`, `Location`, `PMID`, `Contributor`, `Email`, `Description`) 
                    VALUES('" . $Biomarker . "', '" . $Category . "', '" . $Application . "', '" . $Location . "', '" . $PMID . "','" . $Contributor . "', '" . $Email . "', '" . $Description . "');";
                    mysqli_query($con, $query);
                } else {
                    header('Location:Submission.php?action=add' . '&error=' . join(urlencode('<br/>'), $error));
                }
                break;
        }
        break;
}
?>
<html>

<head>
    <title>Commit TLL - CBD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="content">
        <div class="innerbox">
            <h2 style="text-align: center;">Thanks for your submission!</h2>
            <h3 style="text-align: center;">Please click the "Return" button to return to the search page.</h3>
            <div align="center" style="padding-top: 10px;">
                <input name="return" type="button" id="cbutton" value="Return" onclick="window.open('Submission.php', '_self')">
            </div>
        </div>
    </div>
</body>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
