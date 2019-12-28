<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var GeoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
}
/**
* @return GeoRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new GeoRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}