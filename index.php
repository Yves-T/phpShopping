<?php

/**
 * Convert decimal point to comma and remove useless zero digits
 * @param $input
 * @return mixed
 */
function convertDecimalPoint($input)
{
    $float = (float)$input;
    $float += 0;
    $output = str_replace('.', ',', (string)$float);
    return $output;
}

include 'includes/html_start_inc.php';
try {
//open the database
    $db = new PDO('sqlite:shopping.sqlite');
    include 'includes/db_inc.php';

    $stmt = $db->query("SELECT * FROM product");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    ?>

    <a href="addProduct.php" class="btn btn-success">Product toevoegen</a>

    <?php include 'includes/start_ProductTable_inc.php' ?>
    <?php foreach ($results as $row): ?>

        <tr>
            <td><?php print $row['id']; ?></td>
            <td><?php print $row['name']; ?></td>
            <td><?php print $row['description']; ?></td>
            <td><?php print $row['image']; ?></td>
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
    <?php
    $db = NULL;
} catch (PDOException $e) {
    print 'Fout: ' . $e->getMessage();
}
include 'includes/html_stop_inc.php'
?>
