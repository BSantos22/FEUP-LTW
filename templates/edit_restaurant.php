<section class="central">
    <div class="container">
        <article id="editrestaurant">
            <div class="sectiondescription">
                <h3>Editar restaurante<h3>
            </div>
            <article id="editrestaurantform" class="box">
                <form action="../actions/action_edit_restaurant.php" method="post">
                    <table>
                        <tr>
                            <td class="table-title">Nome</td>
                        </tr>
                        <tr>
                            <td><input type="text" id="edit-rest-name" name="name" value="<?=$restaurant['name']?>" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Rua</td>
                        </tr>
                        <tr>
                            <td><input type="text" id="edit-rest-street" name="street" value="<?=$restaurant['street']?>" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Código Postal</td>
                        </tr>
                        <tr>
                            <td><input type="text" id="edit-rest-pc" name="zipcode" value="<?=$restaurant['zipcode']?>" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Cidade</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="city" value="<?=$restaurant['city']?>" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">País</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="country" value="<?=$restaurant['country']?>" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Categoria</td>
                        </tr>
                        <tr>
                            <td><select name="category" required>
                                    <option value="Contemporâneo">Contemporâneo</option>
                                    <option value="Tradicional">Tradicional</option>
                                    <option value="Mediterrâneo">Mediterrâneo</option>
                                    <option value="Mexicana">Mexicana</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Comida saudável">Comida saudável</option>
                                    <option value="Pizza">Pizza</option>
                                    <option value="Italiana">Italiana</option>
                                    <option value="Hamburgueria">Hamburgueria</option>
                                    <option value="Grelhados">Grelhados</option>
                                    <option value="Bebidas">Bebidas</option>
                                    <option value="Petiscos">Petiscos</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td class="table-title">Preço</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="price" value="<?=$restaurant['price']?>" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Horário de abertura</td>
                        </tr>
                        <tr>
                            <td><input type="time" name="opentime" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Horário de fecho</td>
                        </tr>
                        <tr>
                            <td><input type="time" name="closetime" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Palavra-passe</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" required id="edit-rest-pass"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" class="btn" name="submiteditrestaurant" id="edit-rest-sbt"></td>
                        </tr>
                    </table>
                </form>
            </article>
        </article>
    </div>
</section>
