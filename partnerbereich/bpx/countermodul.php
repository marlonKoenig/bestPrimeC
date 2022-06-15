<?php

if ($result['registeredPartners'] >= 5) {
    echo '<div id="headLine" class="bold">Glückwunsch XPRESS BONUS gewonnen!</div>';
} else {
    echo '<div class="counterModul">
    <div id="headLine">XPRESS Bonus</div>
    <div id="counterContainer" onclick="showDevelopment(' . $result['registeredPartners'] . ');">

        <div id="" class="counterContainerHead">
            Tage
        </div>
        <div id="" class="counterContainerHead">
            Stunden
        </div>
        <div id="" class="counterContainerHead">
            Minuten
        </div>
        <div id="" class="counterContainerHead">
            Sekunden
        </div>
        <div id="" class="dayBody counterContainerBody">
            &nbsp;&nbsp;
        </div>
        <div id="" class="hourBody counterContainerBody">
            &nbsp;&nbsp;
        </div>
        <div id="" class="minuteBody counterContainerBody">
            &nbsp;&nbsp;
        </div>
        <div id="" class="secondsBody counterContainerBody">
            &nbsp;&nbsp;
        </div>
    </div>
</div>';
}

?>



<style>
    #developmentContainer {
        background-color: black;
    }

    #svgHead {
        color: white;
        font-size: 3em;
        padding-bottom: 1em;
    }

    .svgWhite {
        stroke: white;
        fill: white;
    }

    .svgGreen {
        stroke: green;
        fill: green;
    }

    .svgRed {
        stroke: red;
        fill: red;
    }

    #svgRow1 {
        display: flex;
        justify-content: center;
    }

    #svgRow2 {
        display: flex;
        justify-content: center;
        gap: 1em;
        padding-top: 1em;
        padding-bottom: 1em;
    }
</style>