<?php
include "../includes/db_inc.php";
include "../includes/html_start_admin_inc.php";
include '../includes/formatFunctions_inc.php';
include "../includes/ResultPager.php";
if (!isset($_SESSION[USER])) {
    $errorCookie = "errorMessage";
    $errorCookieValue = "U hebt geen toegang tot de pagina die u hebt getracht te bezoeken!";
    setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
    header('location: ../index.php');
}


$totalQuery = 'SELECT COUNT(*) FROM product';
$query = 'SELECT * FROM product ';

if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'id') {
        $query .= " ORDER BY id ";
    }

    if ($_GET['sort'] == 'name') {
        $query .= " ORDER BY name ";
    }

    if ($_GET['sort'] == 'cat') {
        $query .= " ORDER BY category ";
    }

    if ($_GET['sort'] == 'price') {
        $query .= " ORDER BY price ";
    }
} else {
    $query .= " ORDER BY name ";
}

$query .= " LIMIT :limit OFFSET :offset";

$resultPager = new ResultPager($query, $totalQuery, $db);

$page = min($resultPager->getPages(), filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default' => 1,
        'min_range' => 1,
    ),
)));

$pager = $resultPager->getPager($page);

$results = $resultPager->getresults();

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
    <?php include '../includes/start_ProductTable_inc.php' ?>
    <?php foreach ($results as $row): ?>

        <tr>
            <td class="rowId"><?php print $row['id']; ?></td>
            <td class="rowName"><?php print $row['name']; ?></td>
            <td class="rowDescription">

                <?php print $row['description']; ?>
            </td>
            <td class="rowImages">
                <?php if (isset($row['image']) && !empty($row['image'])): ?>
                    <img src="../productImages/<?php print $row['image']; ?>" alt="" width="100">
                <?php endif; ?>
            </td>
            <td class="rowCategory"><?php print $row['category']; ?></td>
            <td class="rowPrice"><?php print convertDecimalPoint($row['price']); ?></td>
            <td>
                <a href="updateProduct.php?id=<?php print $row['id'] ?>" class="btn btn-success">Aanpassen</a>
            </td>
            <td class="delete" id="<?php print $row['id'] ?>">
                <input id="<?php print $row['id'] ?>" type="submit" class="btn btn-danger" value="verwijderen">
            </td>
        </tr>

    <?php endforeach; ?>
    <script src="../js/handleProductDelete.js"></script>
    <?php include "../includes/end_ProductTable_inc.php"; ?>
    <div class="text-center">
        <?php
        echo $pager;
        ?>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        Er zijn geen producten gevonden.
    </div>
    <?php
endif;
$db = NULL;

include "../includes/html_stop_admin_inc.php";
?>
