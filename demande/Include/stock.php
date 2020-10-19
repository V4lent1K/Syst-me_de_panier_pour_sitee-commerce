<?php
session_start();

$id = strip_tags($_GET['id']);

if ($_SESSION ['panier'][$id] > 0)
{
    $_SESSION ['panier'][$id] --;

    if (($_SESSION['panier'][$id] === 0) AND (count($_SESSION['panier']) > 1))
    {
        unset ($_SESSION ['panier'][$id]);

        header('location:../panier.php');
        exit;
    }
    elseif (($_SESSION['panier'][$id] === 0) AND (count($_SESSION['panier']) === 1))
    {
        $_SESSION['panier'] = array();

        $_SESSION['delete'] = 'delete';

        header('location:../panier.php');
        exit;
    }
    else
    {
        header('location:../panier.php');
        exit;
    }
}
else
{
    header('location:../panier.php');
    exit;
}