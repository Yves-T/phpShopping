<?php
include 'includes/db_inc.php';
include 'includes/formvalidation/FormValidation.php';
include 'includes/fileFunctions.php';

$sql = 'SELECT * FROM product WHERE id=:id';
$stmt = $db->prepare($sql);

$stmt->execute([
    'id' => $_GET['id']
]);

$data = $stmt->fetch();

$errors = [];
if (!empty($_POST)) {
    $oldImage = $data['image'];
    $data = $_POST;

    $formValidation = new ProductFormValidation($data);

    $errors = $formValidation->validateForm();

    if (empty($errors)) {

        if (file_exists('productImages/' . $oldImage)) {
            unlink('productImages/' . $data['image']);
        }

        $imageBaseName = basename($_FILES['image']['name']);
        $tempName = $_FILES['image']['tmp_name'];
        $uploadDir = 'productImages/';
        $uploadFile = $uploadDir . $imageBaseName;
        if (!move_uploaded_file($tempName, $uploadFile)) {
            $errorCookie = "errorMessage";
            $errorCookieValue = "Er ging iets mis met het uploaden van het bestand";
            setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
            header('location:index.php');
            exit();
        }

        $sql = 'UPDATE product SET name=:name,description=:description,image=:image,category=:category,price=:price ' .
            'WHERE id=:id';
        $stmt = $db->prepare($sql);

        $stmt->execute([
            'id' => $_GET['id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $imageBaseName,
            'category' => $data['category'],
            'price' => $data['price']
        ]);

        if ($stmt->rowCount()) {
            $cookie_name = "userMessage";
            $cookie_value = "Product is met succes aangepast!";
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
            header('location:index.php');
        }
    }
}

$buttonText = "Aanpassen";
include 'includes/html_start_inc.php'
?>

<p>
    <a href="index.php">Terug naar lijst</a>
</p>

<h1>Product aanpassen</h1>

<?php
include 'includes/formvalidation/formErrors.php';
include 'includes/product_form_inc.php';
include 'includes/html_stop_inc.php';
?>
