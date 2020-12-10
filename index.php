<html lang="ru">
<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="application/javascript" src="js/code.js"></script>
</head>

<div style="width: 100vw">
    <div style="width: 80vw; float: left">
        <div id='returnedAjax'></div>
    </div>

    <div style="width: 20vw; float: right">
        <form>
            ГРБС:
            <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes()">
                    <select>
                        <option>Выберите значение</option>
                    </select>
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxes">
                    <?php
                    echo getGRBC();
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
</html>

<?php
function getGRBC()
{
    $user = 'root';
    $pass = '';

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=fgbu', $user, $pass);
        $returnValue = '';
        foreach ($dbh->query('SELECT GRBS, GRBS_NAME FROM `gbrs` GROUP BY GRBS, GRBS_NAME') as $row) {
            $returnValue .= "
                <label for=$row[GRBS]>
                <input type='checkbox' id='$row[GRBS]'/>
                $row[GRBS] $row[GRBS_NAME]
                </label>";
        }
        $dbh = null;
        return $returnValue;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}