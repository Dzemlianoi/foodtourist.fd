<div class="container-fluid footer">
    <div class="row fix-head">
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-2 no-border-right">
                <span class="footer-cathegory">Сайт</span>
                <a class="footer-record" href="#">Меню</a>
                <a class="footer-record" href="#">Доставка и оплата</a>
                <a class="footer-record" href="#">Контакты</a>
            </div>
            <div class="col-md-2">
                <span class="footer-cathegory">Блюда</span>
                <a class="footer-record" href="#">Пицца</a>
                <a class="footer-record" href="#">Суши</a>
                <a class="footer-record" href="#">Бургеры</a>
                <a class="footer-record" href="#">Салаты</a>
                <a class="footer-record" href="#">Супы</a>
                <a class="footer-record" href="#">Напитки</a>
            </div>
            <div class="col-md-2">
                <span class="footer-cathegory">Пользователь</span>
                <a class="footer-record" href="#">Вход</a>
                <a class="footer-record" href="#">Регистрации</a>
                <a class="footer-record" href="#">Обратная связь</a>
            </div>
            <div class="col-md-2">
                <span class="footer-cathegory">Контакты</span>
                <a class="footer-record" href="#"><i class="fa fa-mobile-phone fa-2x"></i>063 741-41-41</a>
                <a class="footer-record" href="#"><i class="fa fa-skype fa-2x"></i>denis_de_wind</a>
                <a class="footer-record" href="#"><i class="fa fa-mail-reply fa-2x"></i>dzemlianoi@gmail.com</a>
            </div>
            <div class="col-md-2"></div>
        </div>
        <hr>
        <div class="col-md-10 copy">© Интернет-магазин «Foodtourist» 2016</div>
    </div>
</div>

<script src="../js/jquery/jquery-2.2.0.js"></script>
<script src="../js/nouislider.js"></script>
<script src="../js/bootstrap/bootstrap.js"></script>
<script src="../js/owl/owl.carousel-2.0.js"></script>
<script src="../js/js.js"></script>
<script>
var slider = document.getElementById('price');

noUiSlider.create(slider, {
start: [<?php echo set_min_price() ?>, <?php echo set_max_price() ?>],
connect: true,
range: {
'min': <?php echo get_max_or_min_price_by_current_cat(MIN_PRICE_FROM_CATS)?>,
'max': <?php echo get_max_or_min_price_by_current_cat(MAX_PRICE_FROM_CATS) ?>
}
});
var valueInput = document.getElementById('value-min'),
valueMax = document.getElementById('value-max');

// When the slider value changes, update the input and span
slider.noUiSlider.on('update', function( values, handle ) {
if ( handle ) {
valueMax.value = values[handle];
} else {
valueInput.value = values[handle];
}
});

// When the input changes, set the slider value
valueInput.addEventListener('change', function(){
slider.noUiSlider.set([null, this.value]);
});
valueMax.addEventListener('change', function(){
slider.noUiSlider.set([null, this.value]);
});
</script>


</body>
</html>