<?php
    require_once 'dbconnect.php';
    $connection = mysqli_connect($server, $user, $password, $db) or die("Błąd połączenia");

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hodowla świnek morskich</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div>
        <header>
            <h1>Hodowla świnek morskich - zamów
            świnkowe maluszki</h1>
        </header>
        <main>
            <nav>
                <a href="peruwianka.php">Rasa Peruwianka</a>
                <a href="american.php">Rasa American</a>
                <a href="crested.php">Rasa Crested</a>
            </nav>
            <article>
                <img src="peruwianka.jpg" alt="Świnka morska rasy peruwianka">
                <?php
                    $query = "select distinct s.data_ur, s.miot, r.rasa from swinki s join
rasy r on r.id = s.rasy_id where r.id = 1";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                        <h2>Rasa: ".$row['rasa']."</h2>
                        <p>Data urodzenia: ".$row['data_ur']."</p>
                        <p>Oznaczenie miotu: ".$row['miot']."</p>
                    ";
                ?>
                <hr>
                <h2>Świnki w tym miocie</h2>
                <?php
                    $query = "select imie, cena, opis from swinki where rasy_id = 1;";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <h3>".$row['imie']." - ".$row['cena']." zł</h3>
                        <p>".$row['opis']."</p>
                        ";
                    }

                    
                ?>
            </article>
        </main>
        <aside>
            <h3>Poznaj wszystkie rasy świnek morskich</h3>
            <ol>
                <?php
                    $query = "select rasa from rasy;";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<li>'.$row['rasa'].'</li>';
                    }
                ?>

            </ol>

        </aside>
        <footer>
            <p>Stronę wykonał: Piotr Zarzycki</p>
        </footer>
    </div>
    <?php
    mysqli_close($connection)
    ?>
</body>
</html>
