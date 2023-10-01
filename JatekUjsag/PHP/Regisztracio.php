<?php
include ("serverkapcs.php");
session_start();


    // Ha be van jelentkezve akkor nem erheti el ezt az oldalt es atiranyitja a Fooldalra
    $bejelentkezett = false;
    if (isset($_SESSION['FelhasznaloNev'])) {
        $bejelentkezett = true;
        header('Location: Fooldal.php');
        exit;
    }

$_SESSION['szoveg'] = '';

$error = array();

if(isset($_POST['regist'])){
    
    if(empty($_POST['fhsznev']) || empty($_POST['email']) || empty($_POST['pwd']) || empty($_POST['pwd-repeat']) || empty($_POST['bday'])){
        
        $error[] = "Kihagyott kötelező mezőket!";
    }
    if($_POST['pwd'] != $_POST['pwd-repeat']){
        
        $error[] = "A jelszavak nem egyeznek meg!";
    }
    if (preg_match("/^[a-zA-Z-' ]*$/", $_POST['email'])) {
        
        $error[] = "Az email formátuma nem megfelelő!";
    }

    if(strlen($_POST['pwd']) < 8){
        
        $error[] = "A jelszó legalább 8 karakter hosszú kell, hogy legyen!";
    }
    
    $sql_fhsz = "SELECT * FROM felhasznalo WHERE FelhasznaloNev='{$_POST['fhsznev']}'";
    $sql_email = "SELECT * FROM felhasznalo WHERE EmailCim='{$_POST['email']}'";
    
    $van_fhsz = mysqli_query($conn, $sql_fhsz);
    $van_email = mysqli_query($conn, $sql_email);
    
    if(mysqli_num_rows($van_fhsz) != 0){
        $error[] = "Ez a falhasználónév már foglalt!";
    }
    if(mysqli_num_rows($van_email) != 0){
        $error[] = "Ez az email már foglalt!";
    }
    
    if(count($error) == 0){
        $hashed_pwd = md5($_POST['pwd']);
        
        $query = "INSERT INTO felhasznalo(FelhasznaloNev, EmailCim, Jelszo, SzuletesiDatum) VALUES('{$_POST['fhsznev']}', '{$_POST['email']}', '$hashed_pwd', '{$_POST['bday']}')";
        
        $results = mysqli_query($conn, $query);
        if (!$results) {
            die(mysqli_error($conn));
        }
        
        $_SESSION['szoveg'] = 'Adatok elmentve!';
        
        $_POST = array();
        header('Location: Fooldal.php');
        exit;
        
    }   
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width, initial-scale=1.0">
    <title>GameSpace</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="shortcut icon" href="../Assets/favicon.ico" type="image/x-icon" />
</head>

<body>
    <!--kontent-->
    <!--fejlec-->
    <header id="fejlec-videok">
        <h1 class="focim"><a href="Fooldal.php">GameSpace</a></h1>
        <!--fekete-->
        <nav class="nav-fooldal">
            <ul>
              <li><a href="Hirek.php" class="nav-hirek">Hírek</a></li>
              <li><a href="Forum.php" class="nav-forum">Fórum</a></li>
              <li class="nav-leugro-videok">
                <a href="Videok.php" class="nav-videok">Videók</a>
                <ul class="leugro-nav">
                  <li><a href="Videok.php">Gameplayek</a></li>
                  <li><a href="Videok.php">Tesztek</a></li>
                  <li><a href="Videok.php">Ujdonsagok</a></li>
                </ul>
              </li>
              <?php if($bejelentkezett):?>
                <li><a href="Tovabbi.php" class="nav-tovabbi">Profil</a></li>
              <?php endif;?>
            </ul>
          </nav>
        <script>
                    const nav = document.querySelector('.nav-leugro-videok');
                    const menu = document.querySelector('.leugro-nav');

                    nav.addEventListener('mouseover', function() {
                    menu.style.display = 'block';
                    menu.style.position = 'absolute';
                    });

                    nav.addEventListener('mouseout', function() {
                    menu.style.display = 'none';
                    });
        </script>
        <script>
            //ha a felhasználó lejebb görget 10px-el, akkor a header kisebb lesz
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 2 || document.documentElement.scrollTop > 2) {
                    document.getElementById("fejlec-videok").style.padding = "15px 10px";
                } else {

                    document.getElementById("fejlec-videok").style.padding = "50px 10px";
                }
            }
        </script>
        <!--kereso, nem dob at egy uj oldalra ha elkuldik-->
        <div class="fooldal-kereso-form">
            <form action="Kereses.php" method="POST">
                <input type="text" class="keresok" id="jatekKereso" name="jatekKereso" autocomplete="on">
                <input type="submit" id="kereso-submit" class="keresok" value="Keresés">
            </form>
        </div>
        <div class="bejelentkezes-form">
            <!--ide jon majd a bejelentkezes php, a masodik merfoldkohoz-->
            <form action="Login.php" method="post" enctype="multipart/form-data">
                <input type="email" id="emailcim" name="emailcim" placeholder="Emailcím" required>
                <input type="password" id="jelszo" name="pwd" placeholder="Jelszó" required>
                <input type="submit" name="bejelentkezesGomb" value="Bejelentkezés"><button class="regb" onclick="window.location.href='Regisztracio.php';">Regisztráció</button>
            </form>
        </div>
    </header>
    <!--tartalom-->
    <main class="kitolto-form regiszt-form">
        <div class="wrapper">
           <h1>Regisztráció</h1>
           <form method="POST" action="Regisztracio.php" enctype="multipart/form-data">
               <div class="hibak regisztracio-hibak"><?php 
                if(!empty($error)) {
                    echo "<div class='error'>";
                    foreach($error as $e) {
                        echo "<p style='color:red;'>" . $e . "</p>";
                    }
                    echo "</div>";
                    $_POST = array();
                }else{
                    $_SESSION['szoveg'];
                    echo '<pre>' . print_r($_SESSION['szoveg'], TRUE) . '</pre>';
                }?> </div>
                <div class="floating-label">
                    <input type="text" id="fhsznev" name="fhsznev" placeholder=" " required>
                    <label for="fhsznev">Felhasználónév</label>
                    <span class="input-requirements">Pl. kovacs.jozsef</span>
                </div>
                <div class="floating-label">
                    <input type="email" id="email" name="email" placeholder=" " required>
                    <label for="email">Email cím</label>
                    <span class="input-requirements">Pl. example@gmail.com</span>
                </div>
                <div class="floating-label">
                    <input type="password" id="pwd" name="pwd" placeholder=" " required>
                    <label for="pwd">Jelszó</label>
                    <span class="input-requirements">Minimum 8 karakter</span>
                </div>
                <div class="floating-label">
                    <input type="password" id="pwd-repeat" name="pwd-repeat" placeholder=" " required>
                    <label for="pwd-repeat">Jelszó újra</label>
                    <span class="input-requirements">Minimum 8 karakter</span>
                </div>
                <div class="floating-label">
                    <input type="date" id="bday" name="bday" min="1920-01-01" max="2023-12-31" required>
                    <label for="bday">Születési dátum</label>
                </div>
               <button type="submit" class="kitoltoformBtn" name="regist" id="regist">Regisztráció</button>
               <div class="belep">
                   <p>Már van fiókod? <a href="Login.php">Belépek</a></p>
               </div>
            </form>
        </div>

    </main>
    <!--lablec-->
    <footer>
        <p>GameSpace &copy; 2023</p>
        <p>Kovács Armand</p>
        <p>Tabajdi Kornél</p>
    </footer>
</body>
</html>
