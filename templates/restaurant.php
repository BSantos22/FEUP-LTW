<section class="central">
    <div class="container">
        <section class="viewrestaurantphoto">
            <img src="../res/images/restaurants/restaurant1.png">
        </section>
        <section class="contentRestaurant">
            <h4><?= $restaurant['name'] ?></h4><br>
            <p>Localidade: <?= $restaurant['city'] ?></p><br><br>
            <h4>Opiniões <?=sizeof($reviews)?></h4><br><br>
            <?php foreach ($reviews as $review) { ?>
                <article>
                    <h4><?= $review['idReviewer'] ?></h4><br>
                    <p>Avaliação: <?= $review['rating'] ?></p><br>
                    <p>Opinião: <?= $review['text'] ?></p>
                </article>
            <?php } ?>
        </section>
    </div>
</section>