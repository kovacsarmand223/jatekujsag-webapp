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

    if(isset($_POST['jatekKereso'])){
        //jatekkereses megvalositasa
        //kulcsszavak alapjan
        //kategoriak alapjan
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
    

    <!--ha lefele gorgetunk, akkor ez kisebb lesz-->
    <div class="main-udv-h2">
        <h2>Üdvözöljük 
            <?php 
                //if function, csak akkor ha be van jelentkezve, maskent ne hajtsa ezt vegre, mert hibat okoz!
                if($bejelentkezett){
                    echo "<span style='color:grey;'>" . $_SESSION['FelhasznaloNev'] . '</span>';
                }
            ?>
        a Játékújságban!</h2>
        <?php
            echo '<pre style="color: red;">' . print_r($_SESSION['adattorles-szoveg'], TRUE) . '</pre>';
        ?>
    </div>


    <!--tartalom-->
    <main class="fooldal-tartalom">
        <div class="container">
            <article class="fooldal-cikk">
                <img src="../Assets/TLOU.jpg" alt="HogwartsLegacy">
                <h2>Last of Us Part 1</h2>
                <p>Az összesen több mint 500 Év Játéka díjat elnyert The Last of Us sorozatot a kritikusok érzelmes történetmesélése, felejthetetlen karakterei és feszültséggel teli akciókaland-játékmenete miatt éltetik.</p>
                <div class="teljes-szoveg" >
                    <h2>Last of Us Part 1</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>AMD Ryzen 5 1500X, Intel Core i7-4770K</td>
                            <td>16 GB RAM</td>
                            <td>AMD Radeon 470 (4 GB), NVIDIA GeForce GTX 970 (4 GB), NVIDIA GeForce 1050 Ti (4 GB)</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>100 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>AMD Ryzen 5 3600X, Intel Core i7-8700</td>
                            <td>16 GB RAM</td>
                            <td>AMD Radeon RX 5800 XT (8 GB), AMD Radeon RX 6600 XT (8 GB), NVIDIA GeForce RTX 2070 SUPER (8 GB), NVIDIA GeForce RTX 3060 (8 GB)</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>100 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>
            <article class="fooldal-cikk">
                <img src="../Assets/EldenRing.jpg" alt="Elden Ring">
                <h2>Elden Ring</h2>
                <p>Az Elden Ring egy várva várt akció-szerepjáték, amelyet a FromSoftware, a Bloodborne és a Dark Souls fejlesztője készít. A játékot a híres fantasy szerző, George R.R. Martin és Hidetaka Miyazaki, a FromSoftware alapítója közösen írta.</p>
                <div class="teljes-szoveg">
                    <h2>Elden Ring</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>INTEL CORE I5-8400, AMD RYZEN 3 3300X </td>
                            <td>12 GB RAM</td>
                            <td>NVIDIA GEFORCE GTX 1060 3 GB, AMD RADEON RX 580 4 GB</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>60 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> INTEL CORE I7-8700K, AMD RYZEN 5 3600X</td>
                            <td>16 GB RAM</td>
                            <td>NVIDIA GEFORCE GTX 1070 8 GB, AMD RADEON RX VEGA 56 8 GB</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>60 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>
            <article class="fooldal-cikk">
                <img src="../Assets/HogwartsLegacy.jpg" alt="HogwartsLegacy">
                <h2>Hogwarts Legacy</h2>
                <p>A Hogwarts Legacy egy varázslatos akció-szerepjáték, amely a Harry Potter világában játszódik, ahol a játékosok létrehozhatnak saját varázsló karaktert, tanulhatnak a Roxfortban miközben felfedezik a varázslatos világot és harcolnak a sötét erőkkel szemben.</p>
                <div class="teljes-szoveg">
                    <h2>Hogwarts Legacy</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>Intel Core i5-6600, AMD Ryzen 5 1400</td>
                            <td>16 GB RAM</td>
                            <td>NVIDIA GeForce GTX 960 4GB or AMD Radeon RX 470 4GB</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>85 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> Intel Core i7-8700, AMD Ryzen 5 3600</td>
                            <td>16 GB RAM</td>
                            <td>NVIDIA GeForce 1080 Ti or AMD Radeon RX 5700 XT or INTEL Arc A770</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>85 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>

            <article class="fooldal-cikk">
                <img src="../Assets/REV.jpg" alt="Resident Evil Village">
                <h2>Resident Evil Village</h2>
                <p>A Resident Evil Village egy akció-kalandjáték, amelyben a játékosok Ethan Winters karakterét irányítják, aki egy kísérteties faluban próbálja megmenteni lányát. A játék a Resident Evil sorozat legújabb része, és lenyűgöző vizuális stílussal, izgalmas játékmenettel és rémisztő ellenfelekkel rendelkezik.</p>
                <div class="teljes-szoveg">
                    <h2>Resident Evil Village</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>AMD Ryzen 3 1200, Intel Core i5-7500</td>
                            <td>8 GB RAM</td>
                            <td>AMD Radeon RX 560 with 4GB VRAM, NVIDIA GeForce GTX 1050 Ti with 4GB VRAM</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>28 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> Intel Core i7-8700, AMD Ryzen 5 3600</td>
                            <td>16 GB RAM</td>
                            <td>NVIDIA GeForce 1080 Ti or AMD Radeon RX 5700 XT or INTEL Arc A770</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>28 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>

            <article class="fooldal-cikk">
                <img src="../Assets/cp2077.jpg" alt="Cyberpunk 2077">
                <h2>Cyberpunk 2077</h2>
                <p>A Cyberpunk 2077 egy nyitott világú akció-kalandjáték, amely a jövőbeli Night City-ben játszódik. A játékosok testre szabható karakterüket irányíthatják, miközben bejárják a várost, teljesítenek küldetéseket és harcolnak a frakciókkal.</p>
                <div class="teljes-szoveg">
                    <h2>Cyberpunk 2077</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>Intel Core i5-3570K, AMD FX-8310</td>
                            <td>8 GB RAM</td>
                            <td>NVIDIA GeForce GTX 970, AMD Radeon RX 470</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>70 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>  Intel Core i7-4790, AMD Ryzen 3 3200G</td>
                            <td>16 GB RAM</td>
                            <td> GTX 1060 6GB, GTX 1660 Super, Radeon RX 590</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>70 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>

            <article class="fooldal-cikk">
                <img src="../Assets/MHW.jpg" alt="Monster Hunter World">
                <h2>Monster Hunter: World</h2>
                <p>A Monster Hunter: World egy akció-szerepjáték, amelyben a játékosok szörnyekkel küzdenek, hogy erősebb felszerelést szerezzenek és további küldetéseket teljesítsenek. A játék lenyűgözően részletes világgal rendelkezik, és az egyedi fegyverek és felszerelések testreszabásával lehetőséget biztosít a játékosoknak a saját játékstílusuk kialakítására.</p>
                <div class="teljes-szoveg">
                    <h2>Monster Hunter: World</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> Intel Core i5 4460, Core i3 9100F, AMD FX-6300, Ryzen 3 3200G</td>
                            <td>8 GB RAM</td>
                            <td>NVIDIA®GeForce GTX 760, GTX1050 or AMD Radeon R7 260x, RX 560</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>52 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> Intel Core i7 3770, Core i3 8350, Core i3 9350F, AMD Ryzen 5 1500X, Ryzen 5 3400G</td>
                            <td>8 GB RAM</td>
                            <td>NVIDIA GeForce GTX 1060, GTX 1650, AMD Radeon RX 480, RX 570</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>52 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>
            </article>
            <article class="fooldal-cikk">
                <img src="../Assets/GTA.jpg" alt="Monster Hunter World">
                <h2>GRAND THEFT AUTO 5</h2>
                <p>Welcome to Los Santos
                    When a young street hustler, a retired bank robber, and a terrifying psychopath find themselves entangled with some of the most frightening and deranged elements of the criminal underworld, the U.S. government, and the entertainment industry, they must pull off a series of dangerous heists to survive in a ruthless city in which they can trust nobody — least of all each other.</p>
                <div class="teljes-szoveg">
                    <h2>Monster Hunter: World</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> Intel Core i5 4460, Core i3 9100F, AMD FX-6300, Ryzen 3 3200G</td>
                            <td>8 GB RAM</td>
                            <td>NVIDIA®GeForce GTX 760, GTX1050 or AMD Radeon R7 260x, RX 560</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>52 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> Intel Core i7 3770, Core i3 8350, Core i3 9350F, AMD Ryzen 5 1500X, Ryzen 5 3400G</td>
                            <td>8 GB RAM</td>
                            <td>NVIDIA GeForce GTX 1060, GTX 1650, AMD Radeon RX 480, RX 570</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>52 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>
            
            
            <article class="fooldal-cikk">
                <img src="../Assets/cp2077.jpg" alt="Cyberpunk 2077">
                <h2>Cyberpunk 2077</h2>
                <p>A Cyberpunk 2077 egy nyitott világú akció-kalandjáték, amely a jövőbeli Night City-ben játszódik. A játékosok testre szabható karakterüket irányíthatják, miközben bejárják a várost, teljesítenek küldetéseket és harcolnak a frakciókkal.</p>
                <div class="teljes-szoveg">
                    <h2>Cyberpunk 2077</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>Intel Core i5-3570K, AMD FX-8310</td>
                            <td>8 GB RAM</td>
                            <td>NVIDIA GeForce GTX 970, AMD Radeon RX 470</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>70 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>  Intel Core i7-4790, AMD Ryzen 3 3200G</td>
                            <td>16 GB RAM</td>
                            <td> GTX 1060 6GB, GTX 1660 Super, Radeon RX 590</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>70 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>
            <article class="fooldal-cikk">
                <img src="../Assets/REV.jpg" alt="Resident Evil Village">
                <h2>Resident Evil Village</h2>
                <p>A Resident Evil Village egy akció-kalandjáték, amelyben a játékosok Ethan Winters karakterét irányítják, aki egy kísérteties faluban próbálja megmenteni lányát. A játék a Resident Evil sorozat legújabb része, és lenyűgöző vizuális stílussal, izgalmas játékmenettel és rémisztő ellenfelekkel rendelkezik.</p>
                <div class="teljes-szoveg">
                    <h2>Resident Evil Village</h2>
                    <p>Minimum gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td>AMD Ryzen 3 1200, Intel Core i5-7500</td>
                            <td>8 GB RAM</td>
                            <td>AMD Radeon RX 560 with 4GB VRAM, NVIDIA GeForce GTX 1050 Ti with 4GB VRAM</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>28 GB available space</td>
                        </tr>
                    </table>
                    <p>Ajánlott gépigény: </p>
                    <table class="fooldal-tablazat">
                        <tr>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td> Intel Core i7-8700, AMD Ryzen 5 3600</td>
                            <td>16 GB RAM</td>
                            <td>NVIDIA GeForce 1080 Ti or AMD Radeon RX 5700 XT or INTEL Arc A770</td>
                            <td>Windows 10 64-bit, Version 1909 or Newer</td>
                            <td>28 GB available space</td>
                        </tr>
                    </table>
                </div>
                <a class="teljes-szoveg-gomb">Tovább olvasom</a>

            </article>
        </div>
    </main>

    <script>
        const buttons = document.querySelectorAll('.fooldal-cikk .teljes-szoveg-gomb');

        //Ez egy overlay-t csinál, amire kerül egy modal,
        // amin kívül ha kattintunk akkor nullázódik az overlay és a modal is,
        // így eltűnik, minden egyes cikknek külön szöveg jelenik meg
        

        buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const article = button.closest('.fooldal-cikk');
            const overlay = document.createElement('div');
            overlay.classList.add('overlay');
            const modal = document.createElement('div');
            modal.classList.add('modal');
            const content = article.querySelector('.teljes-szoveg').innerHTML;
            modal.innerHTML = content;
            overlay.appendChild(modal);
            document.body.appendChild(overlay);
            window.overlay = overlay;
            window.modal = modal;
        });
        });

        //Ez az eventkezelő pedig csinálja meg azt, hogy eltűnik az overlay
        
        document.addEventListener('click', (event) => {
        if (event.target === window.overlay || event.target.classList.contains('close')) {
            window.overlay.remove();
            window.overlay = null;
            window.modal = null;
        }
        });
	</script>
    <!--lablec-->
    <footer>
        <p>GameSpace &copy; 2023</p>
        <p>Kovács Armand</p>
        <p>Tabajdi Kornél</p>
    </footer>
</body>
</html>
    
