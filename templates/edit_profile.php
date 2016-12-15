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
        <article id="editprofile">
            <div class="sectiondescription">
                <h3>Informação de conta<h3>
            </div>
            <article id="editprofileform" class="box">
                <form action="../actions/action_edit_profile.php" method="post">
                    <table>
                        <tr>
                            <td class="table-title">Nome completo</td>
                        </tr>
                        <tr>
                            <td><input type="text" value="<?= $user['name'] ?>" name="name" required id="edit-user-name"></td>
                        </tr>
                        <tr>
                            <td class="table-title">Data de nascimento</td>
                        </tr>
                        <tr>
                            <td><input type="date" value="<?= $user['birthday'] ?>" name="birthday" required id="edit-user-date"></td>
                        </tr>
                        <tr>
                            <td class="table-title">E-mail</td>
                        </tr>
                        <tr>
                            <input type="hidden" id="logged-user-email" value="<?= $user['email'] ?>" />
                            <td><input type="email" value="<?= $user['email'] ?>" name="email" required  id="edit-user-email"></td>
                        </tr>
                        <tr>
                            <td class="table-title">Cidade</td>
                        </tr>
                        <tr>
                            <td><input type="text" value="<?= $user['city'] ?>" name="city" required id="edit-user-city"></td>
                        </tr>
                        <tr>
                            <td class="table-title">País</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" id="logged-user-country" value="<?= $user['country'] ?>" />
                                <select name="country" class="country" required id="edit-user-country">
                                    <option value="" disabled selected hidden>País</option>
                                    <?php
                                    require('../templates/countries.php');
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-title">Nova password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="newpassword" value="" id="edit-user-new-pass"></td>
                        </tr>
                        <tr>
                            <td class="table-title">Confirmar nova password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="confirmnewpassword" value="" id="edit-user-new-pass2"></td>
                        </tr>
                        <tr>
                            <td class="table-title">Confirmar password atual</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="currentpassword" value="" required id="edit-user-old-pass"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" id="subeditprofile" class="btn" disabled="false" name="submiteditprofile"></td>
                        </tr>
                    </table>
                </form>
            </article>
        </article>
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
