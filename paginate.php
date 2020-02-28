<?php
require("vendor/autoload.php");

use App\Ventes\CRUDVentes;

$limit = 500;

$page = (isset($_GET["page"])) ? intval($_GET["page"]) : 1;

$crudsellings = new CRUDVentes();

$start_from = ($page-1) * $limit; 

$sellings = $crudsellings->readwithpaginate($limit,$start_from);
?>
<table id="listselling" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Produit acheté</th>
                    <th>Prix (€)</th>
                    <th>Quantité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($sellings as $selling): ?>
                <tr>
                    <td><?= $selling["sale_id"] ?></td>
                    <td><?= $selling["firstname"] ?></td>
                    <td><?= $selling["lastname"] ?></td>
                    <td><?= $selling["date"] ?></td>
                    <td><?= $selling["name"] ?></td>
                    <td><?= $selling["price"] ?></td>
                    <td><?= $selling["quantite"] ?></td>
                    <td>
                        <button id="edit" value="<?= $selling["sale_id"] ?>" class="btn btn-primary"><em class="far fa-edit"></em></button>
                        <button id="view" value="<?= $selling["sale_id"] ?>" class="btn btn-info"><em class="far fa-eye"></em></button>
                        <button id="delete" value="<?= $selling["sale_id"] ?>" class="btn btn-danger"><em class="far fa-trash-alt"></em></button>
                    </td>
                </tr>
        <?php endforeach; ?> 
            </tbody>
</table>