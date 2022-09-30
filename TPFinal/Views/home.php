<?php
include('header.php');
?>

<div class="home">
    <div class="login">
        <p>Iniciar Sesion</p>
        <form action="">
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <a href="<?php echo  FRONT_ROOT."Home/Registro/1"?>">Registrarse como Dueño</a><br>
        <a href="<?php echo  FRONT_ROOT."Home/Registro/2"?>">Registrarse como Guardian</a>
    </div>
</div>

<?php
include('footer.php');
?>