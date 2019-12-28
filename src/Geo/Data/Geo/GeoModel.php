<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Geo\GeoCoordinateType
*/
public $coordinate;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $place;

protected function loadModel() {
$this->tableName = "geo_geo";
$this->aliasTableName = "geo_geo";
$this->label = "Geo";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "geo_geo";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "geo_geo_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->coordinate = new \Nemundo\Model\Type\Geo\GeoCoordinateType($this);
$this->coordinate->tableName = "geo_geo";
$this->coordinate->fieldName = "coordinate";
$this->coordinate->aliasFieldName = "geo_geo_coordinate";
$this->coordinate->label = "Coordinate";
$this->coordinate->allowNullValue = false;

$this->place = new \Nemundo\Model\Type\Text\TextType($this);
$this->place->tableName = "geo_geo";
$this->place->fieldName = "place";
$this->place->aliasFieldName = "geo_geo_place";
$this->place->label = "Place";
$this->place->allowNullValue = false;
$this->place->length = 255;

}
}