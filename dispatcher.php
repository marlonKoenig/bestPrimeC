<?php
session_start();
include_once "php/inc_functions.php";
// test();
/* $content = $_POST['funktion'];
get_object_vars($content); */
switch ($_POST['funktion']) {
    case 'loadDetailsList':
        $answer = include('partnerbereich/mein-team/meine-filialen/detailsTable.php');
        echo substr($answer, 0, -1); // entfernt die mitgelieferte "1", woher die auch immer kommen mag
        break;
    case 'welcome':
        // echo "einsieins";
        if ($_POST['step'] == 1) {
            $answer = include('welcome/welcomeWorld.php');
        } else if ($_POST['step'] == 2) {
            $answer = include('welcome/welcomeEurope.php');
        } else if ($_POST['step'] == 3) {
            $answer = include('welcome/welcomeLand.php');
        } else if ($_POST['step'] == 4) {
            $answer = include('welcome/anmeldemaske.php');
        } else if ($_POST['step'] == 5) {
            $answer = include('welcome/payment.php');
        }
        echo substr($answer, 0, -1); // entfernt die mitgelieferte "1", woher die auch immer kommen mag
        // echo $_POST['inputValue'];
        break;
    case 'sendWelcome':
        $str_json = file_get_contents('php://input');
        echo $str_json;
        break;
    case 'counterTime':
        echo $_SESSION['user_xTime'];
        break;
    case 'cloak':
        //echo "Das ist ein Testsatz aus dem dispatcher";
        cloaking();
        break;
    case 'DSE':
        loadDSE();
        break;
    case 'DSEsocial':
        loadDSEsocial();
        break;
    case 'scroll':
        //echo 'Übertragung aus AJAX war erfolgreicher';
        scrolling();
        break;
    case 'registerPartner':
        print_r($_POST["funktion"]);
        break;
}
