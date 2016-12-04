<section class = "central">
    <div class="container">
        <div id="verrestaunrates">
            <a href="list_restaurants.php"><h2>Ver Restaurantes</h2></a>
        </div>
        <?php foreach($restaurants as $restaurant) { ?>
            <article class="listrestaurant">
                <div class="restaurantphoto">
                    <img src="../res/images/restaurants/restaurant1.png">
                </div>
                <div class= "content">
                    <a href="../pages/restaurant.php?id=<?=$restaurant['id']?>"><h4><?=$restaurant['name']?></h4></a>
                    <br>
                    <p><?=$restaurant['city']?></p><br><br>
                </div>
            </article>
        <?php } ?>
    </div>
</section>