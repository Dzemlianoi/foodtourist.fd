<div class="container-fluid full-cat" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="col-md-2 container filter-cat inline">
        <div class="row">
<!--            Прайс-фильтр-->
            <div class="price-filter filter-block for-submit">
                <span class="filter-name">Цена</span>
                <form method="get" name="filter" action="categories.php">
                    <div id="price">
                    </div>
                    <div class="price-controllers">
                        <input type="text" class="fil-from-to" name="min" id="value-min"/>
                        <input type="text" class="fil-from-to" name="max" id="value-max"/>
                    </div>
            </div>
            <?php echo get_filters_by_cat_id() ?>

        </div>
    </div>
    <div class="col-md-8 catalog container  inline">
        <div class="row catalog-cat-name ">
             <span class="cat-name-filter">Пицца</span>
             <span class="numb-goods">(32 товара)</span>
        </div>
        <div class="cat-fil-schema container">
            <div class="inline type-show-box type-chosen">
                <span class="show-filters">Показать:</span>
                <select class="form-control choose-filter">
                    <option>От самых дорогих к самым дешевым</option>
                    <option>От самых дешевых к самым дорогим</option>
                    <option>По названию</option>
                    <option>Только акции</option>
                    <option>Только новинки</option>
                </select>
            </div>
            <div class="inline type-show-box type-t-or-l">
                <span class="type-list">Отображать:</span>
                <label for="type-of-show1">Листом</label>
                <input type ="radio" id="type-of-show1" name="type-of-show" value="list" checked>
                <label for="type-of-show1">Плиткой</label>
                <input type ="radio" id="type-of-show2" name="type-of-show" value="table">
                <input type="hidden" name="category" value="<?php echo $_GET['category'] ?>">
            </div>
            <input type='submit' class='submit-filter' value='Фильтр'><br/>
            </form>;
        </div>
    </div>
    <div class="goods-cat container">
        <?php echo get_goods_from_cat(ALL_GOODS_FROM_CAT) ?>
</div>





