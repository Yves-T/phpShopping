<?php
include '../includes/db_inc.php';
include '../includes/formatFunctions_inc.php';
require_once('../lib/jpgraph/src/jpgraph.php');


require_once('../lib/jpgraph/src/jpgraph_canvas.php');
require_once('../lib/jpgraph/src/jpgraph_table.php');

if (!isset($_SESSION[USER])) {
    $errorCookie = "errorMessage";
    $errorCookieValue = "U hebt geen toegang tot de pagina die u hebt getracht te bezoeken!";
    setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
    header('location: ../index.php');
}

function calculateBalance($income, $expenditure)
{
    return convertDecimalPoint((float)$income - (float)$expenditure) + 0;
}

$sql = "SELECT * FROM balans";

$resultaat = $db->query($sql);

$data = array();
array_push($data, array('Project shopping - balans inkomsten vs uitgaven', '', '', ''));
array_push($data, array('Maand', 'Inkomsten', 'Uitgaven', 'Balans'));

while ($row = $resultaat->fetch(PDO::FETCH_ASSOC)) {
    $tempArray = array($row["maand"], $row["inkomsten"], $row["uitgaven"], calculateBalance($row["inkomsten"], $row['uitgaven']));
    array_push($data, $tempArray);

}

// Setup graph context
$graph = new CanvasGraph(803, 387);

// Setup the basic table and font
$table = new GTextTable();

$table->Set($data);

$table->SetFont(FF_TIMES, FS_NORMAL, 11);
$table->SetFont(FF_TIMES, FS_NORMAL, 12);
$table->SetCellFont(0, 0, FF_ARIAL, FS_BOLD, 16);

$table->SetMinColWidth(200);

$table->MergeRow(0);

// Setup color
$table->SetRowFillColor(0, '#0b82ff@0.5');
$table->SetColFillColor(0, '#b7ceff@0.5');
//$table->SetFillColor(0, 0, 4, 0, 'lightgray@0.5');

// Set default table alignment
$table->SetAlign('right');

// Add table to graph
$graph->Add($table);

$table->SetAlign("center");
$table->SetColAlign(0, "left");
$table->SetRowAlign(0, 'center');

// send it back to the client
$graph->Stroke();
