<?php
session_start();
require ('Include/inc_connexion.php'); 
require ('Include/session_panier.php');
require ('Include/inc_refresh.php');
?>
<!DOCUTYPE html>
<html>
    <head>
        <title>Boutique en ligne</title>
        <link rel="stylesheet" href="css/style.css" media="screen" />
    </head>
    <body>
        <div class="wrapper">
            <?php require ('Include/inc_header.php'); ?>
            <h1 class="titre_panier">Votre Panier</h1>
            <?php 
            if (isset ($message)) 
            {
            ?>
            <p class="erreur">
                <?php echo $message;
                exit;
                ?>
            </p>  
            <?php  
            }

            if (isset ($_SESSION['stock_error']))
            {
            ?>
               <p class="erreur"><?php echo $_SESSION ['stock_error']; ?></p> 
            <?php
            unset($_SESSION['stock_error']);
            }
            ?>

            <section>
                <p class="lien_retour"><a href="index.php">Continuez vos achats</a></p>

                <table>

                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Prix unitaire TTC</th>
                            <th>Prix total TTC</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $great_total = 0;
                        foreach ($_SESSION ['panier'] as $key => $quantite)
                        
                        {
                            $result = $mysqli ->query ('SELECT * FROM produit WHERE product_id = ' .$key);
                            $row = $result ->fetch_array();                  
                            
                                   
                            
                            $name = $row ['product_name'];
                            $price = $row ['product_price'];
                            $total_price = $price*$quantite;

                            $great_total += $total_price;
                            
                        ?>

                        <tr>
                            <td><?php echo $name; ?></td>
                            <td><a class="choix_quantite" href="Include/stock.php?id=<?php echo $key; ?>">-</a><a class="choix_quantite" href="Include/adding.php?id=<?php echo $key; ?>">+</td>
                            <td><?php echo $price.'€'; ?></td>
                            <td><?php echo $total_price.'€' ?></td>
                            <td><a class="delete_article" href="Include/delete.php?id=<?php echo $key; ?>">x</a></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td class="no_border"></td>
                            <td class="no_border"></td>
                            <td class="table_bold">TOTAL</td>
                            <td class="bold"><?php echo $great_total.'€'; ?></td>
                        </tr>
                        <tr>
                            <td class="no_border"></td>
                            <td class="no_border"></td>
                            <td class="table_small">dont TVA 20%</td>
                            <td class="small"><?php echo round($tva = $great_total - ($great_total*0.8),2). '€'; ?></td>
                        </tr>
                    </tfoot>
                </table>

                <form action="#">
                    <input id="Validation_panier" type="submit" name="validation" value="Valider le panier"/>
                </form>
            </section>

<!--            <?php require ('Include/inc_footer.php'); ?> -->
        </div>
    </body>
</html>