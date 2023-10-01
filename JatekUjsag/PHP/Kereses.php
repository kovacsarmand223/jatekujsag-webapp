<?php
    include "serverkapcs.php";
    session_start();

    $_SESSION['adattorles-szoveg'] = '';

    // Ha be van jelentkezve
    $bejelentkezett = false;
    if (isset($_SESSION['FelhasznaloNev'])) {
        $bejelentkezett = true;
    }

    if(isset($_GET['action']) && $_GET['action'] == 'kijelentkezes') {
        // Ha a kijelentkezes gomb meg lett nyomva
        session_destroy();
        session_unset();
        
        // Visszakuldi a Login.php-ra es torli a szkriptet
        header('Location: Fooldal.php');
        exit;
    }

    $error_kereses = array();
    $_SESSION['jatekkereses-szoveg'] = '';

    if(isset($_POST['jatekKereso'])){
        //jatekkereses megvalositasa
        //kulcsszavak alapjan
        //kategoriak alapjan
        $jatekkereses = $_POST['jatekKereso'];
        $kereses = mysqli_real_escape_string($conn, $jatekkereses);
        
        $query = "SELECT jatek.*, GROUP_CONCAT(kategoria.kategoria SEPARATOR ', ') AS kategoriak
        FROM jatek
        LEFT JOIN kategoria ON jatek.JatekNev = kategoria.JatekNev
        WHERE jatek.JatekNev LIKE '%$jatekkereses%' OR jatek.Jatekszoveg LIKE '%$jatekkereses%' OR kategoria.kategoria LIKE '%$jatekkereses%'
        GROUP BY jatek.JatekNev";
        //ha van megegyezo substring

        $result = mysqli_query($conn, $query);

        if(empty($result)){
            die(mysqli_error($conn));
        }

        if (isset($result)) {
            $talalatok = mysqli_num_rows($result);

            if($talalatok == 0){
                $error_kereses[] = 'Nem volt erre a kulcsszóra vagy kategóriára találat!';
            }
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
    <header id="fejlec">
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
              <?php if ($bejelentkezett): ?>
                <li><a href="Tovabbi.php" class="nav-tovabbi">Profil</a></li>
                <li><a href="?action=kijelentkezes" name="kijelentkezes" class="nav-logout">Kijelentkezés</a></li>
              <?php endif; ?>
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
        <?php if($bejelentkezett):?>
        <div class="fooldal-kereso-form"> 
                <form action="Kereses.php" method="POST">
                    <input type="text"  class="keresok" id="jatekKereso" name="jatekKereso" autocomplete="on" style="
                    width: 200px;
                    transform: translate(10%, -1%);
                    margin: 0 auto;
                    padding: 8px;
                    border-radius: 10px;
                    box-shadow: 0.5px 0.5px lightblue;">
                    <input type="submit" id="kereso-submit" class="keresok" value="Keresés" style="
                    width: 150px;
                    transform: translate(15%, -1%);
                    margin: 0 auto;
                    padding: 8px;
                    border-radius: 10px;
                    box-shadow: 0.5px 0.5px lightblue;">
                </form>
        </div>
        <?php endif; ?>
        <?php if(!$bejelentkezett):?>
        <!--kereso, nem dob at egy uj oldalra ha elkuldik-->
            <div class="fooldal-kereso-form"> 
                <form action="Kereses.php" method="POST">
                    <input type="text"  class="keresok" id="jatekKereso" name="jatekKereso" autocomplete="on">
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
        <?php endif;?>
        <script>
            //ha a felhasználó lejebb görget 10px-el, akkor a header kisebb lesz
            window.onscroll = function() {
                scrollFunction()
            };
        
            function scrollFunction() {
                if (document.body.scrollTop > 2 || document.documentElement.scrollTop > 2) {
                    document.getElementById("fejlec").style.padding = "15px 10px";
                } else {
                    
                    document.getElementById("fejlec").style.padding = "50px 10px";
                }
            }
            </script>
    </header>
    <script>
        const links = document.querySelectorAll('nav a');

        links.forEach(link => {
            link.addEventListener('click', function() {
                links.forEach(link => {
                    link.classList.remove('aktiv-gomb');
                });
                this.classList.add('aktiv-gomb');
            });
        });
    </script>
    
    <body>
    <main class="hirek-tartalom">
        
      
           
    <div class="hirek-article">
    <div>
    <div class="hirek-article-cim">
        <h2>Találatok (<?php echo $talalatok; ?>): </h2>
    </div>  
        <?php
            if(empty($error_kereses)){
                if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="hirek-article-cim">'; 
                    echo "<h3>" . $row['JatekNev'] . "</h3>";
                    echo "</div>";
                    echo '<div class="hirek-article-leiras">';
                    echo "<p>" . $row['Jatekszoveg']. "</p>";
                    echo '</div>';
                    echo "<p>" . $row['kategoriak']. "</p>";
                }
            }else{
                "No results found.";
            }
            }
            if(!empty($error_kereses)) {
                echo "<div class='error'>";
                foreach($error_kereses as $e) {
                    echo "<p style='color:red;'>" . $e . "</p>";
                }
                echo "</div>";
                $_POST = array();
            }if(isset($_POST['jatekKereso']) && empty($error_kepkereses)){
                $_SESSION['jatekkereses-szoveg'] = 'Sikeres találatok!';
                echo '<pre style="color: red;">' . print_r($_SESSION['jatekkereses-szoveg'], TRUE) . '</pre>';
            }
        ?>
    </div> 
        </main>
        </div>

    </body>

    <footer>
        <p>GameSpace &copy; 2023</p>
        <p>Kovács Armand</p>
        <p>Tabajdi Kornél</p>
    </footer>
</body>
</html>
    