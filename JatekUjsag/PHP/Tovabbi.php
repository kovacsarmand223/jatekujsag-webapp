<?php
    include "serverkapcs.php";
    session_start();

    // Ha be van jelentkezve
    $bejelentkezett = false;
    if (!isset($_SESSION['FelhasznaloNev'])) {
        header('Location: Fooldal.php');
        exit;
    }else{
        $bejelentkezett = true;
    }

    if(isset($_GET['action']) && $_GET['action'] == 'kijelentkezes') {
        // Ha a kijelentkezes gomb meg lett nyomva
        session_destroy();
        session_unset();
        
        // Visszakuldi a Login.php-ra es torli a szkriptet
        header('Location: Login.php');
        exit;
    }
    
    $error = array();
    $error_geptorles = array();
    $error_adatmodositas = array();
    $error_kepfeltoltes = array();

    $_SESSION['gep-torles-szoveg'] = '';
    $_SESSION['gep-hozzaad-szoveg'] = '';
    $_SESSION['adatmodositas-szoveg'] = '';
    $_SESSION['adattorles-szoveg'] = '';
    $_SESSION['kepfeltoltes-szoveg'] = '';
    
    if(isset($_POST['profilTorles'])){
        //kijelentkezes
        //header fooldal
        $query = "DELETE FROM felhasznalo WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}'";

        $result = mysqli_query($conn, $query);

        if(!$result){
            die(mysqli_error($conn));
        }else{
            $_SESSION['adattorles-szoveg'] = 'A felhasználói profilt sikeresen törölted!';
            
            session_destroy();

            header('Location: Fooldal.php');
        
        }

        
    }

    if(isset($_POST['kepfeltolt'])){
        $kepnev = $_FILES["kep"]["name"];
        $tempnev = $_FILES["kep"]["tmp_name"];
        $kepek = "../ASSETS/" . $kepnev;

        $query = "UPDATE felhasznalo SET 
        kep = IF(LENGTH('{$kepnev}') > 0, '{$kepnev}', kep)
        WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}'";

        $result = mysqli_query($conn, $query);
        
        if(!empty($_FILES['kep']['name'])){
            if(!$result){
                die(mysqli_error($conn));
            }else{
                //ha sikerult feltolteni akkor ->
                if(move_uploaded_file($tempnev, $kepek)){
                    $_SESSION['kepfeltoltes-szoveg'] = "Sikerült a mappába helyezni!";
                }else{
                    $error_kepfeltoltes[] = 'Nem sikerült a képet az ASSETS mappába áthelyezni!';
                }
            }
        }
    }

    if(isset($_POST['profiladatGomb'])){
        $felhasznalo = $_POST['Felhasznalonev'];
        $email = $_POST['Emailcim'];
        $csaladnev = $_POST['Csaladnev'];
        $keresztnev = $_POST['Keresztnev'];
        $szuletesidatum = $_POST['SzuletesiDatum'];
        $telefonszam = $_POST['Telefonszam'];
        $lakhely = $_POST['Lakhely'];
        $foglalkozas = $_POST['Foglalkozas'];

        if(empty($felhasznalo) && empty($email) && empty($csaladnev) && empty($keresztnev) && empty($szuletesidatum) && empty($telefonszam) && empty($lakhely) && empty($foglalkozas)){
            $error_adatmodositas[] = 'Nem módosított egy adatot sem!';
        }

        $sql_fhsz = "SELECT * FROM felhasznalo WHERE FelhasznaloNev='{$felhasznalo}'";
        $sql_email = "SELECT * FROM felhasznalo WHERE EmailCim='{$email}'";
        
        $van_fhsz = mysqli_query($conn, $sql_fhsz);
        $van_email = mysqli_query($conn, $sql_email);

        if(mysqli_num_rows($van_fhsz) != 0){
            $error_adatmodositas[] = "Ez a falhasználónév már foglalt!";
        }

        if(mysqli_num_rows($van_email) != 0){
            $error_adatmodositas[] = "Ez az email már foglalt!";
        }
        

        if(count($error_adatmodositas) == 0){
        
            $query = "UPDATE felhasznalo SET
            FelhasznaloNev = IF(LENGTH('{$felhasznalo}') > 0, '{$felhasznalo}', FelhasznaloNev),
            EmailCim = IF(LENGTH('{$email}') > 0, '{$email}', EmailCim),
            Csaladnev = IF(LENGTH('{$csaladnev}') > 0, '{$csaladnev}', Csaladnev),
            Keresztnev = IF(LENGTH('{$keresztnev}') > 0, '{$keresztnev}', Keresztnev),
            SzuletesiDatum = IF(LENGTH('{$szuletesidatum}') > 0, '{$szuletesidatum}', SzuletesiDatum),
            Telefonszam = IF(LENGTH('{$telefonszam}') > 0, '{$telefonszam}', Telefonszam),
            Lakhely = IF(LENGTH('{$lakhely}') > 0, '{$lakhely}', Lakhely),
            Foglalkozas = IF(LENGTH('{$foglalkozas}') > 0, '{$foglalkozas}', Foglalkozas)
            WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}'";
            
            //ha nem adunk meg a felhasznalonak nevet modositaskor akkor lenullazza.
            if(!empty($felhasznalo)){
                $_SESSION['FelhasznaloNev'] = $felhasznalo;
            }

            $result = mysqli_query($conn, $query);

            if(!$result){
                die(mysqli_error($conn));
            }else{
                $_SESSION['adatmodositas-szoveg'];
            }

        }

    }

    if(isset($_POST['geptorlesGomb'])){
        $geptorles = $_POST['geptorles'];
        if(empty($geptorles)){
            $error_geptorles[] = 'Nem adott meg egy gépnevet!';
        }
       
        $sql_gepnev = "SELECT * FROM gep WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}' and Gepnev='{$geptorles}'";
        $van_gepnev = mysqli_query($conn, $sql_gepnev);

        if(mysqli_num_rows($van_gepnev) == 0){
            $error_geptorles[] = 'Nincs ilyen géped!';
        }

        /*
            Delete funkcio megvalositas
            $sql = "DELETE FROM gep WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}' AND `Gepnev` = '$Gepnev'"
        */

        if(count($error_geptorles) == 0){
            $query = "DELETE FROM gep WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}' AND Gepnev = '{$geptorles}'";
            $results = mysqli_query($conn, $query);
            if (!$results) {
                die(mysqli_error($conn));
            }else{
                $_SESSION['gep-torles-szoveg'];
            }
        }


    }

    if(isset($_POST['ujgepGomb'])){
        
        $gepnev = $_POST['gepnev'];
        $cpu = $_POST['cpu'];
        $gpu = $_POST['gpu'];
        $ram = $_POST['ram'];
        $os = $_POST['os'];
        $storage = $_POST['storage'];

        if(empty($gepnev) || empty($cpu) || empty($gpu) || empty($ram) || empty($os) || empty($storage)){
            $error[] = 'Nem sikerült az új gép feltőltése. Kihagyott kötelező mezőket!';
        }
        $sql_gepnev = "SELECT * FROM gep WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}' and Gepnev='{$gepnev}'";
        $van_gepnev = mysqli_query($conn, $sql_gepnev);

        if(mysqli_num_rows($van_gepnev) != 0){
            $error[] = 'Ez a gépnév már foglalt! Kérem válasszon egy másikat!';
        }

        if(count($error) == 0){
            
            $query = "INSERT INTO gep(FelhasznaloNev, EmailCim, Gepnev, OS, RAM, GPU, CPU, STORAGE) 
            VALUES('{$_SESSION['FelhasznaloNev']}', '{$_SESSION['EmailCim']}', '{$gepnev}', '{$cpu}', '{$gpu}', '{$ram}', '{$os}', '{$storage}')";
            $results = mysqli_query($conn, $query);
            if (!$results) {
                die(mysqli_error($conn));
            }
            $_SESSION['gep-hozzaad-szoveg'];
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
              <?php if ($bejelentkezett): ?>
                <li><a class="aktiv-gomb" href="Tovabbi.php" id="nav-tovabbi">Profil</a></li>
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
        <div class="profil-container">
            <div class="profil-article">
                <div>
                    <h1>Felhasználó</h1>
                </div>
                <div>
                    <div>
                    <table class="profil-tablazat">
                        <tr class="profil-tablazat">
                          <th>Felhasználó név</th>
                          <th>Emailcím</th>
                          <th>Családnév</th>
                          <th>Keresztnév</th>
                          <th>Születési dátum</th>
                          <th>Telefonszám</th>
                          <th>Lakhely</th>
                          <th>Foglalkozás</th>
                        </tr>
                        <?php
                        $query = "SELECT f.FelhasznaloNev, f.EmailCim, f.Csaladnev, f.Keresztnev, f.SzuletesiDatum, f.Telefonszam, f.Lakhely, f.Foglalkozas
                        FROM felhasznalo f
                        WHERE f.FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}'
                        GROUP BY f.FelhasznaloNev, f.EmailCim, f.Csaladnev, f.Keresztnev, f.SzuletesiDatum, f.Telefonszam, f.Lakhely, f.Foglalkozas;";

                        if (!empty($query)) {
                            $result = mysqli_query($conn, $query);
                        }
                        if ($result && mysqli_num_rows($result) != 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['FelhasznaloNev'] . '</td>';
                                echo '<td>' . $row['EmailCim'] . '</td>';
                                echo '<td>' . $row['Csaladnev'] . '</td>';
                                echo '<td>' . $row['Keresztnev'] . '</td>';
                                echo '<td>' . $row['SzuletesiDatum'] . '</td>';
                                echo '<td>' . $row['Telefonszam'] . '</td>';
                                echo '<td>' . $row['Lakhely'] . '</td>';
                                echo '<td>' . $row['Foglalkozas'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo $_SESSION['FelhasznaloNev'];
                            echo 'No results found.';
                        }
                    ?>
                    </table>
                    <button class = "profil-gomb adatmodositas-gomb" style= "float: left;">Adatok módosítása</button>
                    <button class="profil-gomb adattorles-gomb" style = "transform: translate(2%);">Adatok törlése</button>
                    </div>

                <div class="popup" id="popup" style="display: none; width: 200px;">
                <p>Biztosan törölni akarod a fiókod?</p>
                <form action="Tovabbi.php" method="POST" enctype="multipart/form-data"> 
                    <button type="submit" name="profilTorles" id="confirm" class="profil-gomb adattorles-gomb" style="float: left; margin-right: 20px; transform: translate(10%, 1%);">Biztosan</button>
                </form>
                <button id="cancel" class="profil-gomb" style="float: left;">Nem</button>
                </div>

                <script>
                    const torlesGomb1 = document.querySelector('.adattorles-gomb');
                    const popup = document.getElementById('popup');
                    const confirmBtn = document.getElementById('confirm');
                    const cancelBtn = document.getElementById('cancel');

                    torlesGomb1.addEventListener('click', () => {
                        popup.style.display = 'block';
                        document.body.style.overflow = 'hidden'; // to prevent scrolling
                    });

                    confirmBtn.addEventListener('click', () => {
                        // code to delete the account
                        popup.style.display = 'none';
                        document.body.style.overflow = 'auto'; // to enable scrolling
                    });

                    cancelBtn.addEventListener('click', () => {
                        popup.style.display = 'none';
                        document.body.style.overflow = 'auto'; // to enable scrolling
                    });
                </script>

                    <div>
                    <?php 
                    if(!empty($error_adatmodositas)) {
                        echo "<div class='error'>";
                        foreach($error_adatmodositas as $e) {
                            echo "<p style='color:red;'>" . $e . "</p>";
                        }
                        echo "</div>";
                    }if(isset($_POST['profiladatGomb']) && empty($error)){
                        $_SESSION['adatmodositas-szoveg'] = 'Adatok módosítva!';
                        echo '<pre style="color: red;">' . print_r($_SESSION['adatmodositas-szoveg'], TRUE) . '</pre>';
                    }
                    ?>
                    <form action = 'Tovabbi.php' method="POST" enctype="multipart/form-data">
                    <table class="profil-tablazat" id="profil-tablazat" style="display: none;">
                        <tr class="profil-tablazat">
                            <th>Felhasználó név</th>
                            <th>Emailcím</th>
                            <th>Családnév</th>
                            <th>Keresztnév</th>
                            <th>Születési dátum</th>
                            <th>Telefonszám</th>
                            <th>Lakhely</th>
                            <th>Foglalkozás</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="Felhasznalonev" style="width: 100%;"></td>
                            <td><input type="email" name="Emailcim"></td>
                            <td><input type="text" name="Csaladnev" ></td>
                            <td><input type="text" name="Keresztnev" ></td>
                            <td><input type="date" name="SzuletesiDatum" ></td>
                            <td><input type="text" name="Telefonszam" ></td>
                            <td><input type="text" name="Lakhely" ></td>
                            <td><input type="text" name="Foglalkozas" ></td>
                        </tr> 
                    </table>
                    <button type="submit" name="profiladatGomb" class="profil-gomb profiladat-gomb" style="display: none; float: left;">Adatok elküldése</button>
                    </form>
                    <button name="profiladat-gomb" class="profil-gomb profilvissza-gomb" style="display: none; transform: translate(3%);">Vissza</button>
                    </div>

                    <script>
                    const table = document.getElementById('profil-tablazat');
                    const modositasGomb = document.querySelector('.adatmodositas-gomb');
                    const torlesGomb = document.querySelector('.adattorles-gomb');
                    const profilGomb = document.querySelector('.profiladat-gomb');
                    const visszaGomb = document.querySelector('.profilvissza-gomb');

                    modositasGomb.addEventListener('click', () => {
                        table.style.display = (table.style.display === 'none') ? '' : 'none';
                        table.style.width = '100%';
                        modositasGomb.style.display = 'none';
                        torlesGomb.style.display = 'none';
                        profilGomb.style.display = 'block';
                        visszaGomb.style.display = 'block';
                    });

                    visszaGomb.addEventListener('click', () => {
                        table.style.display = 'none';
                        modositasGomb.style.display = 'block';
                        torlesGomb.style.display = 'block';
                        torlesGomb.style.transform = 'translate(2%, 1%)';
                        profilGomb.style.display = 'none';
                        visszaGomb.style.display = 'none';
                    });
                    </script>
                  <div>
                    <h1>Profilkép</h1>
                    <div id = "profilkep">
                    <?php
                    $query = "SELECT kep FROM felhasznalo WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}'";
                    $result = mysqli_query($conn, $query);

                    if(!$result){
                        die(mysqli_error($conn));
                    }else{
                        while($adat = mysqli_fetch_assoc($result)){
                            ?>
                            <img class="profilkep" alt="Profilkep" src="../ASSETS/<?php echo $adat['kep']; ?>">
                        <?php
                        }
                    }
                    if(!empty($error_kepfeltoltes)) {
                        echo "<div class='error'>";
                        foreach($error_kepfeltoltes as $e) {
                            echo "<p style='color:red;'>" . $e . "</p>";
                        }
                        echo "</div>";
                        $_POST = array();
                    }if(isset($_POST['kepfeltolt']) && empty($error_kepfeltoltes)){
                        $_SESSION['kepfeltoltes-szoveg'] = 'Sikeresen feltöltötte a képet!';
                        echo '<pre style="color: red;">' . print_r($_SESSION['kepfeltoltes-szoveg'], TRUE) . '</pre>';
                    }
                    ?>

                    
                    </div>
                  </div>
                    <form method="POST" action="Tovabbi.php" enctype="multipart/form-data">
                        <div>
                            <input type="file" name="kep">
                        </div>
                        <div>
                            <button class="profil-gomb" type="submit" name="kepfeltolt">Feltölt</button>
                        </div>
                    </form>
                  <div>
                    <div>
                        <h1>Eszköz</h1>
                    </div>
                    <?php
                    $query = "SELECT Gepnev, CPU, RAM, GPU, OS, STORAGE FROM gep WHERE FelhasznaloNev = '{$_SESSION['FelhasznaloNev']}'";
                    if(!empty($query)){
                        $result = mysqli_query($conn, $query);
                    }

                    if (mysqli_num_rows($result) != 0) {
                        echo '<table class="profil-tablazat">';
                        echo '<tr>
                        <th>Gépnév</th>
                        <th>CPU</th>
                        <th>RAM</th>
                        <th>GPU</th>
                        <th>OS</th>
                        <th>Storage</th>
                        </tr>';

                        // Vegig megy az osszes adaton
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['Gepnev'] . '</td>';
                            echo '<td>' . $row['CPU'] . '</td>';
                            echo '<td>' . $row['RAM'] . '</td>';
                            echo '<td>' . $row['GPU'] . '</td>';
                            echo '<td>' . $row['OS'] . '</td>';
                            echo '<td>' . $row['STORAGE'] . '</td>';
                            echo '</tr>';
                        }

                        echo '</table>';
                       if(!empty($error_geptorles)) {
                            echo "<div class='error'>";
                            foreach($error_geptorles as $e) {
                                echo "<p style='color:red;'>" . $e . "</p>";
                            }
                            echo "</div>";
                            $_POST = array();
                        }if(isset($_POST['geptorlesGomb']) && empty($error_geptorles)){
                            $_SESSION['gep-torles-szoveg'] = 'Adatok törölve!';
                            echo '<pre style="color: red;">' . print_r($_SESSION['gep-torles-szoveg'], TRUE) . '</pre>';
                        }
                        echo '<form action="Tovabbi.php" method="POST" style="display: inline-block;">';
                        echo '<div style="display: inline-block;">';
                        echo '<input type="text" name="geptorles" placeholder="Gépnév" style="width: 150px;">';
                        echo '</div>';
                        echo '<br>';
                        echo '<div style="display: inline-block;">';
                        echo '<button type = "submit" name="geptorlesGomb" class="profil-gomb adattorles-gomb" style="">Saját gép törlése</button>';
                        echo '</div>';
                        echo '</form>';
                    } else {
                        if(isset($_POST['geptorlesGomb']) && empty($error_geptorles)){
                            $_SESSION['gep-torles-szoveg'] = 'Adatok törölve!';
                            echo '<pre style="color: red;">' . print_r($_SESSION['gep-torles-szoveg'], TRUE) . '</pre>';
                        }
                        echo "<p style='color:red;'>" . "Nincsenek gépek!" . "</p>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                    
                  </div>
                  <form action="Tovabbi.php" method="POST">
                  <div>
                    <div>
                        <h1>Új eszköz</h1>
                    </div>
                    <div><?php 
                    if(!empty($error)) {
                        echo "<div class='error'>";
                        foreach($error as $e) {
                            echo "<p style='color:red;'>" . $e . "</p>";
                        }
                        echo "</div>";
                        $_POST = array();
                    }if(isset($_POST['ujgepGomb']) && empty($error)){
                        $_SESSION['gep-hozzaad-szoveg'] = 'Adatok elmentve!';
                        echo '<pre style="color: red;">' . print_r($_SESSION['gep-hozzaad-szoveg'], TRUE) . '</pre>';
                    }?> </div>
                    <table class="profil-ujgep-tablazat">
                        <tr>
                            <th>Gépnév</th>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>GPU</th>
                            <th>OS</th>
                            <th>Storage</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="gepnev" required></td>
                            <td><input type="text" name="cpu" required></td>
                            <td><input type="text" name="ram" required></td>
                            <td><input type="text" name="gpu" required></td>
                            <td><input type="text" name="os" required></td>
                            <td><input type="text" name="storage" required></td>
                        </tr>
                    </table>
                    <button type="submit" name="ujgepGomb" class="profil-gomb ujgep-gomb">Új gép hozzáadása</button>
                  </div>
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