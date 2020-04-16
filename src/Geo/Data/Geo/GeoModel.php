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

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "process_geo";
$this->aliasTableName = "process_geo";
$this->label = "Geo";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_geo";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_geo_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->coordinate = new \Nemundo\Model\Type\Geo\GeoCoordinateType($this);
$this->coordinate->tableName = "process_geo";
$this->coordinate->fieldName = "coordinate";
$this->coordinate->aliasFieldName = "process_geo_coordinate";
$this->coordinate->label = "Coordinate";
$this->coordinate->allowNullValue = false;

$this->place = new \Nemundo\Model\Type\Text\TextType($this);
$this->place->tableName = "process_geo";
$this->place->fieldName = "place";
$this->place->aliasFieldName = "process_geo_place";
$this->place->label = "Place";
$this->place->allowNullValue = false;
$this->place->length = 255;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_geo";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_geo_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_geo_content");
$this->content->tableName = "process_geo";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_geo_content";
$this->content->label = "Content";
}
return $this;
}
}