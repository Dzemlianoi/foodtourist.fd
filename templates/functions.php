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
        $push_categories.='<li class="col-md-2"><a href="http://foodtourist.fd/category='.$cat['id'].'">'.$cat['name']
        .'</a></li>';
    }
    return $push_categories;
}
//Выводим хот предложения
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