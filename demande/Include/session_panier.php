<?php
if (!empty ($_POST)) //si $_POST n'est pas vide
{

    foreach ($_POST as $key => $value) //boucle permettant d'extraire l'id produit
    {
        $id = $key;
    }

    if (isset ($_SESSION ['panier'][$id])) //si le produit est déja dans le panier
    {
        $result = $mysqli -> prepare ('SELECT product_stock FROM produit WHERE product_id = ?');

        $result -> execute (array($id));

        $row = $result -> fetch();

        $stock = $row['product_stock'];

            //si le produit existe bien dans la table produit et si le stock est inférieur à la quantité
            if ((!empty ($stock)) AND ($_SESSION ['panier'][$id] < $stock))
            {
                $_SESSION ['panier'][$id]++; //ajout de 1

                //MAJ cookie

                $panier = $_SESSION ['panier'];
                $cookie = serialize($panier);

                setcookie('panier', $cookie, time()+ 12960000);
            }
    }

    else //si le produit n'est pas dans le panier
    {
        $_SESSION ['panier'][$id] = 1; //quantité égale à 1

        $panier = $_SESSION ['panier'];
        $cookie = serialize($panier);

        setcookie('panier', $cookie, time()+ 12960000); //création du cookie
    }
}

//si $_SESSION n'existe pas et $_COOKIE n'est pas vide
elseif((!isset ($_SESSION ['panier'])) AND (!empty($_COOKIE ['panier'])))
{
    $_SESSION ['panier'] = unserialize($_COOKIE['panier']);
    $panier = $_SESSION ['panier'];
    $cookie = serialize($panier);

    setcookie('panier', $cookie, time()+ 12960000);
}

//si $_SESSION ['delete'] existe = cas de suppression d'article
elseif (isset ($_SESSION ['delete']))
{
    unset ($_SESSION ['delete']);
    setcookie ('panier', NULL, -1);
    header('location:panier.php');
    exit;
}

//sinon si $_SESSION ['panier'] n'existe pas alors on le crée vide, affichage message
elseif (!isset($_SESSION ['panier']))
{
    $_SESSION ['panier'] = array();
    $message = "Votre panier est vide";
}

//sinon le panier est vide
elseif ($_SESSION ['panier'] === array())
{
    $message = "Votre panier est vide.";
}