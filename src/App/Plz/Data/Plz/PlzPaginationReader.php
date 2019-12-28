<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var PlzModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PlzModel();
}
/**
* @return PlzRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new PlzRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}