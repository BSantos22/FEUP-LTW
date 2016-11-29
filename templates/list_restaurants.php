<section class = "central">
    <div class="container">
        <?php $restaurants = getAllRestaurants();
        foreach( $restaurants as $restaurant) { ?>
            <article>
                <div class="restaurantphoto">
                    <img src="res/images/restaurants/restaurant1.png">
                </div>
                <div class= "content">
                    <h3><?=$restaurant['name']?></h3><br>
                    <p><?=$restaurant['city']?></p><br><br>
                    <p>Restaurante muito bom! Recomendo-o vivamente!</p>
                </div>
            </article>
        <?php } ?>
        <!-- APAGAR -->
            <article>
                <div class="restaurantphoto">
                    <img src="res/images/restaurants/restaurant1.png">
                </div>
                <div class= "content">
                    <h3><?=$restaurant['name']?></h3>
                    <p><?=$restaurant['city']?></p>
                    <p>Restaurante muito bom! Recomendo-o vivamente!</p>
                </div>
            </article>
    </div>
</section>
