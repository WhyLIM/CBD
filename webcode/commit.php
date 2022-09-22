<?php
//connect to MySQL
$con = mysqli_connect('localhost', '******', '********', 'cbd_limina_top');
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
                    $error[] = urlencode('Please enter the biomarker category.');
                }
                $Type = isset($_POST['Type']) ?
                    trim($_POST['Type']) : '';
                if (empty($Type)) {
                    $error[] = urlencode('Please select a biomarker type.');
                }
                $Location = isset($_POST['Location']) ?
                    trim($_POST['Location']) : '';
                if (empty($Location)) {
                    $error[] = urlencode('Please select the location.');
                }
                $Contributor = isset($_POST['Contributor']) ?
                    trim($_POST['Contributor']) : '';
                if (empty($Contributor)) {
                    $error[] = urlencode('Please enter your name.');
                }
                $PMID = isset($_POST['PMID']) ?
                    trim($_POST['PMID']) : '';
                if (empty($PMID)) {
                    $error[] = urlencode('Please enter a PMID.');
                }
                $Email = isset($_POST['Email']) ?
                    trim($_POST['Email']) : '';
                if (empty($Email)) {
                    $error[] = urlencode('Please enter an Email.');
                }
                $Description = isset($_POST['Description']) ?
                    trim($_POST['Description']) : '';
                if (empty($Description)) {
                    $error[] = urlencode('Please enter a brief description.');
                }
                
                if (empty($error)) {
                    $query = "INSERT INTO submission
                    (`Biomarker`, `Category`, `Type`, `Location`,`PMID`, `Contributor`, `Email`, `Description`) 
                    VALUES(" . $Biomarker . ", '" . $Category . "', '" . $Type . "', '" . $Location . "', '" . $PMID . "','" . $Contributor . "', '" . $Email . "', '" . $Description . "');";
                } else {
                    header('Location:Submission.php?action=add' .
                        '&error=' . join($error, urlencode('<br/>')));
                }
                break;
        }
        break;
}
?>
<html>

<head>
    <title>Commit TLL - CBD</title>
</head>

<body>
    <p>Thanks for your submission.</p>
</body>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
