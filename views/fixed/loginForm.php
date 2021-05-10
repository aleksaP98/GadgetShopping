<div id = "login">
    <form action = "models/login/login.php" method = "post"  class = "login">
        <input type = "text" id = "username" name = "username" placeholder = "username"/></br>
        <input type ="password" id = "password" name = "password" placeholder = "password"></br>
        <input type = "submit" id = "posalji" name = "send" value = "LOG IN"/>
    </form>
    <?php if(isset($_GET["error"])):?>
			<p class ="error"><?= $_GET["error"]; ?></p>
    <?php endif;?>
    <a class ="signUp" href = "index.php?page=register">Dont Have an Account? Sign up!</a>
</div>	