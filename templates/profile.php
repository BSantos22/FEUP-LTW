<section class="central">
    <div class="container">
        <article id="myprofile" class="box">
            <table>
                <tr>
                    <td id="td-image" class="img-col" rowspan="5"><img src="../uploads/users/<?= $user['photopath'] ?>">
                    </td>
                </tr>
                <tr>
                    <td class="edit-col"><a href="#" alt="Editar foto de perfil"><i class="fa fa-pencil"
                                                                                    aria-hidden="true"
                                                                                    id="btn-uploaduserphoto"></i></a>
                    </td>
                    <td colspan="2" id="td-user"><h2><?= $user['name'] ?></h2></td>
                    <td class="edit-col">&nbsp;&nbsp;<a href="edit_profile.php" alt="Editar perfil"><i
                                class="fa fa-pencil" aria-hidden="true"></i></a></td>
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
                            <img src="../uploads/restaurants/<?=$restaurant['restaurantphoto']?>">
                        </div>
                        <div class="content">
                            <a href="../pages/restaurant.php?id=<?= $restaurant['id'] ?>">
                                <h3><?= $restaurant['name'] ?></h3></a>
                            <div class="rating">
                                <?php for ($i = 0; $i < round($restaurant['reviewersRating']); $i++){ ?>
                                    <img src="../res/images/star.png">
                                <?php } for ($j = 0; $j < 5-round($restaurant['reviewersRating']); $j++){ ?>
                                    <img src="../res/images/emptystar.png">
                                <?php } ?>
                            </div>
                            <br>
                            <p><?= $restaurant['city'] ?>&middot<?= $restaurant['country'] ?></p><br>

                                <button class="btn" id="btn-editrestaurantphoto">Editar foto</button>

                            <a href="../pages/restaurant.php?id=<?= $restaurant['id'] ?>">
                                <button class="btn" id="btn-details">Ver detalhes</button>
                            </a>
                            <a href="../pages/edit_restaurant.php?id=<?= $restaurant['id'] ?>">
                                <button class="btn" id="btn-editrestaurant">Editar restaurante</button>
                            </a>
                        </div>


                        <!--UPLOAD RESTAURANT PHOTO-->
                        <section id="modal-uploadrestaurantprofilephoto" class="modal">
                            <form class="modal-content animate" action="../actions/upload_restaurant_profilephoto.php" method="post"
                                  enctype="multipart/form-data">
                                <section class="imgcontainer">
                                    <img src="../res/images/logo.png">
                                    <span class="close" title="Fechar"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </section>

                                <section class="container">
                                    Carregar imagem (Tamanho Máximo: 1 MB):<br>
                                    <input type="hidden" name="idRestaurant" value="<?= $restaurant['id'] ?>">
                                    <input type="file" class="inputfile" name="restaurantphoto" accept="image/*">
                                    <input type="submit" class="btn btn-submitfile" name="uploadrestaurantphoto" disabled>
                                </section>

                                <section class="cancelar-container">
                                    <button type="button" class="btn-cancel">Cancelar</button>
                                </section>
                            </form>
                        </section>


                    </article>
                <?php } ?>
            </section>
        <?php } ?>

        <?php if ($user['status'] == 'reviewer') { ?>
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
                        <table>
                            <tr>
                                <td rowspan="2" class="userreviewid">
                                    <div class="reviewuserimage">
                                        <img src="../uploads/users/<?= $review['reviewerphotopath'] ?>">
                                    </div>
                                    <h4><?= $review['idReviewer'] ?></h4>
                                </td>
                                <td colspan="2">
                                    <a href="../pages/restaurant.php?id=<?=$review['idRestaurant']?>"><h3><?=$review['restaurantname']?></h3></a><br>
                                    <div class="rating">
                                        <?php for ($i = 0; $i < round($review['rating']); $i++){ ?>
                                            <img src="../res/images/star.png">
                                        <?php } for ($j = 0; $j < 5-round($review['rating']); $j++){ ?>
                                            <img src="../res/images/emptystar.png">
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="comment"><p><?= $review['text'] ?></p></td>
                            </tr>

                            <?php if ($review['idOwner'] != null) { ?>
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="replyrow userreviewid">
                                        <div class="reviewuserimage">
                                            <img src="../uploads/users/<?= $review['ownerphotopath'] ?>">
                                        </div>
                                        <h4><?= $review['idOwner'] ?></h4>
                                        <div class="btn btnowner">Proprietário</div>
                                    </td>
                                    <td class="comment replyrow replycontent">
                                        <p><?= $review['replyContent'] ?></p>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </article>
                <?php } ?>
            </section>

        <?php } else if ($user['status'] == 'owner') { ?>
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
                        <table>
                            <tr>
                                <td rowspan="2" class="userreviewid">
                                    <div class="userimage">
                                        <img src="../uploads/users/<?= $reply['userphotopath'] ?>">
                                    </div>
                                    <h4><?= $reply['idReviewer'] ?></h4>
                                </td>
                                <td colspan="2">
                                    <a href="../pages/restaurant.php?id=<?=$reply['idRestaurant']?>"><h3><?=$reply['restaurantname']?></h3></a><br>
                                    <div class="rating">
                                        <?php for ($i = 0; $i < round($reply['rating']); $i++){ ?>
                                            <img src="../res/images/star.png">
                                        <?php } for ($j = 0; $j < 5-round($reply['rating']); $j++){ ?>
                                            <img src="../res/images/emptystar.png">
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="comment"><p><?= $reply['text'] ?></p></td>
                            </tr>
                            <tr>
                                <td rowspan="2"></td>
                                <td class="replyrow userreviewid">
                                    <div class="userimage">
                                        <img src="../uploads/users/<?= $user['photopath'] ?>">
                                    </div>
                                    <h4><?= $user['username'] ?></h4>
                                    <div class="btn btnowner">Proprietário</div>
                                </td>
                                <td class="comment replyrow replycontent">
                                    <p><?= $reply['replyContent'] ?></p>
                                </td>
                            </tr>
                        </table>
                    </article>
                <?php } ?>
            </section>
        <?php } ?>
    </div>
</section>

<!--UPLOAD USER PHOTO-->
<section id="modal-uploaduserphoto" class="modal">
    <form class="modal-content animate" action="../actions/upload_user_photo.php" method="post"
          enctype="multipart/form-data">
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

