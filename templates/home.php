<section class = "central">
    <div class="container">
        <?php foreach($restaurants as $restaurant) { ?>
            <article class="listrestaurant box">
                <div class="restaurantphoto">
                    <img src="../res/images/restaurants/restaurant1.png">
                </div>
                <div class= "content">
                    <a href="../pages/restaurant.php?id=<?=$restaurant['id']?>"><h3><?=$restaurant['name']?></h3></a>
                    <div class="rating">
                        <?php for ($i = 0; $i < intval($restaurant['reviewersRating']); $i++){ ?>
                            <img src="../res/images/star.png">
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