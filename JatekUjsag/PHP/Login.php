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



if(isset($_POST['bejelentkezesGomb'])){
    
    $emailcim = $_POST['emailcim'];
    $jelszo = $_POST['pwd'];
    $jelszohash = md5($jelszo);

    if(empty($emailcim) || empty($jelszo)){
        $error[] = "Üresen hagyott egy mezőt!";
    }else{
        $sql_felhasznalo = "SELECT FelhasznaloNev FROM felhasznalo WHERE EmailCim = '{$emailcim}' and Jelszo = '{$jelszohash}'";
        $sql_email = "SELECT EmailCim FROM felhasznalo WHERE EmailCim = '{$emailcim}' and Jelszo = '{$jelszohash}'";
        $result = mysqli_query($conn, $sql_felhasznalo);
        $result1= mysqli_query($conn, $sql_email);
        if (!$result || !$result1) {
            die(mysqli_error($conn));
        }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $row1= mysqli_fetch_array($result1, MYSQLI_ASSOC);
        //Ha nem talál olyan felhasználót, akkor nem lenne elem benne, igy kezelni lehet
        /*
        if ($row != null) {
            $active = $row['active'];
        } else {
            $active = 0;
        }
        */

        $count = mysqli_num_rows($result);
        $count1 = mysqli_num_rows($result1);

        if ($count == 1 && $count1) {
            $felhasznalo = $row['FelhasznaloNev'];
            $emailcim = $row1['EmailCim'];
            session_start();
            $_SESSION['FelhasznaloNev'] = $felhasznalo;
            $_SESSION['EmailCim'] = $emailcim;
            $bejelentkezett = true;
            header("location: Fooldal.php");
        } else {
            $error[] = "Hibás emailcím vagy jelszó!";
        }
    }
    

    //query hiba fuggveny implementalas
    
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
           <h1>Bejelentkezés</h1>
           <form method="POST" action="Login.php" enctype="multipart/form-data">
               <div class="hibak regisztracio-hibak">
                <?php
                if(!empty($error)) {
                    echo "<div class='error'>";
                    echo "<p style='color:red;'>" . $error[0] . "</p>";
                    echo "</div>";
                }
                else{
                    $_SESSION['szoveg'];
                    echo '<pre>' . print_r($_SESSION['szoveg'], TRUE) . '</pre>';
                }?> </div>
               <input type="text" placeholder="Email cím" name="emailcim" id="email" required>
               <input type="password" placeholder="Jelszó" name="pwd" id="pwd" required>
               <hr>
               <button type="submit" class="kitoltoformBtn" name="bejelentkezesGomb" id="belep">Belépés</button>
               <div class="belep">
                   <p>Még nincs fiókod? <a href="Regisztracio.php">Regisztrálok</a></p>
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
?>