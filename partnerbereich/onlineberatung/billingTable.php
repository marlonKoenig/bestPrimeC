<?php
// post-Daten werden übermittelt durch system.js / refreshBillingList()
$file_root_path = "../../media/users/" . $_POST['customer_id'] . "/documents/";
$counter = 1;
?>
<div id="headline">Hochgeladene Rechnungen:</div>
<div id="billOutputTable" class="table">
    <div class="TableRow headline">
        <div class="table-cell billName">Rechnungsname</div>
        <div class="table-cell billDate">Datum (Upload)</div>
    </div>
    <?php

    if (is_dir($file_root_path)) {
        // öffnen des Verzeichnisses
        if ($handle = opendir($file_root_path)) {
            // einlesen des Verzeichnisses
            while ($file = readdir($handle)) {
                if (strtolower(pathinfo($file_root_path . $file, PATHINFO_EXTENSION)) == 'pdf') { // sortiert ales aus, was kein pdf ist
                    echo '<div id="row' . $counter . '" class="TableRow">';
                    echo '<div class="table-cell billName"><a href="' . $file_root_path . $file . '" target="blank">' . $file . '</a></div>';
                    echo '<div class="table-cell billDate">' . date('d.m.Y H:i:s', filemtime($file_root_path . $file)) . '</div>';
                    echo '</div>';
                    $counter++;
                }
            }
            closedir($handle);
        } else {
            echo 'Datei kann nicht geöffnet werden (bitte wende Dich an den Admin)';
        }
    } else {
        echo 'Ungültiges Verzeichnis (bitte wende Dich an den Admin)';
    }
    ?>
</div>