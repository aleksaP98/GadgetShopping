
<h1>Featured Products</h1>
<ul id = "featured">
    <?php
    
    $meni = getFeatured();
    foreach($meni as $item):
        ?>
        <li><img class ="slider" src = "<?=$item->original?>"/><p><b><?=$item->name?></b></p></li>
        <?php endforeach; ?>
</ul>
<button class = "shopNow"><a href = "index.php?page=products">SHOP NOW</a></button><hr> 
