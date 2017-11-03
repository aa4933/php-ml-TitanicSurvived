<?php
/**
 * Created by PhpStorm.
 * User: wuilly
 * Date: 2017/11/2
 * Time: 下午9:13
 */

require_once 'vendor/autoload.php';
require_once 'ArrayToCsv/ArrayToCsv.php';

use Phpml\Dataset\CsvDataset;
use Phpml\Classification\Ensemble\RandomForest;


$dataset = new CsvDataset('./data/for_php_train.csv',5,true);
$testset = new CsvDataset('./data/for_php_test.csv',5,true);

$sample = $dataset->getSamples();
$label = $dataset->getTargets();

$RandomForest = new RandomForest();
$RandomForest->train($sample,$label);

$result = $RandomForest->predict($testset->getSamples());

$csv=[];
$csv[0]['PassengerId']='PassengerId';
$csv[0]['Survived']='Survived';
foreach ($result as $k=>$value){
    $csv[$k+1]['PassengerId']=$k+892;
    $csv[$k+1]['Survived']=$value;
}
var_dump($csv);
$file = fopen('write.csv','a+b');
$data = $csv;
foreach ($data as $value){
    fputcsv($file,$value);
}
fclose( $file);
//
//$csv = new \Service\ArrayToCsv($csv);
//$csv->setFilename('write.csv'); // file.csv by default if not defined
//$csv->download(); // to download the file
//$csv->getCsvData();
//$train = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
//$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

//$classifier =  new KNearestNeighbors();
//$classifier->train($train,$labels);

//$test = $classifier->predict();

