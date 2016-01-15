<?php
include 'includes/db_inc.php';
include 'includes/html_start_inc.php';
include 'includes/formvalidation/FormValidation.php';
include 'includes/formatFunctions_inc.php';
//de naam van het tekstbestand in een variabele steken
$textfile = "gastenboek.txt";

$errors = [];

//controleren of de gebruiker op de pagina komt na het invullen van het formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST)) {
        $data = $_POST;
        $formValidation = new CommentFormValidation($data);

        $errors = $formValidation->validateForm();

        if (empty($errors)) {

            $oudeinhoud = '';
            $commentaar = $_POST["comment"];
            $naam = $_POST["name"];
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
}

?>
<div ng-app="shoppingApp">
    <div class="container" ng-controller="shoppingController as shopping">
        <?php
        include 'includes/formvalidation/formErrors.php';
        ?>

        <h2>Een eenvoudig gastenboek</h2>
        <div>
            <button class="btn btn-success" ng-click="shopping.toggleForm()">{{shopping.toggleText}}</button>
        </div>
        <div ng-show="shopping.isFormVisible()">
            <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                <div class="form-group">
                    <label for="naam">Naam:</label>
                    <input id="naam" name="name" type="text" class="form-control"
                           value="<?php print (isset($data['name']) ? $data['name'] : ''); ?>"
                    />
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input id="email" name="email" type="text" class="form-control"
                           value="<?php print (isset($data['email']) ? $data['email'] : ''); ?>"
                    />
                </div>
                <div class="form-group">
                    <label for="commentaar">Commentaar:</label>
                    <textarea id="commentaar" cols="50" rows="5" name="comment" class="form-control">
                           <?php print (isset($data['comment']) ? $data['comment'] : ''); ?>
                    </textarea>
                    <script>
                        CKEDITOR.replace('commentaar', {
                            language: 'nl'
                        });
                    </script>
                </div>
                <input value="Verzenden" type="submit" class="btn btn-default"/>
            </form>
        </div>

        <h2>Achtergelaten berichtjes:</h2>

        <script src="js/commentScript.js"></script>

        <div id="gastenBoek">
            <?php
            //de inhoud van het tekstbestand afdrukken
            if (file_exists($textfile) && filesize($textfile) > 0) {
                readfile($textfile);
            }
            ?>
        </div>

    </div>
</div>
<?php

include 'includes/html_stop_inc.php';
?>
