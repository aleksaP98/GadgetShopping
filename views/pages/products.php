<?php 
if(isset($_GET["id"])):
$product = getOneProduct($_GET["id"]);    
?>

<div class = "oneProduct">
    <img class = "productImg" src = "<?= $product->original?>"/>
    <p class = "name"><?=$product->name?></p>
    <p class = "description"><?=$product->description?></p>
    <p class = "price">$<?=$product->price?></p>
</div>
<?php else:?> 
    <div class ="filter-sort">
        <div class="filter-categories">
            <select id = "filter" class = "select-css">
                <option value="0">Filter By Category</option>
                <?php
                $categories = getAllCategories();
                foreach($categories as $category):
                ?>
                <option value = "<?=$category->id?>"><?=$category->name?></option>
                <?php endforeach;?>
           </select>
        </div>
        <div class="sort-price">
            <select id="sortPrice" class = "select-css">
                <option value="0">Sort By Price</option>
                <option value="1">Ascending</option>
                <option value="2">Descending</option>
           </select>
        </div>
        <div class="sort-name">
            <input type = "text" id = "sortName" placeholder = "Search product" class = "select-css-name" />
        </div>
    </div>
    <hr>
    <ul id = "products">
    <?php
    $limit = 0;
    $products = getAllProducts($limit);
    foreach($products as $product):
    ?>
        <li>
            <div class = product>
                <a href = "index.php?page=products&id=<?=$product->id?>"><img src = "<?= $product->original?>"/></a>
                <p class="name"><?= $product->name?></p><hr>
                <p class ="price">$<?= $product->price?></p>
                <input class = "id" type ="hidden" value = "<?=$product->id?>">
                <input class = "idC" type ="hidden" value = "<?=$product->Category_ID?>">
                <input type = "button" value = "Add to cart"/>
            </div>
        </li>
    <?php endforeach;?>
    </ul>
<?php endif;?>
<div class = "pages">
    <?php
    $numOfPages = getPaginationNum();
    for($i = 0;$i<$numOfPages;$i++):
        if($i == 0):
    ?>
        <a href ="#" class = "page active"  data-limit = "<?=$i?>"><?=$i + 1?></a>
        <?php else:?>
        
        <a href = "#" class = "page"  data-limit = "<?=$i?>"><?=$i+1?></a>
        <?php endif; endfor;?>
        <button><a class = "next" href = "#">NEXT</a></button>
    </div>