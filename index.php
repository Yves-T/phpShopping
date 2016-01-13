<?php

include 'includes/db_inc.php';
include 'includes/html_start_inc.php';
include 'includes/formatFunctions_inc.php';

$stmt = $db->query("SELECT * FROM product");
$stmt->execute();
$results = $stmt->fetchAll();
?>

<?php
$cookie_name = "userMessage";
if (isset($_COOKIE[$cookie_name])):
    ?>
    <div class="alert alert-success" role="alert"><p><?php print $_COOKIE[$cookie_name] ?></p></div>
    <?php
    // remove cookie
    unset($_COOKIE[$cookie_name]);
    setcookie($cookie_name, null, -1, '/');
endif;

$errorCookie = "errorMessage";
if (isset($_COOKIE[$errorCookie])):
    ?>
    <div class="alert alert-warning" role="alert"><p><?php print $_COOKIE[$errorCookie] ?></p></div>
    <?php
    // remove cookie
    unset($_COOKIE[$errorCookie]);
    setcookie($errorCookie, null, -1, '/');
endif;

?>

<a href="addProduct.php" class="btn btn-success">Product toevoegen</a>
<?php if (isset($results) && !empty($results)): ?>
    <?php include 'includes/start_ProductTable_inc.php' ?>
    <?php foreach ($results as $row): ?>

        <tr>
            <td><?php print $row['id']; ?></td>
            <td><?php print $row['name']; ?></td>
            <td>
                <a href="pdfForProductDetails.php?id=<?php print $row['id']; ?>">
                    <?php print $row['description']; ?></a>
            </td>
            <td>
                <?php if (isset($row['image']) && !empty($row['image'])): ?>
                    <img src="productImages/<?php print $row['image']; ?>" alt="" width="100">
                <?php endif; ?>
            </td>
            <td><?php print $row['category']; ?></td>
            <td><?php print convertDecimalPoint($row['price']); ?></td>
            <td>
                <a href="updateProduct.php?id=<?php print $row['id'] ?>" class="btn btn-success">Aanpassen</a>
            </td>
            <td class="delete" id="<?php print $row['id'] ?>">
                <input id="<?php print $row['id'] ?>" type="submit" class="btn btn-danger" value="verwijderen">
            </td>
        </tr>

    <?php endforeach; ?>
    <script src="js/handleProductDelete.js"></script>
    <?php include "includes/end_ProductTable_inc.php"; ?>
<?php else: ?>
    <div class="alert alert-warning">
        Er zijn geen producten gevonden.
    </div>
    <?php
endif;
$db = NULL;

include 'includes/html_stop_inc.php'
?>
