<!DOCTYPE html>
<html>
<head>
    <title>My Food Advisor</title>
    <link rel="shortcut icon" href="../res/images/logo.png">
    <meta name="description" content="O sitio da Web onde pode escolher o seu restaurante!"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link type="text/css" rel="stylesheet" href="../styles/style.css"/>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
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
                        <li>Entrar</li>
                        <li>Registar</li>
                        <li>Restaurantes</li>
                    </ul>
                </div>
                <div id="user">
                    <img src="../res/images/user.png">
                </div>
            </nav>
        </section>
    </section>

    <section id="backg">
        <div id="search">
            <p>Encontre os melhores restaurantes ao virar da esquina</p> <br><br>
            <input type="text" name="restaurant" value="" alt="Search Restaurants"
                   placeholder="Procura por restaurante..." id="searchbar"/>
            <input type="submit" value="Procurar" id="butt">
        </div>
    </section>

</header>