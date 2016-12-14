<section class="central">
    <div class="container">
        <article id="addrestaurant">
            <div class="sectiondescription">
                <h3>Adicionar novo restaurante<h3>
            </div>
            <article id="addrestaurantform" class="box">
                <form action="../actions/action_add_restaurant.php" method="post">
                    <table>
                        <tr>
                            <td class="table-title">Nome</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Rua</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="address" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Código Postal</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="zipcode" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">Cidade</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="city" required></td>
                        </tr>
                        <tr>
                            <td class="table-title">País</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="country" required></td>
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
                            <td><input type="number" name="price" required></td>
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
                            <td><input type="submit" class="btn" name="submitaddrestaurant"</td>
                        </tr>
                    </table>
                </form>
            </article>
        </article>
    </div>
</section>