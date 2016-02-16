<?php
include_once ('config.php');
$db_connect=NULL;

//Достаем базу
function get_db(){
    if (empty($db_connect)){
        $db_connect= mysqli_connect(HOST, USER_DB, PASS_DB, DB_NAME);
    }
    return $db_connect;
}
//Устанавливаем кодировку
function set_mains(){
    $db=get_db();
        if ($db) {
            //charset-----------------------------------
            mysqli_query($db, "SET NAMES 'utf8'");
            mysqli_query($db, "SET CHARACTER SET 'utf8'");
            mysqli_query($db, "SET SESSION collation_connection = 'utf8_general_ci'");
            //------------------------------------------
        }
    return $db;

}
//Достаем нужные данные и пушим их в массив
function get_data($query) {
    $db=set_mains();
    $result = mysqli_query($db, $query);
    if ($result) {
        $data_array = array();
        while ($data = mysqli_fetch_assoc($result)) {
            array_push($data_array, $data);
        }
    } else {
        exit("can't get data");
    }
    mysqli_close($db);
    return $data_array;
}

//Выводим категории
function push_cathegories(){

    foreach(get_data(ALL_CATEGORIES) as $cat){
            $selector='';
            if($_GET['category']===$cat['id']){
                $selector=' active-cathegory';
                $cat['name'];
        };
        $push_categories.=
            '<li class="col-md-2'.$selector.'">
                <a href="/categories.php?category=' .$cat['id'].'">' .$cat['name'] .'
                </a>
            </li>';
    }
    return $push_categories;
}
//Выводим хот предложения или новинки
function push_hots_or_newings($TYPE, $text){
    foreach(get_data($TYPE) as $hot){
        $push_hot.='<div class="special-element">
            <div class="'.$text.'"></div>
            <img class="special-image" src="../images/goods/'.$hot["picture_name"].'" alt=""/>
            <div class="name-box">
                <span class="name">'.$hot["name"].'</span>
            </div>
            <span class="price">'.$hot["price"].' грн</span>
            <form id="'.$hot["id"].'" method="post">
                <input type="number" value=0 name="quantity">
                <input type="submit" value="Заказать">
            </form>
        </div>';
    }
    return $push_hot;
}

//Получить данные определенного параметра из адресного строки
function get_request_param($param){
    if ((isset($_GET[$param]))&&(!empty($_GET[$param]))){
        return $_GET[$param];
    }else{
        return false;
    }
}

//Получить категорию забирая id из УРЛа
function get_current_cat_name(){
    $cat_id=get_request_param('category');
    if ($cat_id){
        foreach (get_data(ALL_CATEGORIES) as $cat){
            if ($cat['id']===$cat_id){
                return $cat['name'];
                break;
            }
        }
        return 'Текущей категории нет';
    }
    return 'Не выбрана категория или категории не существует';

}

//Взять название подключаемого файла
function recognize_php_file_by_url(){
    $server_path=pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME);
    return $server_path;
}
//В зависимости от введеннго адреса пушим бредкрамбс
function breadcrumbs_push(){
    $param=recognize_php_file_by_url();
    switch ($param){
        case 'categories':
            $push_bread='
            <a href="index.php">
                <span class="post-bread marg-r-10">Главная </span>
            </a>
                <span class="line-bread marg-r-10">→</span>
                <span class="chosen-bread marg-r-10">'.get_current_cat_name().'</span>';
            break;
    }
    echo $push_bread;


}
//Выбираем фильтры по категории
function get_filters_by_cat_id(){
    $cat_id=get_request_param('category');
    return $filter_array=get_data(SELECT_FILTER_BY_CAT_ID.' '.$cat_id);

}
//Пушим фильтры в фильтр-бокс
function push_filter_of_cat(){
    $push_filters='';
    foreach(get_filters_by_cat_id() as $filter){
        $var=checked($filter['param_url']);
        $novar=checked('no'.$filter['param_url']);
        $push_filters.=<<<HOM
            <div class="filter-block box-filter for-submit">
                <span class="filter-name">${filter['name']}</span>
                <input type="checkbox" id="${filter['param_url']}1}" $var name="${filter['param_url']}" value="1">
                <label class="fil-name-chk" for="${filter['param_url']}2">Да</label>
                <br/>
                <input type="checkbox" id="${filter['param_url']}2" $novar name="no${filter['param_url']}" value="1">
                <label class="fil-name-chk" for="${filter['param_url']}2">Нет</label>
                <br/>
            </div>
HOM;
    }
    $push_filters.="<input type='submit' class='submit-filter' name='filters' value='Фильтр'>";
    return $push_filters;
}
//Получение максимальной и минимальной цены категории, через ГЕТ
function get_max_or_min_price_by_current_cat($param){
    $cat_id = get_request_param('category');
    $price=get_data($param.$cat_id);
    foreach($price as $out=>$in){
        foreach ($in as $id=>$cost) {
            $result=$cost;
        }
    }

    return intval($cost);
}

