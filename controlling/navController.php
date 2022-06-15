<nav class="nav-aside">
    <input id="checkBoxMenu" type="checkbox" class="menu-check" />
    <div class="nav-list">
        <div id="smartLogo">
            <img src="<?php echo $image_path . 'icons/Logo-bestPrime.png' ?>" class="logo" alt="BestPrime">
        </div>
        <div class="<?php
                    if ($site == "dashboard") {
                        echo "current";
                    } ?>"><a href="<?php echo $controller_path ?>" class="head">Dashboard</a>
        </div>
        <div class="disabled <?php
                                if ($site == "news") {
                                    echo "current";
                                } ?>"><a href="<?php echo $controller_path ?>news" class="">News erstellen</a>
        </div>
        <div class="<?php
                    if ($site == "angebot-checken") {
                        echo "current";
                    } ?>"><a href="<?php echo $controller_path ?>angebot-checken" class="">Offene Verträge prüfen</a>
        </div>
        <div class="disabled canceld<?php
                                    if ($site == "optimierung") {
                                        echo "current";
                                    } ?>"><a href="<?php echo $controller_path ?>optimierung" class="">Optimierung gewünscht</a>
        </div>
        <div class="disabled canceld<?php
                                    if ($site == "mein-vertrag") {
                                        echo "current";
                                    } ?>"><a href="<?php echo $controller_path ?>mein-vertrag" class="">Meine Verträge</a>
        </div>
        <div class="disabled canceld<?php
                                    if ($site == "shoppingwelt") {
                                        echo "current";
                                    } ?>"><a href="<?php echo $controller_path ?>shoppingwelt" class="">Shoppingwelt</a>
        </div>
        <div class="disabled canceld<?php
                                    if ($site == "mein-guthaben") {
                                        echo "current";
                                    } ?>"><a href="<?php echo $controller_path ?>mein-guthaben" class="">Mein Guthaben</a>
        </div>
        <div class="disabled canceld <?php
                                        if ($site == "testimonials") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $controller_path ?>testimonials" class="">Kunden Testimonials</a>
        </div>
        <div class="disabled canceld<?php
                                    if ($site == "empfehlungen") {
                                        echo "current";
                                    } ?>"><a href="<?php echo $controller_path ?>empfehlungen" class="">Meine Empfehlungen</a>
        </div>
        <div class="disabled canceld <?php
                                        if ($site == "faq") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $controller_path ?>faq" class="">FAQ</a>
        </div>
        <div class="disabled canceld <?php
                                        if ($site == "support") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $controller_path ?>support" class="">Support</a>
        </div>
        <div id="logOut"><a href="<?php echo $root ?>logOut.php">LOGOUT</a></div>
    </div>
    <div class="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>