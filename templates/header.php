<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>My Food Advisor</title>
    <link rel="shortcut icon" href="../res/images/logo.png">
    <meta name="description" content="O sitio da Web onde pode escolher o seu restaurante!"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link type="text/css" rel="stylesheet" href="../styles/style.css"/>
    <link type="text/css" rel="stylesheet" href="<?=$cssStyle?>"/>
    <link type="text/css" rel="stylesheet" href="../styles/modalstyle.css"/>
    <link type="text/css" rel="stylesheet" href="../styles/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="../styles/font-awesome.min.css"/>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLmVqAaxaE-M76Om97S-PXC4n4U3yJe6g"></script>
    <script type="text/javascript" src="../libs/gmap3.js"></script>
    <script type="text/javascript" src="../scripts/script.js"></script>
</head>
<body>
<header>
    <section class="backHeader">
        <section class="pageHeader">
            <nav>
                <div id="logo">
                    <a href="home.php"><img src="../res/images/logoheader.png">
                        <div id="texto"><p>My Food Advisor</p></div>
                    </a>
                </div>
                <div id="menu">
                    <ul>
                        <li class="header-button"><a href="home.php">Inicio</a></li>
                        <li class="header-button"><a href="list_restaurants.php">Restaurantes</a></li>
                    </ul>
                </div>
                <?php if(isset($_SESSION['username'])){
                    if($user['status']=='owner'){?>
                        <div id="user" class="dropdown">
                            <button type="button" id="btn-user" title="Entrar/Registar"><img src="../res/images/user.png"></button>
                            <div class="menu-dropdown">
                                <a href="profile.php" id="btn-profile" class="arrow_box"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Perfil</a>
                                <a href="../actions/action_logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Sair</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div id="user" class="dropdown">
                            <button type="button" id="btn-user" title="Entrar/Registar"><img src="../res/images/user.png"></button>
                            <div class="menu-dropdown">
                                <a href="profile.php" id="btn-profile" class="arrow_box"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Perfil</a>
                                <a href="../actions/action_logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Sair</a>
                            </div>
                        </div>
                 <?php }} else { ?>
                    <div id="user" class="dropdown">
                        <button type="button" id="btn-user" title="Entrar/Registar"><img src="../res/images/user.png"></button>
                        <div class="menu-dropdown">
                            <a href="#" id="btn-login" class="arrow_box"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Entrar</a>
                            <a href="#" id="btn-register"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Registar</a>
                        </div>
                    </div>
                <?php } ?>
            </nav>
        </section>
    </section>

    <section id="backg">
        <div id="search">
            <p>Encontre os melhores restaurantes ao virar da esquina</p> <br><br>
            <form class="search-restaurants" action="list_restaurants.php" method="get" autocomplete="off">
                <input type="text" name="search" value="" alt="Search Restaurants" placeholder="Procura por restaurante..." id="searchbar"/>
                <input type="submit" value="Procurar" id="butt-search">
            </form>
        </div>
    </section>
</header>

<section id="modal-login" class="modal">
    <form class="modal-content animate" action="../actions/action_login.php" method="post" autocomplete="off">
        <section class="imgcontainer">
            <img src="../res/images/logo.png">
            <span class="close" title="Fechar"><i class="fa fa-times" aria-hidden="true"></i></span>
        </section>

        <section class="container">
            <input type="text" name="username" placeholder="Nome do Utilizador/E-Mail" required>

            <input type="password" name="password" placeholder="Password" required>

            <button class="enter" type="submit">Entrar</button>
            <input type="checkbox" checked="checked"> Lembrar-me
        </section>

        <section class="cancelar-container">
            <button type="button" class="btn-cancel">Cancelar</button>
            <span class="psw">Esqueceu-se da <a href="#">palavra-passe?</a></span>
        </section>
    </form>
</section>

<section id="modal-register" class="modal">
    <form class="modal-content animate" action="../actions/action_register.php" method="post" autocomplete="off">
        <section class="imgcontainer">
            <img src="../res/images/logo.png">
            <span class="close" title="Fechar"><i class="fa fa-times" aria-hidden="true"></i></span>
        </section>

        <section class="container">
            <input type="text" name="username" placeholder="Nome do Utilizador" required>

            <input type="text" name="name" placeholder="Nome" required>

            <input type="text" name="email" placeholder="E-Mail" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="password" name="password" placeholder="Confirme a password" required>

            <input type="date" name="birthday" placeholder="Data de Nascimento" required>

            <input type="text" name="city" placeholder="Cidade" required>

            <input type="text" name="country" placeholder="País" required>

            <select name="user_type" placeholder="Tipo de Utilizador" required>
              <option value="owner">Proprietário</option>
              <option value="reviewer">Cliente</option>
            </select>


            <button class="enter" type="submit" name="submit" value="user">Registar</button>

            <!-- div class="btns-register">
                <button class="btn-register-user" type="submit" name="submit" value="user">Registar como Utilizador</button>
                <button class="btn-register-owner" type="submit" name="submit" value="owner">Registar como Proprietário</button>
            </div --->

            <input type="checkbox" checked="checked"> Lembrar-me
        </section>

        <section class="cancelar-container">
            <button type="button" class="btn-cancel">Cancelar</button>
        </section>
    </form>
</section>
