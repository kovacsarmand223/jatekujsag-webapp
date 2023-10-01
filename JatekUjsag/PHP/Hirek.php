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
        header('Location: Hirek.php');
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
              <li><a class="aktiv-gomb" href="Hirek.php" id="nav-hirek">Hírek</a></li>
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
    <main class="hirek-tartalom">
        <div class="container">
            <!--ide jonnek a hirek, cikkek, div formajaban, igy szabalyozni lehet oket blokkszinten-->

            <div class="hirek-article">
                <div class="hirek-article-img kozepre-igazit">
                    <img src="../Assets/Resident-Evil.jpg" alt="HogwartsLegacy">
                </div>
                <div class="hirek-article-body">
                    <div class="hirek-article-cim">
                        <h2 class="hirek-h2">Lenyűgözte a kritikusokat a Resident Evil 4 remake-je</h2>
                    </div>
                    <div class="hirek-article-leiras">
                    <p>A Resident Evil 4 Remake első értékelései tehát már elérhetőek, így a nagyobb oldalakon ti is rálelhettek a részletes véleményekre. A Metacritic és az Open Critic oldalakon található átlagpontszámokból (93, illetve 92) ítélve a felújított játék teljesen elbűvölte a kritikusokat, és jelenleg az év második legjobbra értékelte játéka lett, minimálisan elmaradva a Metroid Prime Remasteredtől.</p>
                    </div>
                </div>
            </div>
            <div class="hirek-article">
                <div class="hirek-article-img kozepre-igazit">
                    <img src="../Assets/Nvidia.jpg" alt="HogwartsLegacy">
                </div>
                <div class="hirek-article-body">
                    <div class="hirek-article-cim">
                    <h2 class="hirek-h2">Az Nvidia Redfall Bite Back Editiont csomagol RTX 40 szériás kártyák mellé</h2>
                    </div>
                    <div class="hirek-article-leiras">
                    <p> Az AMD legfrissebb GPU-csomagjának köszönhetően mindenki, aki Radeon RX 7900 vagy RX 6000 szériás kártya vásárlása mellett dönt, ingyen megkaphatja a The Last of Us Part 1-et. Az Nvidia most szintén előállt egy hasonló ajánlattal: a cég a Redfall Bite Back Editionnel próbálja még csábítóbbá tenni a high-end kártyáit.</p>
                    </div>
                </div>
            </div>
            <div class="hirek-article">
                <div class="hirek-article-img kozepre-igazit">
                    <img src="../Assets/Iphone.jpg" alt="HogwartsLegacy">
                </div>
                <div class="hirek-article-body">
                    <div class="hirek-article-cim">
                    <h2 class="hirek-h2">Mikor érdemes iPhone szerviz boltba vinni a telefonunkat?</h2>
                    </div>
                    <div class="hirek-article-leiras">
                    <p>Még a legjobban féltett modellekkel kapcsolatban is előfordulhatnak szoftveres vagy hardveres hibák, de persze vannak olyan apróbb fennakadások, melyek miatt nem kell iPhone szerviz boltba rohannunk - írja a Mobee. Ha viszont azt látjuk, hogy szükségünk van az Apple szerviz szakértelmére, akkor érdemes utánajárni, mely boltokba érdemes szerelésre adni a telefonunkat, még ha ez úgy is tűnhet, hogy tűt keresünk a szénakazalban. Viszont mielőtt iPhone szerviz boltba rohannánk mindenképp végezzünk el mi is otthon néhány alapvető hibaelhárító műveletet.</p>

                    <p>Kezdjük az alapvető javításokkal, amelyek általában enyhítik a leggyakoribb iPhone-problémákat, amelyekkel találkozni fogunk. Legyen szó szoftverhibáról, hardverhibáról vagy rejtélyes hibáról, előfordulhat, hogy szerelő nélkül is meg tudjuk oldani. Azonban mielőtt elkezdenénk trükközni, készítsünk biztonsági másolatot a telefonunkról, hogy ne veszítsünk el semmilyen adatot róla.</p>
                        
                    <p>Először próbáljuk meg a jó öreg ki- és bekapcsolatást, ami gyakran megoldás lehet technikai gondokra.</p>
                        
                    <p>Az iPhone X, XS, 11, 12 vagy 13 tartomány esetén tartsuk lenyomva a bekapcsológombot és az egyik hangerőszabályzót, amíg a bekapcsológomb meg nem jelenik a képernyőn. Ha iPhone SE, 8, 7, 6, S-változatai vagy régebbi iPhone-unk van, csak a bekapcsológombot kell lenyomni és lenyomva tartani.</p>
                    </div>
                </div>
            </div>
            <div class="hirek-article">
                <div class="hirek-article-img kozepre-igazit">
                    <img src="../Assets/Sifu.jpg" alt="HogwartsLegacy">
                </div>
                <div class="hirek-article-body">
                    <div class="hirek-article-cim">
                    <h2 class="hirek-h2">Hamarosan Steamre és Xboxra is ellátogat a Sifu</h2>
                    </div>
                    <div class="hirek-article-leiras">
                    <p>Kétségkívül 2022 egyik legjobb indie címe volt a Sifu, viszont a platform-exkluzivitással kapcsolatos megegyezések miatt több millió játékos nem tudta kipróbálni azt. Szerencsére ez hamarosan megváltozik, ugyanis a Sifu belátható időn belül Steamen és Xbox konzolokon is elérhetővé válik.
                        A Sifu tavaly jelent meg PlayStation konzolokra, valamint PC-re az Epic Games Store-ban, de az év vége felé Switchre is kiadták. A Sloclap most megerősítette, hogy a játék március 28-ától Steamen és Xboxon is kapható lesz.</p>

                    <p>Jelenleg PS4, PS5, Epic Games Store és a Nintendo Switch szerepel a támogatott platformok listáján. Az új platformokon való debütálás egybefügg az új bővítménnyel (Arenas), amely ingyenes frissítésként válik majd elérhetővé az összes platformon. A kiegészítő 9 új helyszínt tartalmaz, valamint 45 további kihívást ad hozzá 5 játékmódhoz. A fejlesztőcsapat szerint körülbelül 10 órányi extra játékidőről van szó.</p>
                    
                    </div>
                </div>
            </div>
            <div class="hirek-article">
                <div class="hirek-article-img kozepre-igazit">
                    <img src="../Assets/AC.jpg" alt="HogwartsLegacy">
                </div>
                <div class="hirek-article-body">
                    <div class="hirek-article-cim">
                    <h2 class="hirek-h2">Többjátékos Assassin's Creed címeken dolgozhat a Ubisoft</h2>
                    </div>
                    <div class="hirek-article-leiras">
                    <p>Az elmúlt években az Assassin's Creeden kívül sajnos nem igazán volt kimagasló játéka a Ubisoftnak. Bár több különböző címet is kiadtak, ezek nem tudták felvenni a versenyt az AC népszerűségével, és úgy tűnik, emiatt teljes egészében erre a szériára fognak fókuszálni.</p>
                    <p>Az Assassin's Creed korábban minden évben visszatért, de egy idő után elfáradt a széria. A rajongók is azt szerették volna, hogy a cég több időt szánjon játékai kidolgozására, és így születtek meg a sokkal nagyobb világgal és rengeteg tartalommal teletömött Assassin's Creed RPG-k. Az AC-játékok központjaként emlegetett Assassin's Creed Infinity megjelenésével jönnek majd az újabb, hasonlóan nagy változások. Az Insider Gaming információi szerint ez még csak a kezdet lesz, mivel az ismert projekteken felül is készülőben van még néhány, elsősorban többjátékos Assassin's Creed.</p>
                    <p>Sajnos a Ubisoft hivatalosan még semmit sem erősített meg a fentiekből, de 2022 szeptemberében négy, fejlesztés alatt álló Assassin's Creedről is lerántotta a leplet, melyek között ott lapul az idén érkező Assassin's Creed Mirage is. Ahogy korábban említettem, a cég két Infinity kampányon is dolgozik, melyek közül az egyik Japánban fog játszódni, vagyis egy olyan helyszínen, amelyre a rajongók már régóta vágytak. Mindezeken felül Assassin's Creed Nexus néven egy VR-cím is érkezik majd, illetve egy F2P spin-offot is kapni fogunk okostelefonokra.</p>
                    </div>
                </div>
            </div>
            <div class="hirek-article">
                <div class="hirek-article-img kozepre-igazit">
                    <img src="../Assets/Diablo.jpg" alt="HogwartsLegacy">
                </div>
                <div class="hirek-article-body">
                    <div class="hirek-article-cim">
                    <h2 class="hirek-h2">Jövő hónapban indul a Diablo 4 nyílt bétája</h2>
                    </div>
                    <div class="hirek-article-leiras">
                    <p>A Blizzard bejelentette a Diablo 4 nyílt béta fázisának időpontjait, melynek köszönhetően hónapokkal a megjelenés előtt teljesen ingyen kipróbálhatjátok a játékot. Emellett megosztották velünk a nyitányt, amely természetesen a béta változatban is megtekinthető lesz.</p>
                    <p>Az elmúlt hónapokban a Blizzard több zárt bétatesztre is sort kerített már, amely számos szivárgáshoz is vezetett. Szerencsére márciusban mindenki kipróbálhatja majd a játékot, így nem kell ezekre támaszkodnotok, ha kíváncsiak vagytok rá, hogy pontosan mit sikerült a fejlesztőknek összehozniuk.</p>
                    <p>Hacsak az utolsó pillanatban nem kerül sor halasztásra, a Diablo 4 június 6-án válik majd elérhetővé PC-re és konzolokra.</p>
                    </div>
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