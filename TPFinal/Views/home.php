<?php 
 include('header.php');
?>

<div class="login">
    <form action="">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <form action="">
        <button type="submit">Register</button>
    </form>
</div>

<?php 
  include('footer.php');
?>