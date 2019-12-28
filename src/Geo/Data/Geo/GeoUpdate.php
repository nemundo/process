<?php
namespace Nemundo\Process\Geo\Data\Geo;
use Nemundo\Model\Data\AbstractModelUpdate;
class GeoUpdate extends AbstractModelUpdate {
/**
* @var GeoModel
*/
public $model;

/**
* @var \Nemundo\Core\Type\Geo\GeoCoordinate
*/
public $coordinate;

/**
* @var string
*/
public $place;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
$this->coordinate = new \Nemundo\Core\Type\Geo\GeoCoordinate();
}
public function update() {
$property = new \Nemundo\Model\Data\Property\Geo\GeoCoordinateDataProperty($this->model->coordinate, $this->typeValueList);
$property->setValue($this->coordinate);
$this->typeValueList->setModelValue($this->model->place, $this->place);
parent::update();
}
}