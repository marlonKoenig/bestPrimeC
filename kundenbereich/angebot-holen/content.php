<?php

?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <h2>Hallo <?php echo $_SESSION['user_firstName']; ?>,<br>
            klicke unten auf den jeweiligen Button.
        </h2>
        <h3>Dein Berater wird sich dann schnellstmöglich bei Dir melden.</h3>
    </div>
    <div id="buttonContainer" data-user_id="<?php echo $_SESSION['user_id'] . ';' . $_SESSION['customer_dealerID'] ?>">
        <div id="power" onclick="getOffer(this)">Strom / Gas</div>
        <div id="dsl" onclick="getOffer(this)">DSL</div>
        <div id="mobile" onclick="getOffer(this)">Mobilfunk</div>
        <div id="solar" onclick="getOffer(this)">Solaranlage</div>
    </div>
    <p id="answer"></p>
</section>