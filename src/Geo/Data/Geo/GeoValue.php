<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var GeoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
}
}