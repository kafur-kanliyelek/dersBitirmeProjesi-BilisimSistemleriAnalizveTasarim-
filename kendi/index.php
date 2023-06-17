<!DOCTYPE html>

<html>

<head>

    <title>ÇALIŞAN LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <form action="login.php" method="post">

        <h2>LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Soyad</label>

        <input type="text" name="password" placeholder="Soyad"><br> 

        <button type="submit">Login</button>

     </form>

     <form action="loginManager.php" method="post">

        <h2>YÖNETİCİ LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Soyad</label>

        <input type="text" name="password" placeholder="Soyad"><br> 

        <button type="submit">Login</button>

        </form>


</body>

</html>