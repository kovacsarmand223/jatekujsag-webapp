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
    <main class="forum-tartalom">
        <div class="forum-container">
            <div class="forum-article">
                <div class="forum-article-focim">
                    <h1>Áltálanos: </h1>
                </div>
                <div class="forum-article-body">
                    <div class="forum-article-profil forum-article-body-oszlopok kozepre-igazit">
                        <img src="../Assets/Pic1.png" alt="HogwartsLegacy">
                        <h1>Pistike223</h1>
                    </div> 
                    <div class="forum-article-alcim forum-article-body-oszlopok bejegyzes-szam">
                        <h1>Keresek valamit</h1>
                        <p>Sziasztok!
                            Nem egy játékot keresek pontosan, hanem egy közösségi szerű oldalt. Csak nosztalgiából, biztos, hogy már nem létezik, csak érdekelne, hogy mi volt a neve. Régen, olyan 2005 körül, talán kicsit később, nagyon sokat fent voltam ezen, tudtál karaktert választani magadnak és igazi emberekkel chatelni, különböző helyszíneken, például egy kreált discoban. Bárhogy kerestem semmi hasonlót nem találtam, pedig nagyon szerettem anno tinikoromban ezen lógni. Hátha valaki használta még rajtam kívül</p>
                    </div>
                    <div class="forum-article-informaciok forum-article-body-oszlopok">
                        <span>10 bejegyzés</span>
                    </div>
                    <div class="forum-article-datum forum-article-body-oszlopok">
                        <span>2023.03.15.</span>
                    </div>
                    <div class="forum-article-like forum-article-body-oszlopok">
                        <span>Tetszik: 10</span>
                    </div>
                </div>
                <div class="forum-article-hozzaszolas forum-article-body-oszlopok">
                    <form action="#">
                    <input type="text" class="komment" name="komment" placeholder="Hozzászólás..."><br><br>
                    </form>
                </div> 
                <div class="forum-article-body">
                    <div class="forum-article-profil forum-article-body-oszlopok kozepre-igazit">
                        <img src="../Assets/Pic2.png" alt="HogwartsLegacy">
                        <h1>TheGamerBoy123</h1>
                    </div> 
                    <div class="forum-article-alcim forum-article-body-oszlopok">
                        <h1>Kedvenc játékom</h1>
                        <p>Hát nehéz egyet kiválasztani. Fallout széria nálam iszonyat durva függést okoz, vigyáznom kell vele ha elkezdem mert nem bírok leakadni róla és képes vagyok egy évre elmerülni a világában :D Ezen kívül a klasszikus Assassin's Creed részek (1-2 Brotherhood, Revelations) nagy kedvencek és a Dishonored széria is megunhatatlan számomra. Amnesia+kiegészítői, SOMA, Plague Tale Innocence és már a Requiem is felcsúszott nálam a TOP10-be.</p>
                    </div>
                    <div class="forum-article-informaciok forum-article-body-oszlopok">
                        <span>108 bejegyzés</span>
                    </div>
                    <div class="forum-article-datum forum-article-body-oszlopok">
                        <span>2023. 03. 12.</span>
                    </div>
                    <div class="forum-article-datum forum-article-body-oszlopok">
                        <span>Tetszik: 89</span>
                    </div>
                </div>
                <div class="forum-article-hozzaszolas forum-article-body-oszlopok">
                    <form action="#">
                    <input type="text" class="komment" name="komment" placeholder="Hozzászólás..."><br><br>
                    </form>
                </div>
                <div class="forum-article-body">
                    <div class="forum-article-profil forum-article-body-oszlopok kozepre-igazit">
                        <img src="../Assets/Pic3.png" alt="HogwartsLegacy">
                        <h1>zöldfülű19</h1>
                    </div> 
                    <div class="forum-article-alcim forum-article-body-oszlopok">
                        <h1>Mi lehet a probléma?</h1>
                        <p>A Steam_api64.dll nem marad bent a Gta főkönyvtárában akár hányszor beillesztem. Igy indításkor mindíg a Steam failed to initialize Please exit and try again felirat jön be. Próbáltam egyedül magában is a fájlt berakni és egyben a Crack többi fájljával is,de sosem marad bent a Steam_api64.dll. Tud valaki erre megoldást miért lehet és mit lehet ilyenkor tenni? Előre is nagyon köszönöm!</p>
                    </div>
                    <div class="forum-article-informaciok forum-article-body-oszlopok">
                        <span>1 bejegyzés</span>
                    </div>
                    <div class="forum-article-datum forum-article-body-oszlopok">
                        <span>2023. 03. 19.</span>
                    </div>
                    <div class="forum-article-datum forum-article-body-oszlopok">
                        <span>Tetszik: 2</span>
                    </div>
                </div>
                <div class="forum-article-hozzaszolas forum-article-body-oszlopok">
                    <form action="#">
                    <input type="text" class="komment" name="komment" placeholder="Hozzászólás..."><br><br>
                    </form>
                </div>  
            </div>
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