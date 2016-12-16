<section class = "central">
    <div class="container">
        <form class="order-restaurants" action="" method="get" autocomplete="off">
            <?php
            echo ('<select name="order-type" required id="order-type" class="search-dropdown"><option value="relevance" ');
            if ($_SESSION['type'] == 0) {
                echo("selected");
            }
            echo('>Relevância</option><option value="name" ');
            if ($_SESSION['type'] == 1) {
                echo("selected");
            }
            echo('>Nome</option><option value="rating " ');
            if ($_SESSION['type'] == 2) {
                echo("selected");
            }
            echo('>Avaliação</option><option value="price" ');
            if ($_SESSION['type'] == 3) {
                echo("selected");
            }
            echo('>Preço</option></select>');

            echo('<select name="order-orientation" required id="order-orientation" class="search-dropdown"><option value="descending "');
            if ($_SESSION['orientation'] == 0) {
                echo("selected");
            }
            echo('>Descendente</option><option value="ascending"');
            if ($_SESSION['orientation'] == 1) {
                echo("selected");
            }
            echo('>Ascendente</option></select>');
            ?>
        </form>

        <?php
        foreach($_SESSION['restaurants'] as $restaurant) { ?>
            <article class="listrestaurant box">
                <div class="restaurantphoto">
                    <img src="../uploads/restaurants/<?=$restaurant['restaurantphoto']?>">
                </div>
                <div class= "content">
                    <a href="../pages/restaurant.php?id=<?=$restaurant['id']?>"><h3><?=$restaurant['name']?></h3></a>
                    <div class="rating">
                        <?php for ($i = 0; $i < round($restaurant['reviewersRating']); $i++){ ?>
                            <img src="../res/images/star.png">
                        <?php } for ($j = 0; $j < 5-round($restaurant['reviewersRating']); $j++){ ?>
                            <img src="../res/images/emptystar.png">
                        <?php } ?>
                    </div>
                    <br>
                    <p><?=$restaurant['city']?> &middot <?=$restaurant['country']?></p><br>
                    <a href="../pages/restaurant.php?id=<?=$restaurant['id']?>"><button class="btn" id="btn-details">Ver detalhes</button></a>
                </div>
            </article>
        <?php } ?>
    </div>
</section>
