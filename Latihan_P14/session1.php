<?php
/****************************************************
 * Halaman ini merupakan halaman contoh penciptaan session.
 * Perintah session_start() harus ditaruh di perintah pertama
 * tanpa spasi di depannya. Perintah session_start() harus ada
 * pada setiap halaman yang berhubungan dengan session.
 ****************************************************/
session_start();
 
if (isset($_POST['Login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
 
    // Periksa login
    if ($user == "surya" && $pass == "wiwiwiwi") {
        // Menciptakan session
        $_SESSION['login'] = $user;
 
        // Menuju ke halaman pemeriksaan session
        echo "<h1>Anda berhasil LOGIN</h1>";
        echo "<h2>Klik <a href='session2.php'>di sini (session2.php)</a> untuk menuju ke halaman pemeriksaan session</h2>";
    } else {
        echo "<h2 style='color:red;'>Username atau Password salah!</h2>";
        echo "<a href='session1.php'>Coba lagi</a>";
    }
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login here...</title>
</head>
<body>
    <form action="" method="post">
        <h2>Login Here...</h2>
        Username : <input type="text" name="user"><br><br>
        Password : <input type="password" name="pass"><br><br>
        <input type="submit" name="Login" value="Log In">
    </form>
</body>
</html>
<?php
}
// <!-- Project 14.1 By ASEP SURYA AGUSTIN - 221011450392  -->
?>