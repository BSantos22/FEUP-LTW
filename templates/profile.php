<section class="central">
    <div class="container">
        <article id="myprofile" class="box">
            <table>
                <tr>
                    <td id="td-image" class="img-col" rowspan="5"><img src="../uploads/users/<?=$user['photopath']?>"></td>
                </tr>
                <tr>
                    <td colspan="2" id="td-user"><h2><?= $user['name'] ?></h2></td>
                    <h2>
                </tr>
                <tr>
                    <td class="td-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                    <td class="td-info"><?= $user['city'] ?>&nbsp;&middot&nbsp;<?= $user['country'] ?></td>
                </tr>
                <tr>
                    <td class="td-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></td>
                    <td class="td-info"><?= $user['birthday'] ?></td>
                </tr>
                <tr>
                    <td class="td-icon"><i class="fa fa-envelope" aria-hidden="true"></i></td>
                    <td class="td-info"><?= $user['email'] ?></td>
                </tr>
                <tr style="text-align: center">
                    <td class="img-col"><button type="button" id="btn-uploaduserphoto" class="btn" title="Editar foto de perfil">Editar foto</button></td>
                    <td></td><td></td></tr>

            </table>

        </article>

        <?php if ($user['status'] == 'owner') { ?>
            <section class="myrestaurants">
                <div class="sectiondescription">
                    <h3>Meus Restaurantes
                        <?php if (sizeof($restaurants) > 0) { ?>
                            <span class="number"><?= sizeof($restaurants) ?></span>
                        <?php } else { ?>
                            <span class="zero"><?= sizeof($restaurants) ?></span>
                        <?php } ?>
                    </h3>
                    <p>Faça a gestão dos seus restaurantes de modo a melhorar as suas avaliações</p>
                </div>
                <?php foreach ($restaurants as $restaurant) { ?>
                    <article class="listrestaurant box">
                        <div class="restaurantphoto">
                            <img src="../uploads/restaurants/restaurant1.png">
                        </div>
                        <div class="content">
                            <a href="../pages/restaurant.php?id=<?= $restaurant['id'] ?>">
                                <h3><?= $restaurant['name'] ?></h3></a>
                            <div class="rating">
                                <?php for ($i = 0; $i < intval($restaurant['reviewersRating']); $i++) { ?>
                                    <img src="../res/images/star.png">
                                <?php } ?>
                            </div>
                            <br>
                            <p><?= $restaurant['city'] ?>&middot<?= $restaurant['country'] ?></p><br>
                            <a href="../pages/restaurant.php?id=<?= $restaurant['id'] ?>">
                                <button class="btn" id="btn-details">Ver detalhes</button>
                            </a>
                        </div>
                    </article>
                <?php } ?>
            </section>
        <?php } ?>

        <section class="myreviews">
            <div class="sectiondescription">
                <h3>Minhas Avaliações
                    <?php if (sizeof($reviews) > 0) { ?>
                        <span class="number"><?= sizeof($reviews) ?></span>
                    <?php } else { ?>
                        <span class="zero"><?= sizeof($reviews) ?></span>
                    <?php } ?>
                </h3>
                <p>Relembre as suas avaliações</p>
            </div>
            <?php foreach ($reviews as $review) { ?>
                <article class="review box">
                    <a href="../pages/restaurant.php?id=<?= $review['restaurantid'] ?>">
                        <h4><?= $review['restaurantname'] ?></h4></a><br>
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
    </div>
</section>