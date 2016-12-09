<section class="central">
    <div class="container">
        <section class="contentRestaurant">
            <div class="restaurant box">
                <div class="viewrestaurantphoto">
                    <img src="../res/images/restaurants/restaurant1.png">
                </div>
                <div class="restaurantdescription">
                    <h2><?= $restaurant['name'] ?></h2>
                    <p><?= $restaurant['city'] ?> &middot <?= $restaurant['category']?></p><br>
                    <div class="rating">
                        <?php for ($i = 0; $i < intval($restaurant['reviewersRating']); $i++){ ?>
                            <img src="../res/images/star.png">
                        <?php } ?>
                    </div>
                    <p id="price">
                        <br>
                        <?php for ($i = 0; $i < intval($restaurant['price']); $i++){ ?>
                            $
                        <?php } ?>
                        <br>
                    </p>
                    <br><p>Hoje&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span id="opentime"><?= $restaurant['open']?> - <?= $restaurant['close']?>

                        <?php
                        $currentTime = date("h:i:sa");

                        if (strtotime($restaurant['open']) > strtotime($restaurant['close']))
                            $close = strtotime($restaurant['close'])+strtotime('+24 hours');
                        else
                            $close = strtotime($restaurant['close']);

                        if ((strtotime($currentTime) >= strtotime($restaurant['open'])) &&
                            (strtotime($currentTime) <= $close)) {
                            echo "<span id=\"open\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAberto agora </span>";
                        }

                        else
                            echo "<span id=\"close\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFechado agora </span>";
                        ?>
                        </span>
                    </p>
                </div>
            </div>

            <br><br>
            <h4>Opiniões (<?=sizeof($reviews)?>)</h4><br>
            <?php foreach ($reviews as $review) { ?>
                <article class="review box">
                    <h4><?= $review['idReviewer'] ?></h4><br>
                    <div class="rating">
                        <?php for ($i = 0; $i < intval($review['rating']); $i++){ ?>
                            <img src="../res/images/star.png">
                        <?php } ?>
                    </div>
                    <br>
                    <p><?= $review['text'] ?></p>
                </article>
            <?php } ?>
        </section>

        <section class="createreview">
            <br>
            <button type="button" id="btn-createreview" title="Criar avaliação">Criar avaliação</button>
            <form action="../actions/create_review.php" method="post" id="addreview">
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
                <input type="submit" id="btn-submit" class="btn" name="btnSubmit" value="Publicar">
            </form>
        </section>
    </div>
</section>