function get_goods_from_cat($param)
{
    $cat_id = get_request_param('category');
    $goods_array = get_data($param . $cat_id . ' ' . setWhere());
    $result = '';
    foreach ($goods_array as $good) {
            $result .= <<<RES
            <form method='get' action="categories.php?category=${_GET['category']}"?>
            <div class="cat-item container col-md-9">
                <div  class="cat-it-img-blk inline">
                    <img class="cat-it-image" src="../images/goods/${good['picture_name']}"/>
                </div>
                <div class="cat-it-info inline">
                    <span class="cat-it-name">${good['name']}</span>
                    <span class="cat-it-price">Цена:  ${good['price']} грн</span>
                    <input type="number" min="0" value=0 name="quantity">
                    <input type ="hidden" name=${good['id']}>
                    <input type="submit" value="Заказать">
                    <p class="cat-short-desc">${good['description']}</p>
                </div>
            </div>
            </form>
RES;
    }
    return $result;
}
function setWhere()
{
    $where = '';
    if (!empty($_GET['max']) && !empty($_GET['min'])) {
        $where .= "AND goods.price BETWEEN " . $_GET['min'] . " AND " . $_GET['max'];
    }
    foreach (get_filters_by_cat_id() as $fil_array) {
        $fil_name = $fil_array['param_url'];
        if (array_key_exists("$fil_name", $_GET) && array_key_exists("no$fil_name", $_GET)) {
            $where .= '';
        } elseif (array_key_exists("$fil_name", $_GET)) {
            $get_fil_name = $_GET[$fil_name];
            if ($get_fil_name == 1) {
                $where .= " AND goods.$fil_name=1 ";
            }
        } elseif (array_key_exists("no$fil_name", $_GET)) {
            if (($_GET["no$fil_name"]) == 1) {
                $where .= " AND goods.$fil_name=0 ";
            }
        }
    }
    return $where;
}
function getCurrentNumOfGoods(){
    $query="SELECT count(*) from goods WHERE cathegory_id=".get_request_param('category').' '.setWhere();;
    $cnt_array=get_data($query);
    return $cnt_array[0]['count(*)'];
};

function checked($param){
    $checked='';
    if (array_key_exists($param,$_GET)){
        $checked='checked';
    }
    return $checked;
}
function set_min_price(){
    if (array_key_exists('min',$_GET)){
        return intval($_GET['min']);
    }else{
        return (get_max_or_min_price_by_current_cat(MIN_PRICE_FROM_CATS));
    }
}
function set_max_price(){
    if (array_key_exists('max',$_GET)){
        return intval($_GET['max']);
    }else{
        return (get_max_or_min_price_by_current_cat(MAX_PRICE_FROM_CATS));
    }
}





//if ((isset($_GET['cathegory'])) && (!isset($_GET['good']))){
//        $current_cathegory=$_GET('cathegory');
//        $breadcrumbs=<<<QQ
//        <a href="index.php"><span class="post-bread">Главная</span></a> → <span class="chosen-bread">
//            {get_data("SELECT name FROM cathegories WHERE id=${current_cathegory}"}</span>