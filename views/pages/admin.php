<div id="article">
        <?php
        include "models/attendances/functions.php";
        $attendance = pageAttendencePercent();
        if(isset($_GET["message"])):?>

            <span class = "spanGreske"><?=$_GET["message"]?></span>
        <?php endif;?>
        <div class = "siteInfo">
            <p class ="pText">WEBSITE INFO</p>
            <p class = "pText">Site attendence:</p>
            <?php foreach($attendance as $key => $value):?>
            <p class = "pText"><?=$key . " - ". $value."%"?></p>
        <?php endforeach;?>
        </div><hr>
        <form action = "models/products/insertProduct.php" method = "post" class = "registerP" enctype="multipart/form-data">
        <p class ="pText">ADD NEW PRODUCT</p> 
            <input type = "text" name = "productName" id = "productName" placeholder = "product name"/></br>
            <input type = "text" name = "productDesc" id = "productDesc" placeholder = "product description"/></br>
            <input type = "text" name = "productPrice" id = "productPrice" placeholder = "product price"/></br>
            <input type = "text" name = "productCat" id = "productCat" placeholder = "product category"/></br>
            <span class ="spanText">IMPORT PICTURE<input type = "file" name = "productPicture"/></span></br>
            <input type = "submit" name = "send" id = "send" value ="Add" />
        </form>

    <form action = "models/user/insertUser.php" method = "post" class = "registerU" enctype="multipart/form-data">
    <p class ="pText">ADD NEW USER</p>  
        <input type = "text" name = "username" id = "userName" placeholder = "username"/></br>
        <input type = "text" name = "email" id = "email" placeholder = "email"/></br>
        <input type = "password" name = "password" id = "password" placeholder = "password"/></br>
        <input type = "password" name = "passwordC" id = "passwordC" placeholder = "Confirm password"/></br>
        <span class = "spanText">IMPORT PROFILE PICTURE<input type = "file" name = "fileUser"/></span></br>
        ADMIN:<input class ="ne" type = "radio" name = "role" value= "1"/>
        USER:<input class = "ne" type = "radio" name = "role" value= "2"/><br>
        <input type = "submit" name = "send"  value ="Add" />
    </form>
    <div class = "updateForma">
        <p class = "pText">UPDATE PRODUCT</p>
        <form action = "models/products/updateProduct.php" method = "post" class = "register" enctype="multipart/form-data">
                <input type = "text" name = "name"  placeholder = "product name"/></br>
                <input type = "text" name = "description"  placeholder = "product description"/></br>
                <input type = "text" name = "price"  placeholder = "product price"/></br>
                <input type = "text" name = "category"  placeholder = "product category"/></br>
                <input type = "hidden" name = "idProduct" id = "idProduct"/>
                <span class = "spanText">CHANGE PICTURE<input type = "file" name = "file"/></span>
                <input type = "submit" name = "sendU" id = "sendU" value ="Update" />
            </form>
        </div>
        <div class = "updateFormaU">
            <p class = "pText">UPDATE USER</p>
            <form action = "models/user/updateUser.php" method = "post" class = "register" enctype="multipart/form-data">
                    <input type = "text" name = "username" id = "usernameU" placeholder = "username"/></br>
                    <input type = "text" name = "email" id = "emailU" placeholder = "email"/></br>
                    <input type = "text" name = "password" id = "passwordU" placeholder = "password"/></br>
                    <input type = "text" name = "passwordC" id = "passwordUC" placeholder = "Confirm password"/></br>
         <span class = "spanText">CHANGE PROFILE PICTURE<input type = "file" name = "fileUser"/></span></br>
                    <input type = "hidden" name = "idUser" id = "idUser"/>
                    ADMIN:<input class ="ne" type = "radio" name = "role" value= "1"/></br>
                    USER:<input class = "ne" type = "radio" name = "role" value= "2" /></br>
                    <input type = "submit" name = "adminUpdate" id = "sendUserUpdate" value ="Update" />
             </form>
            </div>
    <div id="sidebar">
    <table class = "tabela" border = "1px solid black" >
        <tr>
            <th>Product ID</td>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Picture</th>
            <th>Category ID</th>
        </tr>
        <tbody id = "products">
        <?php
        $products = getAllProducts();
        foreach($products as $product):
        ?>
            <tr>
                <td><?=$product->id?></td>
                <td><?=$product->name?></td>
                <td><?=$product->description?></td>
                <td>$<?=$product->price?></td>
                <td><img src = "<?=$product->original?>"/></td>
                <td><?=$product->Category_ID?></td>
                <td>
                    <button><a data-id = "<?=$product->id?>" class = "delete"  name = "delete" href = "" >DELETE PRODUCT</a></button>
                    <button><a data-id = "<?=$product->id?>" class = "update" name = "update" href = "#" >UPDATE PRODUCT</a></button>	
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
        </table>
        <hr>
        <table class = "tabela" border = "1px solid black" id = "users" >
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Profile Picture</th>
            <th>Role</th>
        </tr>
        <tbody id = "users">
        <?php
        $users = getAllUsers();
        foreach($users as $user):
        ?>
            <tr>
                <td><?=$user->id?></td>
                <td><?=$user->username?></td>
                <td><?=$user->email?></td>
                <td><img src = "<?=$user->profile?>"/></td>
                <td><?=$user->name?></td>
                <td>
                    <button><a data-id = "<?=$user->id?>" class = "deleteU"  name = "deleteU" href = "" >DELETE USER</a></button>
                    <button><a data-id = "<?=$user->id?>" class = "updateU" name = "update" href = "#" >UPDATE USER</a></button>	
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>        
        </table>
        </div>
    </div>
</div>