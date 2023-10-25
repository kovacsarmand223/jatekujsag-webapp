<?php
    include "serverkapcs.php";
    session_start();

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
        header('Location: Forum.php');
        exit;
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
              <li><a class="aktiv-gomb" href="Forum.php" id="nav-forum">Fórum</a></li>
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
    </header>



<!--tartalom-->
<main class="forum-content">
    <section class="forum-container">
        <?php
        $query = "SELECT uzenetiras.FelhasznaloNev, uzenetiras.UzenetId, felhasznalo.kep, uzenet.UzenetLike,
        uzenet.UzenetCim, uzenet.UzenetDatum, uzenet.UzenetSzoveg, valaszok.Valaszok,
        valaszok.ValaszokDatum, valaszok.ValaszLike 
        FROM uzenetiras 
        INNER JOIN felhasznalo ON uzenetiras.FelhasznaloNev = felhasznalo.FelhasznaloNev
        INNER JOIN uzenet ON uzenet.UzenetId = uzenetiras.UzenetId
        LEFT JOIN valaszok ON valaszok.UzenetId = uzenetiras.UzenetId";

        if (!empty($query)) {
            $result = mysqli_query($conn, $query);
        }
        if ($result && mysqli_num_rows($result) != 0) {
            $posts = []; // Ebben a tömbben tároljuk az összes bejegyzést
            
            while ($row = mysqli_fetch_assoc($result)) {
                $postId = $row['UzenetId']; // Az aktuális bejegyzés azonosítója
                
                // Ha ez az első alkalom, hogy találkozunk ezzel az ÜzenetId-val, hozzunk létre egy új bejegyzést
                if (!isset($posts[$postId])) {
                    $posts[$postId] = [
                        'kep' => $row['kep'],
                        'FelhasznaloNev' => $row['FelhasznaloNev'],
                        'UzenetCim' => $row['UzenetCim'],
                        'UzenetSzoveg' => $row['UzenetSzoveg'],
                        'UzenetLike' => $row['UzenetLike'],
                        'Valaszok' => [], // Itt tároljuk a válaszokat
                    ];
                }
                
                // Hozzáadjuk a választ az adott bejegyzéshez
                $posts[$postId]['Valaszok'][] = [
                    'ValaszSzoveg' => $row['Valaszok'],
                    'ValaszLike' => $row['ValaszLike'],
                    'Felhasznalonev' => $row['FelhasznaloNev'],
                ];
            }
            
            // Most már a $posts tömb tartalmazza az összes bejegyzést és hozzátartozó válaszokat
            
            // A bejegyzések kiírása
            foreach ($posts as $postId => $post) {
                echo '<article class="forum-article">';
                echo '<div class="forum-article-content">';
                echo '<div class="forum-article-profil">';
                if(!empty($post['kep'])){
                    echo '<img src="../Assets/' . $post['kep'] . '" alt="' . $post['FelhasznaloNev'] . ' profilkepe">';
                }else{
                    echo '<img src="../Assets/default_prof_pic.jpg' . '" alt="' . $post['FelhasznaloNev'] . ' profilkepe">';
                }
                echo '<b>' . $post['FelhasznaloNev'] . '</b>';
                echo '</div>';
                echo '<h2>' . $post['UzenetCim'] . '</h2>';
                echo '<p>' . $post['UzenetSzoveg'] . '</p>';
                echo '<span>Tetszik: ' . $post['UzenetLike'] . '</span>';

                // Válaszok kiírása
                foreach ($post['Valaszok'] as $valasz) {
                    echo '<hr>';
                    echo '<div class="forum-article-info">';
                    echo '<b>' . $valasz['Felhasznalonev']. '</b>';
                    echo '<p>' . $valasz['ValaszSzoveg']. '</p>';
                    echo '<span>Tetszik: ' . $valasz['ValaszLike'] . '</span>';
                    echo '</div>';
                }
                
                echo '</article>';
            }
        }
        ?>
    </section>
</main>


    <!--lablec-->
    <footer>
        <p>GameSpace &copy; 2023</p>
        <p>Kovács Armand</p>
        <p>Tabajdi Kornél</p>
    </footer>
</body>
</html>