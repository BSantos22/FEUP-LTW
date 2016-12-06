<section class="central">
    <div class="container">
        <section class="viewrestaurantphoto">
            <img src="../res/images/restaurants/restaurant1.png">
        </section>
        <section class="contentRestaurant">
            <h4><?= $restaurant['name'] ?></h4><br>
            <p>Localidade: <?= $restaurant['city'] ?></p>
            <p>Categoria: <?= $restaurant['category']?></p>
            <div id="price">
                <?php for ($i = 0; $i < intval($restaurant['price']); $i++){ ?>
                    <img src="../res/images/money.png">
                <?php } ?>
            </div>
            <p>Horário: aberto das <?= $restaurant['open']?> às <?= $restaurant['close']?></p>
            <br><br>
            <h4>Opiniões (<?=sizeof($reviews)?>)</h4><br>
            <?php foreach ($reviews as $review) { ?>
                <article class="review">
                    <h4><?= $review['idReviewer'] ?></h4><br>
                    <p>Avaliação: <?=$review['rating']?>
                    <div id="rating">
                        <?php for ($i = 0; $i < intval($review['rating']); $i++){ ?>
                            <img src="../res/images/star.png">
                        <?php } ?>
                    </div>
                    <p>Opinião: <?= $review['text'] ?></p>
                </article>
            <?php } ?>
        </section>

        <section class="createreview">
            <hr>
            <br>
            <p>Criar opinião</p>
            <form action="../actions/create_review.php" method="post" id="editRestaurant">
                <input type="hidden" name="idUsername" value="<?=$_SESSION['username']?>">
                <input type="hidden" name="idRestaurant" value="<?=$restaurant['id']?>">
                <label>Classificação:
                    <input type="number" name="rating" value="" required="required">
                </label>
                <br><br>
                <label>Opinião:
                    <textarea rows="4" cols="100" name="text" value="">
                    </textarea>
                </label>

                <input type="submit" name="btnSubmit" value="Enviar">
            </form>
        </section>
    </div>
</section>
