<?php
include "includes/db_inc.php";
include "includes/utility/SecurePassword.php";
include 'includes/html_start_inc.php';

if (isset($_SESSION[USER])) {
    $errorCookie = "errorMessage";
    $errorCookieValue = "U bent al ingelogd!";
    setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
    header('location: index.php');
}

$data['email'] = '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST) {
        $data = $_POST;


        $data['userName'] = trim($data['userName']);
        if (empty($data['userName'])) {
            $errors['email'] = 'Username veld is verplicht!';
        }
        if (empty($data['password'])) {
            $errors['password'] = 'Paswoord veld is verplicht!';
        }
        if (empty($errors)) {

            $query = 'SELECT * FROM user WHERE username=:username';
            $stmt = $db->prepare($query);

            $stmt->execute([
                'username' => $data['userName']
            ]);

            $result = $stmt->fetch();

            if (isset($result)) {
                $userValid = SecurePassword::validatePassword($result['salt'], $result['password'], $data['password']);
                if ($userValid) {
                    $_SESSION[USER] = $result['username'];
                    header('location: admin/index.php');
                }
            }
            if (!isset($_SESSION[USER])) {
                $errors['algemeen'] = 'De login gegevens kloppen niet! Probeer opnieuw.';
            }
        }
    }
}
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        Er zijn <strong>foutmeldingen</strong> gevonden:

        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php print $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif ?>

<form method="post">
    <div class="form-group">
        <label class="title" for="userName">Gebruikersnaam</label>
        <input type="text" name="userName" id="userName" placeholder="Gebruikersnaam" class="form-control"
               value="<?php print (isset($data['userName']) ? $data['userName'] : ''); ?>">
    </div>

    <div class="form-group">
        <label class="title" for="inputPassword">Paswoord</label>
        <input type="password" name="password" id="inputPassword" placeholder="Paswoord" class="form-control">
    </div>

    <input type="submit" value="Inloggen">

</form>

<?php

include 'includes/html_stop_inc.php';
?>
