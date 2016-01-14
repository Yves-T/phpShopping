<?php
include 'includes/html_start_inc.php';
include 'includes/formatFunctions_inc.php';
//de naam van het tekstbestand in een variabele steken
$textfile = "gastenboek.txt";

//controleren of de gebruiker op de pagina komt na het invullen van het formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["naam"], $_POST["commentaar"], $_POST["email"])) {
        $oudeinhoud = '';
        $commentaar = $_POST["commentaar"];
        $naam = $_POST["naam"];
        $email = $_POST["email"];

        if ($naam != "" && $email != "" && $commentaar != "") {
            $pointer = fopen($textfile, "r+b");
            if (file_exists($textfile) && filesize($textfile) > 0) {
                $oudeinhoud = fread($pointer, filesize($textfile));
            }
            // day month year
            $date = date("j - n - Y");
            $bericht = "<p><strong>" . $naam . "</strong> (" . $email;
            $bericht .= ") heeft geschreven op <i>" . $date . "</i> : </p>" . $commentaar . "<hr />";
            rewind($pointer);
            fputs($pointer, $bericht . "\n" . $oudeinhoud . "\n");
        }

    }
}

?>
<div class="container">
    <h2>Een eenvoudig gastenboek</h2>
            <form method="post">
                <div class="form-group">
                    <label for="naam">Naam:</label>
                    <input id="naam" name="naam" type="text" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="text" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="commentaar">Commentaar:</label>
                    <textarea id="commentaar" cols="50" rows="5" name="commentaar" class="form-control"></textarea>
                    <script>
                        CKEDITOR.replace('commentaar', {
                                filebrowserBrowseUrl: 'lib/Filemanager/index.html',
                                filebrowserWindowWidth: '1000',
                                filebrowserWindowHeight: '480'
                            }
                        );
                    </script>
                </div>
                <input value="Verzenden" type="submit" class="btn btn-default"/>
            </form>



            <h2>Achtergelaten berichtjes:</h2>


            <?php
            //de inhoud van het tekstbestand afdrukken
            if (file_exists($textfile) && filesize($textfile) > 0) {
                readfile($textfile);
            }
            ?>

</div>
<?php

include 'includes/html_stop_inc.php';
?>
