<?php
    require("vendor/autoload.php");

    use App\Parse\Parse;
    use App\Clients\Clients;
    use App\Produits\Produits;
    use App\Ventes\Ventes;
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Project BDD</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"/>
    </head>
    <body>

        <h1 class="text-center">Projet "Base de données"</h1>

        <?php

        $xlxsparser = new Parse("files/database13.xlsx");

        /**
        * Get customers' list from excel file while parsing and add them to the database 
        */
                    
        $arrcustomerdatas = $xlxsparser->parsefile("Clients");

        foreach ($arrcustomerdatas as $arrcustomerdata)
        {
            $client = new Clients($arrcustomerdata);
            $client->add();
            // echo "<pre>";
            // print_r($client->getArrayClients());
            // echo "</pre>";

        }

        /**
        * Get products' list from excel file while parsing and add them to the database 
        */
        $arrproductdatas = $xlxsparser->parsefile("Produits");

        foreach ($arrproductdatas as $arrproductdata)
        {
            $product = new Produits($arrproductdata);
            $product->add();
            // echo "<pre>";
            // print_r($product->getArrayProduits());
            // echo "</pre>";
        }

        /**
        * Get sales' list from excel file while parsing and add them to the database 
        */
        $arrsaledatas = $xlxsparser->parsefile("Ventes");

        foreach ($arrsaledatas as $arrsaledata)
        {
            $sale = new Ventes($arrsaledata);
            $sale->add();
            // echo "<pre>";
            // print_r($sale->getArrayVentes());
            // echo "</pre>";
        }

        ?>
        <hr/>
        <ul class="nav nav-pills nav-fill justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="customers.php">Clients</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="products.php">Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Ventes</a>
            </li>
        </ul>
        <hr/>

        <section>

            <form method="POST" action="search.php">
                <label for="search">Rechercher :</label>
                <input type="text" name="search" />
                <button type="submit" class="btn btn-primary">Recherche</button>
            </form>

        </section>

    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>