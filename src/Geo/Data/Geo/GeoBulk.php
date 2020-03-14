<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var GeoModel
*/
protected $model;

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
public function save() {
$property = new \Nemundo\Model\Data\Property\Geo\GeoCoordinateDataProperty($this->model->coordinate, $this->typeValueList);
$property->setValue($this->coordinate);
$this->typeValueList->setModelValue($this->model->place, $this->place);
$id = parent::save();
return $id;
}
}