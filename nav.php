<nav class="nav-aside">
    <input id="checkBoxMenu" type="checkbox" class="menu-check" />
    <div class="nav-list">
        <div id="smartLogo">
            <img src="<?php echo $image_path . 'icons/Logo-bestPrime.png' ?>" class="logo" alt="BestPrime">
        </div>
        <div id="stromRechner" class="topNavi <?php
                                                if ($site == "stromRechner") {
                                                    echo "current";
                                                } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/strom" class="">Tarifrechner Strom&Gas
            </a>
        </div>
        <div id="dslRechner" class="topNavi <?php
                                            if ($site == "") {
                                                echo "current";
                                            } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/dsl" class="">Tarifrechner DSL
            </a>
        </div>
        <div id="mobilRechner" class="topNavi <?php
                                                if ($site == "") {
                                                    echo "current";
                                                } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/mobil" class="">Tarifrechner Mobilfunk
            </a>
        </div>
        <div id="kfzRechner" class="topNavi canceld<?php
                                                    if ($site == "") {
                                                        echo "current";
                                                    } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/kfz" class="">Tarifrechner KFZ
            </a>
        </div>
        <div id="shoppingWelt" class="topNavi <?php
                                                if ($site == "") {
                                                    echo "current";
                                                } ?>"><a href="<?php echo $root ?>partnerbereich/shoppingwelt" class="">Zugang zur xxWorld
            </a>
        </div>
        <div class="<?php
                    if ($site == "dashboard") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/" class="head">Dashboard</a>
        </div>
        <div class="<?php
                    if ($site == "news") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/news" class="">News</a>
        </div>
        <div class="disabled canceld <?php
                                        if ($site == "") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $root ?>#" class="">Incentives</a>
        </div>
        <div class="<?php
                    if ($site == "ranking") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/ranking" class="">Ranking</a>
        </div>
        <div id="marketingList" class="<?php
                                        if (($site == "marketingcenter") or ($site == "businessrechner") or ($site == "onlineberatungREM") or ($site == "tgr24") or ($site == "socialpost")) {
                                            echo "current open";
                                        } ?>"><a href="<?php echo $root ?>partnerbereich/marketingcenter/businessrechner" class="">Marketingcenter</a>
            <div class="<?php
                        if ($site == "businessrechner") {
                            echo "current open";
                        } ?>"><a href="<?php echo $root ?>partnerbereich/marketingcenter/businessrechner">Businessrechner</a>
            </div>
            <!-- <div class="disabled canceld <?php
                                                /* if ($site == "onlineberatung") {
                                                    echo "current open";
                                                    $childOpen = ' open';
                                                } */ ?>"><a href="<?php //echo $root 
                                                                    ?>partnerbereich/marketingcenter/onlineberatung">Onlineberatung</a>
            </div> -->
            <div class="disabled canceld <?php
                                            if ($site == "tgr24") {
                                                echo "current open";
                                                $childOpen = ' open';
                                            } ?>"><a href="<?php echo $root ?>partnerbereich/marketingcenter/tgr24">TGR24</a>
            </div>
            <div class="disabled canceld <?php
                                            if ($site == "socialpost") {
                                                echo "current open";
                                                $childOpen = ' open';
                                            } ?>"><a href="<?php echo $root ?>partnerbereich/marketingcenter/socialpost">Social-Postings</a>
            </div>
        </div>
        <div class="<?php
                    if ($site == "mein-team") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/mein-team" class="">Mein Team</a>
        </div>
        <div class="<?php
                    if ($site == "meine-kunden") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/meine-kunden" class="">Meine Kunden</a>
        </div>
        <div class="<?php
                    if ($site == "onlineberatung") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/onlineberatung" class="">Onlineberatung</a>
        </div>
        <div class="<?php
                    if ($site == "auftragsverwaltung") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/auftragsverwaltung" class="">Auftragsverwaltung</a>
        </div>
        <div id="finanzList" class="<?php
                                    if (($site == "provisionen") or ($site == "saldoMitteilung")) {
                                        echo "current open";
                                    } ?>"><a href="<?php echo $root ?>partnerbereich/finanzen/aktuelle-provision" class="">Finanzen</a>
            <div class="<?php
                        if ($site == "provisionen") {
                            echo "current open";
                        } ?>"><a href="<?php echo $root ?>partnerbereich/finanzen/aktuelle-provision">Aktuelle
                    Provision</a>
            </div>
            <div class="<?php
                        if ($site == "saldoMitteilung") {
                            echo "current open";
                        } ?>"><a href="<?php echo $root ?>partnerbereich/finanzen/saldo-mitteilung">Saldo-Mitteilung</a>
            </div>
        </div>
        <div class="disabled canceld <?php
                                        if ($site == "") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $root ?>#" class="">E-Learning</a>
        </div>
        <div class="<?php
                    if ($site == "downloads") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/downloadcenter" class="">Downloadcenter</a>
        </div>
        <div class="<?php
                    if ($site == "faq") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/faq" class="">FAQ</a>
        </div>
        <div class="<?php
                    if ($site == "support") {
                        echo "current";
                    } ?>"><a href="<?php echo $root ?>partnerbereich/support" class="">Support</a>
        </div>
        <div id="logOut"><a href="<?php echo $root ?>logOut.php">LOGOUT</a></div>
        <div id="ownIdContainer">Deine ShopOwner-ID lautet: <br>
            <span id="ownId"><?php echo $_SESSION['user_partnerId']; ?></span>
        </div>
    </div>
    <div class="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>