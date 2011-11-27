<div id="loginarea">
    <form action="<?= __URLROOT__ ?>ajax.accesslogin.php" name="frmlogin" id="frmlogin" method="post">
        <h3>Inicio de sesion</h3>
        <h4>Email</h4>
        <div><input type="text" name="usuario" id="usuario" value="" /></div>
        <h4>Clave</h4>
        <div><input type="password" name="clave" id="clave" value="" /></div>
        <br/>
        <div>
            <input type="submit" name="Login" id="Login" value="Iniciar Sesion"/>
        </div>
        <span class="ajaxloader"></span>
    </form>
</div>