<?php
session_start();
require ('inc_connexion.php');

$id = strip_tags($_GET['id']);

print_r($id);

//controle du stock

$result = $mysqli -> query ('SELECT * FROM produit WHERE product_id = ' .$id);

$row = $result -> fetch_array();



$stock = $row['product_stock'];


if ((!empty ($stock)) AND ($_SESSION ['panier'][$id] < $stock))
{
    $_SESSION ['panier'][$id] ++;
    header('location:../panier.php');
    exit;
}
else
{
    $_SESSION ['stock_error'] = 'Le stock est insufissant.';
    header('location:../panier.php');
    exit;
}