<section class = "central">
    <div class="container">
        <?php foreach($restaurants as $restaurant) { ?>
            <article class="listrestaurant box">
                <div class="restaurantphoto">
                    <img src="../uploads/restaurants/defaultphoto.png">

                    <!--
                    <?php if (sizeof($restaurantPhotos) > 0) { ?>
                    <div class="restaurantgallery">
                        <ul class="bxslider">
                            <?php foreach ($restaurantPhotos as $restaurantPhoto) { ?>
                                <li><img src="../uploads/restaurants/<?= $restaurantPhoto['name'] ?>"/></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                    -->
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