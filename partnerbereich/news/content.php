<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="intro">
            Aktuelle Informationen, speziell für unsere Vertriebspartner:
        </div>
        <div id="newsTable">
            <div id="newsTableHead" class="newsTableRow headline">
                <div class="datum headLine">Datum</div>
                <div class="newsTheme headLine">Thema</div>
                <div class="link headLine">Link</div>
            </div>
            <div id="newsTableRow01" class="newsTableRow">
                <div class="datum">01.10.2021</div>
                <div class="newsTheme">Neue Kooperation mit E-ON</div>
                <div class="link">
                    <a href="<?php echo $root . 'media/users/news/Allgemeine_Bavaria_lipsum.pdf'; ?>" target="blank">PDF-Dokument</a>
                </div>
            </div>
            <div id="newsTableRow02" class="newsTableRow">
                <div class="datum">01.10.2021</div>
                <div class="newsTheme">Neue Kooperation mit E-ON</div>
                <div class="link">
                    <a href="<?php echo $root . 'media/users/news/Allgemeine_Bavaria_lipsum.pdf'; ?>" target="blank">PDF-Dokument</a>
                </div>
            </div>
            <div id="newsTableRow03" class="newsTableRow">
                <div class="datum">01.10.2021</div>
                <div class="newsTheme">Neue Kooperation mit E-ON</div>
                <div class="link">
                    <a href="<?php echo $root . 'media/users/news/Allgemeine_Bavaria_lipsum.pdf'; ?>" target="blank">PDF-Dokument</a>
                </div>
            </div>
            <div id="newsTableRow04" class="newsTableRow">
                <div class="datum">01.10.2021</div>
                <div class="newsTheme">Neue Kooperation mit E-ON</div>
                <div class="link">
                    <a href="<?php echo $root . 'media/users/news/Allgemeine_Bavaria_lipsum.pdf'; ?>" target="blank">PDF-Dokument</a>
                </div>
            </div>
        </div>
    </div>
</section>
