<?php
const HOST="localhost";
const USER_DB="foodtourist";
const PASS_DB="denis";
const DB_NAME="foodtourist";
const ALL_CATEGORIES="SELECT * FROM cathegories";
const NEWINGS_SHOW="SELECT * FROM goods WHERE is_new=1 LIMIT 4";
const HOTS_SHOW="SELECT * FROM goods WHERE is_hot=1 LIMIT 4";
const SELECT_FILTER_BY_CAT_ID="
SELECT filters.id, cathegories.name, filters.name,filters.param_url
FROM cathegories, filters, filters_to_cathegories
WHERE cathegories.id = filters_to_cathegories.category_id
AND filters.id = filters_to_cathegories.filter_id
AND cathegories.id =";
const MAX_PRICE_FROM_CATS="SELECT MAX( goods.price )
FROM cathegories, goods
WHERE cathegories.id = goods.cathegory_id
AND cathegories.id =";
const MIN_PRICE_FROM_CATS="SELECT MIN( goods.price )
FROM cathegories, goods
WHERE cathegories.id = goods.cathegory_id
AND cathegories.id =";
const ALL_GOODS_FROM_CAT="SELECT goods.id, goods.name, goods.picture_name, goods.weight, goods.price, goods.description
FROM goods, cathegories
WHERE cathegories.id = goods.cathegory_id
AND cathegories.id =";
const ORDER =" ORDER BY price DESC";