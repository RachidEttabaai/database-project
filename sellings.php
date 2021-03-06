<?php
    require("vendor/autoload.php");

    use App\Ventes\CRUDVentes;
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

        <h2>Listes des ventes:</h2>

        <?php 

        $crudsellings = new CRUDVentes();
        $nbsellings = $crudsellings->countSellings();
        $limit = 500;
        $pagestotal = ceil($nbsellings/$limit);

        ?>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center" id="pagination">
                <?php if(!empty($pagestotal)): ?>
                    <?php for($i=1; $i<=$pagestotal; $i++): ?>
                        <?php if($i==1): ?>
                            <li class="page-item active"  id="<?= $i ?>"><a class="page-link" href="paginate.php?page=<?= $i ?>"><?php echo $i;?></a></li>
                        <?php else:?>
                            <li class="page-item" id="<?= $i ?>"><a class="page-link" href="paginate.php?page=<?= $i ?>"><?php echo $i;?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php endif; ?>
            </ul>
        </nav>

        <section id="target"></section>

    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="assets/js/paginate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>