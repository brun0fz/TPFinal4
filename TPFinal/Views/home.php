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
        <form action="">
            <button type="submit">Register</button>
        </form>
    </div>
</div>

<?php
include('footer.php');
?>