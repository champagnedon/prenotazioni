<?php
    if (session_status() === PHP_SESSION_NONE) {
        ob_start();
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["redirect"] = "index.php";
        if(isset($_SESSION["logged"]) == false){
            $_SESSION["logged"] = false;
        }
    }
    $conn = require_once("components/conn.php");
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Donat Ticket - Prenotazioni Easy.</title>
        <link rel="stylesheet" href="style/css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="src/script.js"></script>
    </head>
    <body>
        <?php
            echo require_once("components/header.php");
        ?>
        <main>
            <section id="home">
                <div id="logo"><span><i><p>TICKET <b>DON</b>E</p></i></span></div>
                <p id="slogan">PRENOTA LA TUA ESPERIENZA PREFERITA</p>
                <br>
                <a href="#">
                    <button class="first">Prenota biglietti</button>
                </a>
            </section>
            <section id="concerti">
                <div class="descrizione">
                    <div>
                        <span><i><b>CONCERTI</b> DEL MOMENTO</i></span>
                        <p>Scopri i concerti più emozionanti in programma. Non perdere l'opportunità di vivere esperienze uniche e indimenticabili. Dai un'occhiata alla nostra vetrina e prenota i tuoi biglietti ora!</p>
                        <a href="#">
                            <button class="first">Per saperne di più</button>
                        </a>
                    </div>
                </div>
                <div class="vetrina">
                    <div class="slideshow-container">
                        <?php
                            $sql = 'SELECT c.id,c.nome,c.data,c.path,s.nome AS nomeSpazio,s.location AS location,a.stageName AS stageName  FROM tconcerto AS c JOIN tspazio AS s ON c.spazio = s.id JOIN tartista AS a ON c.idArtista = a.id LIMIT 10;';
                            $rec = mysqli_query($conn, $sql);
                            while($res = mysqli_fetch_array($rec)){
                                echo '
                                    <div class="slides-concerti fade"
                                        style="background-image: url('.$res["path"].');"
                                    >
                                        <figcaption>
                                            <i><h1>'.$res["nome"].'</h1></i>
                                            <p><i class="fas fa-map-marker-alt"></i>'.$res["nomeSpazio"].' - '.$res["location"].'</p>
                                            <p><i class="far fa-calendar-alt"></i>'.date("d/m/y", strtotime($res["data"])).'</p>
                                            <p><i class="far fa-clock"></i>'.date("h:i", strtotime($res["data"])).'</p>
                                            <br>
                                            <a href="prenota.php?id='.$res["id"].'">
                                                <button class="first">Prenota biglietti</button>
                                            <a/>
                                        </figcaption>
                                    </div>
                                ';
                            }
                        ?>
                        <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
                    </div>
                </div>
            </section>
            <section id="artisti">
                <div class="vetrina">
                    <div class="slideshow-container">
                        <?php
                            $sql = 'SELECT * FROM tartista LIMIT 10';
                            $rec = mysqli_query($conn, $sql);
                            while($res = mysqli_fetch_array($rec)){
                                echo '
                                    <div class="slides-artisti fade"
                                        style="background-image: url('.$res["path"].');"
                                    >
                                        <figcaption>
                                            <i><h1>'.$res["stageName"].'</h1></i>
                                            <br>
                                            <p>'.$res["descrizione"].'</p>
                                        </figcaption>
                                    </div>
                                ';
                            }
                        ?>
                        <a class="prev" onclick="plusSlides(-1, 1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1, 1)">&#10095;</a>
                    </div>
                </div>
                <div class="descrizione">
                    <div>
                        <span><i><b>ARTISTI</b> DEL MOMENTO</i></span>
                        <p>Esplora gli artisti più talentuosi del momento. Entra nel loro mondo e lasciati trasportare dalla loro musica e dalle loro performance straordinarie. Guarda i prossimi spettacoli e prenota subito!</p>
                        <a href="#">
                            <button class="first">Per saperne di più</button>
                        </a>
                    </div>
                </div>
            </section>
        </main>
        <?php
            echo require_once("components/footer.php");
        ?>
    </body>
</html>