<?php
    session_start();
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "Add to cart")
            if(in_array($_POST['item'], $_SESSION['items'])) {
                //$_POST['item'] = "Already added";
                exit;
            }
            else
                $_SESSION['items'][] = $_POST['item']; //array_push($_SESSION['items'], $_POST['item']);
        else {
            $index = array_search($_POST['item'],$_SESSION['items']);
            unset($_SESSION['items'][$index]);
            if (count($_SESSION['items']) <= 0)
                unset($_SESSION['items']);
        }
    }
?>