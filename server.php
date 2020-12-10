<?php
$PostValue = $_POST['inputId'];

if (isset($PostValue) && !is_null($PostValue)) {
    $PostArrayString = implode(",", $PostValue);
    getGRBCbyParam($PostArrayString);
} else {
    echo '';
}

function getGRBCbyParam($param)
{
    $user = 'root';
    $pass = '';

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=fgbu', $user, $pass);
        $returnValue = '<table>';

        foreach ($dbh->query("SELECT * FROM `gbrs` WHERE GRBS IN ($param)") as $row) {
            $returnValue .= "<tr><td>$row[GRBS]</td><td>$row[GRBS_NAME]</td><td>$row[CODE_NP]</td><td>$row[NP_NAME]</td><td>$row[FP_NAME]</td><td>$row[U_LBO_TEK]</td><td>$row[BO_TEK]</td><td>$row[KAS_ISP]</td>";
        }

        $dbh = null;
        $returnValue .= '</table>';
        echo $returnValue;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}