<?php require ('Include/inc_connexion.php'); ?>
<?php session_start(); ?>

<?php 
//récupération des produits
$result = $mysqli -> query ('SELECT * FROM produit');
$donnees = $result -> fetch_all();
?>

<!DOCUTYPE html>
    <html>

    <head>
        <title>Boutique en ligne</title>
        <link rel="stylesheet" href="css/style.css" media="screen"/>
        <meta charset="UTF-8" />
    </head>

    <body>
        <div class="wrapper">
            <?php require ('Include/inc_header.php') ?>
            <section>
                <!-- Affichage des produits -->
                <?php 
                foreach ($donnees as $key => $value)
                {
                    $ProductName = $value ['1'];
                    $ProductPrice = $value ['2'];
                    $id = $value ['0'];
                    $stock = $value ['3'];
                ?>
                <div class="article">
                    <h2><?php echo $ProductName; ?></h2>
                    <p class="prix"><?php echo $ProductPrice.'€'; ?></p>
                    <?php 
                    if ($stock > 0)
                    {
                    ?>
                    <form action="panier.php" method="POST">
                        <p><input type="submit" name="<?php echo $id; ?>" value="Ajouter au panier" /></p>
                    </form>
                    <?php
                    }
                    else 
                    {
                    ?>
                    <p class="reappro">En cours de réaprovisionnement</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="clear"></div>
                <?php
                }
                ?>
            </section>

            <?php require('Include/inc_footer.php') ?>

        </div>
    </body>

    </html>