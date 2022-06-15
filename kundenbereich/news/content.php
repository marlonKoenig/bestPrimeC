<?php
$jsonArray = getJSON('newsTable');
$counter = 1;
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="startBlock1" class="movedown scroll">
            <h2>Hallo <?php echo $_SESSION['user_firstName']; ?>,<br>
                hier siehst Du alle Neuigkeiten auf einen Blick.
            </h2>
            <div id="newsTable">
                <div id="newsTableHead" class="newsTableRow headline">
                    <div class="datum headLine">Datum</div>
                    <div class="newsTheme headLine">Thema</div>
                    <div class="link headLine">Link</div>
                </div>
                <?php
                foreach ($jsonArray['news'] as $Array) {
                    echo '<div id="newsRow' . $counter . '" class="newsTableRow">';
                    echo '<div class="datum">' . $Array['newsDate'] . '</div>';
                    echo '<div class="newsTheme">' . $Array['newsTheme'] . '</div>';
                    echo '<a href="' . $_SESSION['root'] . $jsonArray['news-link'] . $Array['link'] . '" target="blank"><div class="link">' . $Array['link'] . '</div></a>';
                    echo '</div>';
                    echo '';
                }
                $counter++;
                ?>
            </div>
        </div>
</section>