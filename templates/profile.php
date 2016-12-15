<section class="central">
    <div class="container">
        <article id="myprofile" class="box">
            <table>
                <tr>
                    <td id="td-image" class="img-col" rowspan="5"><img src="../uploads/users/<?= $user['photopath'] ?>"></td>
                </tr>
                <tr>
                    <td class="edit-col"><a href="#" alt="Editar foto de perfil"><i class="fa fa-pencil" aria-hidden="true" id="btn-uploaduserphoto"></i></a></td>
                    <td colspan="2" id="td-user"><h2><?= $user['name'] ?></h2></td>
                    <td class="edit-col">&nbsp;&nbsp;<a href="edit_profile.php" alt="Editar perfil"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="td-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                    <td class="td-info"><?= $user['city'] ?>&nbsp;&middot&nbsp;<?= $user['country'] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="td-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></td>
                    <td class="td-info"><?= $user['birthday'] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="td-icon"><i class="fa fa-envelope" aria-hidden="true"></i></td>
                    <td class="td-info"><?= $user['email'] ?></td>
                </tr>
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
                            <img src="../uploads/restaurants/defaultphoto.png">
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
                            <a href="../pages/edit_restaurant.php?id=<?= $restaurant['id'] ?>">
                                <button class="btn" id="btn-editrestaurant">Editar restaurante</button>
                            </a>
                        </div>
                    </article>
                <?php } ?>
            </section>
        <?php } ?>

        <?php if($user['status']=='reviewer'){ ?>
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

        <?php } else if ($user['status']=='owner'){ ?>
            <section class="myreplys">
                <div class="sectiondescription">
                    <h3>Minhas Respostas
                        <?php if (sizeof($replys) > 0) { ?>
                            <span class="number"><?= sizeof($replys) ?></span>
                        <?php } else { ?>
                            <span class="zero"><?= sizeof($replys) ?></span>
                        <?php } ?>
                    </h3>
                    <p>Relembre as suas respostas</p>
                </div>
                <?php foreach ($replys as $reply) { ?>
                    <article class="replyprofile box">

                        <h4><?= $reply['idReviewer'] ?></h4><br>
                        <div class="reviewdescription">
                            <div class="rating">
                                <?php for ($i = 0; $i < intval($reply['rating']); $i++) { ?>
                                    <img src="../res/images/star.png">
                                <?php } ?>
                            </div>
                            <br>
                            <br>
                            <p><?= $reply['text'] ?></p>
                        </div>




                        <a href="../pages/restaurant.php?id=<?=$reply['idRestaurant']?>"><button type="button" class="btn btn-sestaurant">Ver Restaurante</button></a>
                        <p><?= $reply['replyContent'] ?></p>
                    </article>
                <?php } ?>
            </section>
        <?php } ?>
    </div>
</section>

<!--UPLOAD USER PHOTO-->
<section id="modal-uploaduserphoto" class="modal">
    <form class="modal-content animate" action="../actions/upload_user_photo.php" method="post" enctype="multipart/form-data">
        <section class="imgcontainer">
            <img src="../res/images/logo.png">
            <span class="close" title="Fechar"><i class="fa fa-times" aria-hidden="true"></i></span>
        </section>

        <section class="container">
            Carregar imagem (Tamanho Máximo: 1 MB):<br>
            <input type="file" class="inputfile" name="userphoto" accept="image/*"><br><br>
            <input type="submit" class="btn btn-submitfile" name="uploaduserphoto" disabled>
        </section>

        <section class="cancelar-container">
            <button type="button" class="btn-cancel">Cancelar</button>
        </section>
    </form>
</section>