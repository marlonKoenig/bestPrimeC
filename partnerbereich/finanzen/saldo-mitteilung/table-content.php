<?php
$jsonArray = getJSON('incomeList');
$counter = 1;
?>
            <div id="saldoTable " class="table">
                <div class="TableRow">
                    <div class="tableCell headline period">Rechnungsdatum</div>
                    <div class="tableCell headline type">Typ</div>
                    <div class="tableCell headline number">Rechnungsnummer</div>
                    <div class="tableCell headline icon">Dokument</div>
                </div>
                <?php
                foreach($jsonArray['documents_listing'] as $array) {
                    echo '<div id="row'.$counter.'" class="TableRow">';
                        echo '<div class="tableCell period">'.$array['date'].'</div>';
                        echo '<div class="tableCell type">'.$array['type'].'</div>';
                        echo '<div class="tableCell number">'.$array['remarks'].'</div>';
                        echo '<div class="tableCell icon"><div><img src="'.$image_path . 'icons/pdf.png'.'"></div></div>';
                        echo '</div>';
                        $counter++;
                }
                ?>
            </div>