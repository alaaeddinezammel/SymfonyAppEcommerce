<?php
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;
namespace MyApp\GrapheBundle\Controller;

use Zend\Json\Expr;

class GrapheController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller {
 
public function chartLineAction(){

 // Chart

 $series = array(

 array("name" => "Nom du graphe", "data" => array(1,2,4,5,6,3,8))

 );

 $ob = new \Ob\HighchartsBundle\Highcharts\Highchart;

 $ob->chart->renderTo('linechart'); // #id du div où afficher le graphe

 $ob->title->text('Titre du graphique');
 $ob->xAxis->title(array('text' => "Titre axe horizontal"));

 $ob->yAxis->title(array('text' => "Titre axe vertical "));

 $ob->series($series);

 return $this->render('MyAppGrapheBundle:Graphe:LineChart.html.twig', array(

 'chart' => $ob

 ));
}


//
public function chartHistogrammeAction()

{

 

$series = array(

 array(

 'name' => 'Rainfall',

 'type' => 'column',

 'color' => '#4572A7',

 'yAxis' => 1,

 'data' => array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4),

 ),

 array(

 'name' => 'Temperature',

 'type' => 'spline',

 'color' => '#AA4643',

 'data' => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6),

 ),

);

$yData = array(

 array(

 'labels' => array(

 'formatter' => new Expr('function () { return this.value + " degrees C" }'),

 'style' => array('color' => '#AA4643')

 ),

 'title' => array(

 'text' => 'Temperature',

 'style' => array('color' => '#AA4643')

 ),

 'opposite' => true,

 ),

 array(

 'labels' => array(

 'formatter' => new Expr('function () { return this.value + " mm" }'),

 'style' => array('color' => '#4572A7')

 ),

 'gridLineWidth' => 0,

 'title' => array(

 'text' => 'Rainfall',

 'style' => array('color' => '#4572A7')

 ),

 ),

);
$categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

$ob = new \Ob\HighchartsBundle\Highcharts\Highchart;

$ob->chart->renderTo('container'); // The #id of the div where to render the chart

$ob->chart->type('column');

$ob->title->text('Average Monthly Weather Data for Tokyo');

$ob->xAxis->categories($categories);

$ob->yAxis($yData);

$ob->legend->enabled(false);

$formatter = new Expr('function () {

 var unit = {

 "Rainfall": "mm",

 "Temperature": "degrees C"

 }[this.series.name];

 return this.x + ": <b>" + this.y + "</b> " + unit;

 }');

$ob->tooltip->formatter($formatter);

$ob->series($series);

return $this->render('MyAppGrapheBundle:Graphe:histogramme.html.twig', array(

 'chart' => $ob

 )); 

}






public function chartPie1Action(){
    

$ob = new \Ob\HighchartsBundle\Highcharts\Highchart;

$ob->chart->renderTo('piechart');

$ob->title->text('Les Membres qui ont plus de 23 ans ');

$ob->plotOptions->pie(array(

 'allowPointSelect' => true,

 'cursor' => 'pointer',

 'dataLabels' => array('enabled' => false),

 'showInLegend' => true

));
$em = $this->getDoctrine()->getEntityManager();
$query =$em->createQuery("SELECT m.nom as nom, m.points as points FROM PidevAllForDealBundle:Membre m WHERE m.age>=23");
$resultat= $query ->getResult();

$data = array();
foreach ($resultat as $value)
{
$a = array($value['nom'],intval($value['points']));
array_push($data, $a);
}

$ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

return $this->render('MyAppGrapheBundle:Graphe:pie.html.twig', array(

 'chart' => $ob

 ));

}

}