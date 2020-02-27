<?php
    require("vendor/autoload.php");

    use App\Produits\CRUDProduits;
    
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

        <h2>Listes des produits:</h2>

        <?php 
            $crudproducts = new CRUDProduits();
            $products = $crudproducts->read();

            // echo "<pre>";
            // print_r($products);
            // echo "</pre>";
        ?>

        <table id="listproduct" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Propriétaire</th>
                    <th>Nom </th>
                    <th>Description</th>
                    <th>Url</th>
                    <th>Mots clés</th>
                    <th>Prix (€)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($products as $product) :?>
                <tr>
                    <td><?= $product["product_id"] ?></td>
                    <td><?= $product["name_compagny"] ?></td>
                    <td><?= $product["name"] ?></td>
                    <td><?= $product["description"] ?></td>
                    <td><?= $product["url"] ?></td>
                    <td><?= $product["keywords"] ?></td>
                    <td><?= $product["price"] ?></td>
                    <td>
                        <button id="edit" value="<?= $product["product_id"] ?>" class="btn btn-primary"><em class="far fa-edit"></em></button>
                        <button id="view" value="<?= $product["product_id"] ?>" class="btn btn-info"><em class="far fa-eye"></em></button>
                        <button id="delete" value="<?= $product["product_id"] ?>" class="btn btn-danger"><em class="far fa-trash-alt"></em></button>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
       
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>