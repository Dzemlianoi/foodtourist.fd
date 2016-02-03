<?php
include_once ('config.php');
function get_cathegory()
{
    $db = mysqli_connect(HOST, USER_DB, PASS_DB, DB_NAME);
    if ($db) {
        //charset-----------------------------------
        mysqli_query($db, "SET NAMES 'utf8'");
        mysqli_query($db, "SET CHARACTER SET 'utf8'");
        mysqli_query($db, "SET SESSION collation_connection = 'utf8_general_ci'");
        //------------------------------------------

        $query = "SELECT * FROM cathegories";
        $result = mysqli_query($db, $query);
        if ($result) {
            $cathegories = array();
            while ($cathegory = mysqli_fetch_assoc($result)) {
                array_push($cathegories, $cathegory);
            }
        } else {
            //тут необходимо записать логи
            exit("can't get categories");
        }
        mysqli_close($db);
    } else {
        //тут необходимо записать логи
        exit('no db connection');
    }
    return $cathegories;

}

function push_cathegories(){
    foreach(get_cathegory() as $cat){
        $push_categories.='<li class="col-md-2"><a href="#">'.$cat['name'].'</a></li>';
    }
    return $push_categories;
}

function get_hot($query){
    $db = mysqli_connect(HOST, USER_DB, PASS_DB, DB_NAME);
    if ($db) {
        //charset-----------------------------------
        mysqli_query($db, "SET NAMES 'utf8'");
        mysqli_query($db, "SET CHARACTER SET 'utf8'");
        mysqli_query($db, "SET SESSION collation_connection = 'utf8_general_ci'");
        //------------------------------------------

        $result = mysqli_query($db, $query);
        if ($result) {
            $hots = array();
            while ($hot = mysqli_fetch_assoc($result)) {
                array_push($hots, $hot);
            }
        } else {
            //тут необходимо записать логи
            exit("can't get categories");
        }
        mysqli_close($db);
    } else {
        //тут необходимо записать логи
        exit('no db connection');
    }
    return $hots;

}

function push_hots(){
    foreach(get_hot("SELECT * FROM goods WHERE is_hot=1 LIMIT 4") as $hot){
        $push_hot.='<div class="special-element">
            <div class="sale-sprite"></div>
            <img class="special-image" src="../images/goods/pizza/'.$hot["picture_name"].'" alt=""/>
            <div class="name-box">
                <span class="name">'.$hot["name"].'</span>
            </div>
            <span class="price">'.$hot["price"].'</span>
            <form id="'.$hot["id"].'" method="post">
                <input type="number" value=0 name="quantity">
                <input type="submit" value="Заказать">
            </form>
        </div>';
    }
    return $push_hot;
}
function push_newings(){
    foreach(get_hot("SELECT * FROM goods WHERE is_new=1 LIMIT 4") as $newing){
        $push_new.='<div class="special-element">
            <div class="new-sprite"></div>
            <img class="special-image" src="../images/goods/pizza/'.$newing["picture_name"].'" alt=""/>
            <div class="name-box">
                <span class="name">'.$newing["name"].'</span>
            </div>
            <span class="price">'.$newing["price"].'</span>
            <form id="'.$newing["id"].'" method="post">
                <input type="number" value=0 name="quantity">
                <input type="submit" value="Заказать">
            </form>
        </div>';
    }
    return $push_new;
}


