<?php
include '../includes/db_inc.php';
require_once('../lib/jpgraph/src/jpgraph.php');
require_once('../lib/jpgraph/src/jpgraph_bar.php');

if (!isset($_SESSION[USER])) {
    $errorCookie = "errorMessage";
    $errorCookieValue = "U hebt geen toegang tot de pagina die u hebt getracht te bezoeken!";
    setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
    header('location: ../index.php');
}

$sql = "SELECT * FROM balans";

$resultaat = $db->query($sql);

while ($row = $resultaat->fetch(PDO::FETCH_ASSOC)) {
    $naamMaand[] = $row["maand"];
    $inkomsten[] = $row["inkomsten"];
    $uitgaven[] = $row["uitgaven"];
}

$graph = new Graph(1050, 400, 'auto');

$graph->SetScale("textlin");


class MyTheme extends OceanTheme
{

    private $axis_color = '#0a0a0a';

    function GetColorList()
    {
        return [
            '#0b82ff',
            '#b7ceff',
        ];
    }

    function SetupGraph($graph)
    {
        parent::SetupGraph($graph);
        $graph->xaxis->SetColor($this->axis_color, $this->font_color);
        $graph->yaxis->SetColor($this->axis_color, $this->font_color);
    }
}


$graph->SetTheme(new MyTheme());

$graph->xaxis->SetTickLabels($naamMaand);
$graph->xaxis->title->SetFont(FF_VERDANA, FS_BOLD);

$graph->yaxis->title->SetFont(FF_VERDANA, FS_BOLD);

$graph->title->Set('Project Shopping');
$graph->title->SetFont(FF_VERDANA, FS_BOLD, 20);


$graph->subtitle->Set('Balans: inkomsten - uitgaven');
$graph->subtitle->SetFont(FF_VERDANA, FS_BOLD, 14);

$bplot1 = new BarPlot($inkomsten);
$bplot2 = new BarPlot($uitgaven);

$gbarplot = new GroupBarPlot(array($bplot1, $bplot2));
$gbarplot->SetWidth(0.6);

$graph->Add($gbarplot);


$bplot1->value->Show();
$bplot1->value->SetFormat('%d');
$bplot1->value->SetFont(FF_VERDANA, FS_NORMAL);

$bplot2->value->Show();
$bplot2->value->SetFormat('%d');
$bplot2->value->SetFont(FF_VERDANA, FS_NORMAL);

$bplot1->SetLegend('inkomsten');
$bplot2->SetLegend('uitgaven');

$graph->Stroke();
