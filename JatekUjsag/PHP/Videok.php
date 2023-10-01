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
        header('Location: Videok.php');
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
              <li><a href="Hirek.php" id="nav-hirek">Hírek</a></li>
              <li><a href="Forum.php" class="nav-forum">Fórum</a></li>
              <li class="nav-leugro-videok">
                <a class="aktiv-gomb" href="Videok.php" id="nav-videok">Videók</a>
                <ul class="leugro-nav">
                  <li><a href="#gameplayek">Gameplayek</a></li>
                  <li><a href="#tesztek">Tesztek</a></li>
                  <li><a href="#ujdonsagok">Ujdonsagok</a></li>
                </ul>
              </li>
              <?php if ($bejelentkezett): ?>
                <li><a href="Tovabbi.php" class="nav-tovabbi">Profil</a></li>
                <li><a href="?action=kijelentkezes" name="kijelentkezes" class="nav-logout">Kijelentkezés</a></li>
              <?php endif; ?>
            </ul>
          </nav>
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
    <main class="videok-tartalom">
        <div class="alcimek-div">
            <h1 class="alcimek" id="gameplayek">Gameplayek</h1>
        </div>
        <div class="container">
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe
                class="reszponziv-embed-video"
                width="560"
                height="315"
                src="https://www.youtube.com/embed/w_FQhfpPeWw" 
                title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen></iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player"  
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe> 
            <!--ide jonnek az uj videok kulonbozo jatekokhoz, gameplayek, stb.-->
        </div>
        <div class="alcimek-div">
            <h1 class="alcimek" id="tesztek">Tesztek</h1>
        </div>
        <div class="container">
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe> 
            <!--ide jonnek az uj videok kulonbozo jatekokhoz, gameplayek, stb.-->
        </div>
        <div>
            <h1 class="alcimek" id="ujdonsagok">Újdonságok</h1>
        </div>
        <div class="container">
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe>
            <iframe class="reszponziv-embed-video"
                    width="560" 
                    height="315" 
                    src="https://www.youtube.com/embed/wNfZ8vJi4L8" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
            </iframe> 
            <!--ide jonnek az uj videok kulonbozo jatekokhoz, gameplayek, stb.-->
        </div>
    </main>
    <script>
            /*
            let gombArray = ['gameplayekGomb', 'tesztekGomb', 'ujdonsagokGomb'];
            let divArray = ['gameplayek', 'tesztek', 'ujdonsagok'];
            */
            const linkek = document.querySelectorAll('a[href^="#"]');

            linkek.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').slice(1);
                const targetElement = document.getElementById(targetId);
                targetElement.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start',
                    inline: 'center',
                    offset: 100
                 });
            });
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