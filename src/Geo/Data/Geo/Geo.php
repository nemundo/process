<?php
namespace Nemundo\Process\Geo\Data\Geo;
class Geo extends \Nemundo\Model\Data\AbstractModelData {
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

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
$this->coordinate = new \Nemundo\Core\Type\Geo\GeoCoordinate();
}
public function save() {
$property = new \Nemundo\Model\Data\Property\Geo\GeoCoordinateDataProperty($this->model->coordinate, $this->typeValueList);
$property->setValue($this->coordinate);
$this->typeValueList->setModelValue($this->model->place, $this->place);
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}