<?php

?>
<section id="topSection" class="">
    <a href="<?php echo $root ?>">
        <img src="<?php echo $image_path . 'icons/Logo-bestPrime.png' ?>" class="logo" alt="BestPrime">
    </a>
    <div id="karriereContainer">
        <div>
            Aktuelle Karrierestufe:
        </div>
        <div id="karriereStufe">
            <?php echo $_SESSION['user_rank']; ?>
        </div>
    </div>

    <div id="topNavi" class="flex flex-space">
        <?php
        // echo $_SESSION["user_xTime"];
        if (($_SESSION['user_xTime'] > time())) { // Es handelt sich um einen PBX und der CountDown läuft noch
            include_once($root . "php/billing.php");
            if (isset($_SESSION["user_id"])) {
                $result = setPartnerXpressBonus($_SESSION["user_id"]);
            } else {
                $result = array("registeredPartners" => 0);
            }

            include $root . 'partnerbereich/bpx/countermodul.php';
        }
        ?>
        <div id="stromRechner" class="<?php
                                        if ($site == "stromRechner") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/strom" class="">Tarifrechner<br>Strom&Gas
            </a>
        </div>
        <div id="dslRechner" class="<?php
                                    if ($site == "dslRechner") {
                                        echo "current";
                                    } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/dsl" class="">Tarifrechner<br>DSL
            </a>
        </div>
        <div id="mobilRechner" class="<?php
                                        if ($site == "mobilRechner") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/mobil" class="">Tarifrechner<br>Mobilfunk
            </a>
        </div>
        <div id="kfzRechner" class="canceld <?php
                                            if ($site == "kfzRechner") {
                                                echo "current";
                                            } ?>"><a href="<?php echo $root ?>partnerbereich/tarifrechner/kfz" class="">Tarifrechner<br>KFZ
            </a>
        </div>
        <div id="shoppingWelt" class="<?php
                                        if ($site == "shoppingWelt") {
                                            echo "current";
                                        } ?>"><a href="<?php echo $root ?>partnerbereich/shoppingwelt" class="">Zugang zur<br>xxWorld
            </a>
        </div>
    </div>
</section>
<?php
if (($_SESSION['user_xTime'] > time())) { // Es handelt sich um einen PBX und der CountDown läuft noch
?>
    <section id="info">
        <?php include $root . 'partnerbereich/bpx/countermodul.php'; ?>
    </section>
    <script>
        let targetTime = "<?php echo $_SESSION['user_xTime']; ?>";
        countDownModul(targetTime);
    </script>
<?php
}
?>