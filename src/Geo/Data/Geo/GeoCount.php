<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var GeoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
}
}