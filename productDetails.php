<?php
include 'includes/db_inc.php';
include 'includes/formatFunctions_inc.php';
include 'includes/html_start_inc.php';
require 'lib/FPDF/fpdf.php';

$query = 'SELECT * FROM product WHERE id=:id';
$stmt = $db->prepare($query);

$stmt->execute([
    'id' => $_GET['id']
]);

$result = $stmt->fetch();

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Product details van: <?php print $result['name']; ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>
                Pdf afrukken
                <a href="pdfForProductDetails.php?id=<?php print $result['id']; ?>">

                    <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                </a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <img src="productImages/<?php print $result['image']; ?>" alt="" width="100">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Beschrijving</h3>
            <?php print $result['description']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Prijs</h3>
            <td><?php print convertDecimalPoint($result['price']); ?></td>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Prijs</h3>
            <td><?php print convertDecimalPoint($result['price']); ?></td>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>
                <a href="index.php">
                    <button class="btn btn-default">Terug naar de hoofdpagina</button>
                </a>
            </p>
        </div>
    </div>

</div>
<?php
include 'includes/html_stop_inc.php'
?>
