<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var GeoModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var \Nemundo\Core\Type\Geo\GeoCoordinate
*/
public $coordinate;

/**
* @var string
*/
public $place;

/**
* @var int
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$property = new \Nemundo\Model\Reader\Property\Geo\GeoCoordinateReaderProperty($row, $model->coordinate);
$this->coordinate = $property->getValue();
$this->place = $this->getModelValue($model->place);
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}