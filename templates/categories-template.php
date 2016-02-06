<div class="container-fluid full-cat" xmlns="http://www.w3.org/1999/html">
    <div class="col-md-2 container filter-cat">
        <div class="row">
<!--            Прайс-фильтр-->
            <div class="price-filter filter-block for-submit">
                <span class="filter-name">Цена</span>
                <form method="get" name="filter">
                    <div id="price">
                    </div>
                    <div class="price-controllers">
                        <input type="text" class="fil-from-to" name="min" id="value-min"/>
                        <input type="text" class="fil-from-to" name="max" id="value-max"/>
                    </div>
                    <input type="submit" class="accept-filter" value="Фильтр">
                </form>
            </div>
            <!--             Фильтр бокса-->
            <div class="filter-block box-filter for-submit">
                <span class="filter-name">Наличие упаковки</span>
                <form method="get" name="box">
                    <input type="checkbox" id="box1" value="1"> <label class="fil-name-chk"
                                                                       for="box1">Да</label><br/>
                    <input type="checkbox" id="box2" value="0"> <label class="last-fil-name-chk fil-name-chk"
                                                                       for="box2">Нет</label><br/>
                    <input type="submit" class="accept-filter" value="Фильтр">
                </form>
            </div>
            <!--            Фильтр соусов-->
            <div class="filter-block sous-filter for-submit">
                <span class="filter-name">Наличие соуса</span>
                    <input type="checkbox" id="sous1" value="1"> <label class="fil-name-chk"
                                                                       for="sous1">Да</label><br/>
                    <input type="checkbox" id="sous2" value="0"> <label class="last-fil-name-chk fil-name-chk"
                                                                       for="sous2">Нет</label><br/>
                    <input type="submit" class="accept-filter" value="Фильтр">
            </div>
            <!--            Фильтр бокса-->
            <div class="filter-block box-filter for-submit">
                <span class="filter-name">Вегетарианские</span>
                    <input type="checkbox" id="box1" value="1"> <label class="fil-name-chk"
                                                                       for="box1">Да</label><br/>
                    <input type="checkbox" id="box2" value="0"> <label class="last-fil-name-chk fil-name-chk"
                                                                       for="box2">Нет</label><br/>
            </div>
        </div>
    </div>
</div>


