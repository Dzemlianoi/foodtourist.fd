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
            <img class="special-image" src="../images/goods/pizza/'.$hot["picture_name"].'" alt=""/>
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
        $push_filters.=<<<HOM
            <div class="filter-block box-filter for-submit">
                <span class="filter-name">${filter['name']}</span>
                <input type="checkbox" id="${filter['param_url']}1}" name="${filter['param_url']}" value="1">
                <label class="fil-name-chk" for="${filter['param_url']}2">Да</label>
                <br/>
                <input type="checkbox" id="${filter['param_url']}2" name="${filter['param_url']}" value="0">
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

function get_goods_from_cat($param){
    $cat_id=get_request_param('category');
    $goods_array=get_data($param.$cat_id.ORDER);
    $result='';
        foreach ($goods_array as $good){
            $result.=<<<RES
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
function setWhere(){
    $where='';
    if(!empty($_GET['max'])&&!empty($_GET['min'])){
        $where="BETWEEN".$_GET['min']." AND ".$_GET['max'];
    }

}



//if ((isset($_GET['cathegory'])) && (!isset($_GET['good']))){
//        $current_cathegory=$_GET('cathegory');
//        $breadcrumbs=<<<QQ
//        <a href="index.php"><span class="post-bread">Главная</span></a> → <span class="chosen-bread">
//            {get_data("SELECT name FROM cathegories WHERE id=${current_cathegory}"}</span>