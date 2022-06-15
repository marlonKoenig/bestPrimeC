<?php

?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <h2>Hallo <?php echo $_SESSION['user_firstName']; ?>,<br>
            was möchtest Du gerne optimieren?
        </h2>
        <div id="buttonContainer">
            <a href="tarifrechner/strom">
                <div id="power">Strom / Gas</div>
            </a>
            <a href="tarifrechner/dsl">
                <div id="dsl">DSL</div>
            </a>
            <a href="tarifrechner/mobil">
                <div id="mobil">Mobilfunk</div>
            </a>
        </div>
    </div>
</section>