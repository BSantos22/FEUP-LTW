<section class="central">
    <div class="container">
        <section class="contentRestaurant">
            <div class="restaurant box">
                <div class="restaurantgallery">
                    <ul class="bxslider">
                        <li><img src="../uploads/restaurants/restaurant1.png"/></li>
                        <li><img src="../uploads/restaurants/restaurant1.png"/></li>
                        <li><img src="../uploads/restaurants/restaurant1.png"/></li>
                        <li><img src="../uploads/restaurants/restaurant1.png"/></li>
                    </ul>
                </div>
                <div class="restaurantdescription">
                    <h2><?= $restaurant['name'] ?></h2>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;<?= $restaurant['city'] ?>
                        &middot <?= $restaurant['country'] ?></p><br>
                    <p><?= $restaurant['category'] ?></p><br>
                    <div class="rating">
                        <?php for ($i = 0; $i < intval($restaurant['reviewersRating']); $i++) { ?>
                            <img src="../res/images/star.png">
                        <?php } ?>
                    </div>
                    <p id="price">
                        <br>
                        <?php for ($i = 0; $i < intval($restaurant['price']); $i++) { ?>
                            $
                        <?php } ?>
                        <br>
                    </p>
                    <br>
                    <p>Hoje&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span id="opentime"><?= $restaurant['open'] ?>
                            - <?= $restaurant['close'] ?>

                            <?php
                            $currentTime = date("h:i:sa");

                            if (strtotime($restaurant['open']) > strtotime($restaurant['close']))
                                $close = strtotime($restaurant['close']) + strtotime('+24 hours');
                            else
                                $close = strtotime($restaurant['close']);

                            if ((strtotime($currentTime) >= strtotime($restaurant['open'])) &&
                                (strtotime($currentTime) <= $close)
                            ) {
                                echo "<span id=\"open\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAberto agora </span>";
                            } else
                                echo "<span id=\"close\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFechado agora </span>";
                            ?>
                        </span>
                    </p>
                    <div id="restaurantmap" class="gmap3"></div>
                </div>
            </div>

            <section id="addreviewphoto" class="box">
                <div id="restaurantbtns">
                    <div class="userimage">
                        <img src="../uploads/users/<?= $user['photopath'] ?>">
                    </div>
                    <?php if (!isset($_SESSION['username']) || $user['status'] == 'reviewer') { ?>
                        <button type="button" id="btn-createreview" class="btn" title="Criar avaliação">Criar avaliação
                        </button>
                    <?php } ?>
                    <button type="button" id="btn-addphoto" class="btn" title="Adicionar foto">Adicionar foto</button>
                </div>
                <form action="../actions/add_review.php" method="post" id="addreview">
                    <input type="hidden" name="idUsername" value="<?= $_SESSION['username'] ?>">
                    <input type="hidden" name="idRestaurant" value="<?= $restaurant['id'] ?>">
                    <section class="createreview">
                        <br>
                            <span class="rating">
                                <input type="radio" name="rating" class="rating-input" id="rating-input-1-5" value="5"/>
                                <label for="rating-input-1-5" class="rating-star"></label>
                                <input type="radio" name="rating" class="rating-input" id="rating-input-1-4" value="4"/>
                                <label for="rating-input-1-4" class="rating-star"></label>
                                <input type="radio" name="rating" class="rating-input" id="rating-input-1-3" value="3"/>
                                <label for="rating-input-1-3" class="rating-star"></label>
                                <input type="radio" name="rating" class="rating-input" id="rating-input-1-2" value="2"/>
                                <label for="rating-input-1-2" class="rating-star"></label>
                                <input type="radio" name="rating" class="rating-input" id="rating-input-1-1" value="1"/>
                                <label for="rating-input-1-1" class="rating-star"></label>
                            </span>
                        <br><br>
                        <label>Opinião:<br>
                            <textarea rows="4" cols="100" name="text" value=""></textarea>
                        </label><br>
                        <input type="submit" id="#btn-createreview" id="btn-submit" class="btn" name="btnSubmit" value="Publicar">
                    </section>
                </form>
            </section>

            <section class="restaurantreview">
                <div class="sectiondescription">
                    <h3>Avaliações
                        <?php if (sizeof($reviews) > 0) { ?>
                            <span class="number"><?= sizeof($reviews) ?></span>
                        <?php } else { ?>
                            <span class="zero"><?= sizeof($reviews) ?></span>
                        <?php } ?>
                    </h3>
                </div>
                <?php foreach ($reviews as $review) { ?>
                    <article class="review box">
                        <h4><?= $review['idReviewer'] ?></h4><br>
                        <div class="rating">
                            <?php for ($i = 0; $i < intval($review['rating']); $i++) { ?>
                                <img src="../res/images/star.png">
                            <?php } ?>
                        </div>
                        <br>
                        <p><?= $review['text'] ?></p>
                    </article>
                <?php } ?>
            </section>
        </section>
    </div>
</section>
