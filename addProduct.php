<?php

include 'includes/db_inc.php';
include 'includes/formvalidation/FormValidation.php';

$errors = [];
if (!empty($_POST)) {
    $data = $_POST;
    $formValidation = new ProductFormValidation($data);

    $errors = $formValidation->validateForm();

    if (empty($errors)) {

        $query = 'INSERT INTO product (name,description,image,category,price) ' .
            'VALUES (:name,:description,:image,:category,:price);';

        $stmt = $db->prepare($query);

        $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'category' => $data['category'],
            'price' => (float)$data['price']
        ]);

        if ($stmt->rowCount()) {
            $cookie_name = "userMessage";
            $cookie_value = "Product is met succes toegevoegd!";
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
            header('location:index.php');
        }
    }
}

$buttonText = "Toevoegen";

include 'includes/html_start_inc.php';
?>
<h1>Product toevoegen</h1>
<?php
include 'includes/formvalidation/formErrors.php';
include 'includes/product_form_inc.php';

?>


<?php
include 'includes/html_stop_inc.php';
?>
