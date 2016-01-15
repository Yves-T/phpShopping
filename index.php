<?php

include 'includes/db_inc.php';
include 'includes/html_start_inc.php';
include 'includes/formatFunctions_inc.php';
include "includes/ResultPager.php";

$totalQuery = 'SELECT COUNT(*) FROM product';
$query = 'SELECT * FROM product ORDER BY name LIMIT :limit OFFSET :offset';
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

<?php if (isset($results) && !empty($results)): ?>
    <?php include 'includes/start_ProductTable_user_inc.php' ?>
    <?php foreach ($results as $row): ?>

        <tr>
            <td class="rowId"><?php print $row['id']; ?></td>
            <td class="rowName">
                <a href="productDetails.php?id=<?php print $row['id']; ?>">
                <?php print $row['name']; ?>
                </a>
            </td>
            <td class="rowDescription">
                    <?php print $row['description']; ?>
            </td>
            <td class="rowImages">
                <?php if (isset($row['image']) && !empty($row['image'])): ?>
                    <img src="productImages/<?php print $row['image']; ?>" alt="" width="100">
                <?php endif; ?>
            </td>
            <td class="rowCategory"><?php print $row['category']; ?></td>
            <td class="rowPrice"><?php print convertDecimalPoint($row['price']); ?></td>
        </tr>

    <?php endforeach; ?>
    <?php include "includes/end_ProductTable_inc.php"; ?>

    <div class="text-center">
        <?php
        echo $pager;
        ?>
    </div>

    <p>
        Pdf afrukken
        <a href="pdfCompleteProductList.php">

            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
        </a>
    </p>
<?php else: ?>
    <div class="alert alert-warning">
        Er zijn geen producten gevonden.
    </div>
    <?php
endif;
$db = NULL;

include 'includes/html_stop_inc.php'
?>
