<header>

    <h1>Boutique en Ligne</h1>

    <nav>

        <ul>

            <li><a href="index.php">Accueil</a></li>
            <li><a href="#">Notre entreprise</a></li>

        </ul>

    </nav>

    <aside id="panier">

        <p><a href="Panier.php">Votre panier</a></p>

        <?php

        //si le panier n'est pas vide
        if (!empty($_SESSION['panier']))
        {
            $nb_article = count($_SESSION['panier']); //compte le nombre d'éléments dans le panier

                if ($nb_article === 1) //pour écrire article sans S !
                {
                ?>
                <p><?php echo $nb_article. 'article'; ?></p>
                <?php
                }

                else
                {
                ?>
                <p><?php echo $nb_article. 'articles'; ?></p>
                <?php
                }
        }

        elseif (isset($_COOKIE['panier'])) //on retourne sur le site plus tard, on joue sur le cookie
        {
            $_SESSION ['panier'] = unserialize($_COOKIE['panier']); 

            $nb_article = count($_SESSION['panier']);


            if ($nb_article === 1)
            {
            ?>
            <p><?php echo $nb_article. 'article'; ?></p>
            <?php
            }


            else
            {
            ?>
            <p><?php echo $nb_article. 'articles'; ?></p>
            <?php
            }
        }

        
        else //s'il n'y a pas de session ou de cookie
        {
        ?>
        <p>Panier Vide</p>
        <?php
        }
        ?>

    </aside>

</header>