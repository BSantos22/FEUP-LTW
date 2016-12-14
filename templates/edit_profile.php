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
                            <td><input type="text" value="<?= $user['name'] ?>" name="name" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Data de nascimento</td>
                        </tr>
                        <tr>
                            <td><input type="date" value="<?= $user['birthday'] ?>" name="birthday" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">E-mail</td>
                        </tr>
                        <tr>
                            <td><input type="email" value="<?= $user['email'] ?>" name="email" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Cidade</td>
                        </tr>
                        <tr>
                            <td><input type="text" value="<?= $user['city'] ?>" name="city" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">País</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="country" id="country-list" class="country" required>
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
                            <td><input type="password" name="newpassword" value=""></td>
                        </tr>
                        <tr>
                            <td class="table-title">Confirmar nova password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="confirmnewpassword" value=""></td>
                        </tr>
                        <tr>
                            <td class="table-title">Confirmar password atual</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="currentpassword" value="" required></td>
                        </tr>
                        <tr>
                            <td><input type="submit" id="subeditprofile" class="btn" name="submiteditprofile"></td>
                        </tr>
                    </table>
                </form>
            </article>
        </article>
    </div>
</section>