<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Служба доставки еды - Foodtourist</title>

    <link rel="stylesheet" href="../сss/bootstrap/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../сss/bootstrap/bootstrap-theme.css" type="text/css">
    <link rel="stylesheet" href="../сss/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="../сss/owl/owl.theme.default.css" type="text/css">
    <link rel="stylesheet" href="../сss/owl/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="../сss/owl/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="../сss/noUI/nouislider.css" type="text/css">
    <link rel="stylesheet" href="../сss/noUI/nouislider.pips.css" type="text/css">
    <link rel="stylesheet" href="../сss/noUI/nouislider.tooltips.css" type="text/css">
    <link rel="stylesheet" href="../сss/style.css" type="text/css">

</head>
<body>
    <?php include_once('functions.php') ?>
    <!--Верхняя полоска-->
    <div class="container-fluid header">
        <div class="row fix-head">
            <div class="col-md-6 left-head-bar">
                <a href="#" class="head-menu">О магазине</a>
                <a href="#" class="head-menu">Доставка и оплата</a>
                <a href="#" class="head-menu">Новости</a>
                <a href="#" class="head-menu">Контакты</a>
            </div>

            <div class="col-md-6 right-head-bar">
                <a class="log" href="#">Вход</a>
                <a class="log" href="#">Регистрация</a>
            </div>
        </div>
    </div>
    <!--Контактное меню-->

    <div class="container-fluid middlemenu">
        <div class="row fix-head">
            <a href="index.php"><div class="col-md-3 logo"><img width="90px" src="../images/logo.png"</div></a>

            </div>
            <div class="col-md-4">
                    <div class="col-md-6">
                        <i class="icon-contacts fa fa-mobile fa-4x"></i>
                        <div class="mob-phones">
                                <a class="telenumber" href="tel:+380985775757">098 577-57-57</a>
                                <span class="recall"><label for="recall"><i><b>Заказать
                                            звонок</b></i></label></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <i class="icon-contacts fa fa-clock-o fa-4x"></i>
                        <div class="mob-phones">
                            <span class="bold"><b>Пн-пт 9:00-20:00</b></span>
                            <span class="bold"><b>Сб-нд 10:00-19:00</b></span>
                        </div>
                    </div>
            </div>
            <div class="col-md-2 no-padding-left">
                <div class="recall-form">
                    <form class="form-inline">
                        <input type="text" name="recall" id="recall" class="input-sm inline" placeholder="xxx-xxx-xx-xx">
                        <button type="submit" class="fa fa-phone inline fa-2x recallimg"></button>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-warning marg-top-20">
                    <i class="fa fa-shopping-basket fa-2x basketimg inline"></i>
                    <span class="inline">Ваша корзина пуста</span>
                </button>
            </div>
        </div>
        <!--Меню-->
    </div>
    <div class="container-fluid navigation navbar-height">
        <div class="row fix-head navbar-height-100">
            <div class="navbar navbar-default navbar-height-100" id="navbar-main">
                <div class="container navbar-height-100">
                    <ul class="navbar-nav nav">
                        <?php echo(push_cathegories())  ?>
                     </ul>
                </div>
            </div>
        </div>
    </div>
        <!--Слайдер-->