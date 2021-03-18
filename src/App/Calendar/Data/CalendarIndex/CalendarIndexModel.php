<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndexModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $date;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $place;

protected function loadModel() {
$this->tableName = "calendar_calendar_index";
$this->aliasTableName = "calendar_calendar_index";
$this->label = "Calendar Index";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "calendar_calendar_index";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "calendar_calendar_index_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "calendar_calendar_index";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "calendar_calendar_index_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->date = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->date->tableName = "calendar_calendar_index";
$this->date->fieldName = "date";
$this->date->aliasFieldName = "calendar_calendar_index_date";
$this->date->label = "Date";
$this->date->allowNullValue = false;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "calendar_calendar_index";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "calendar_calendar_index_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

$this->place = new \Nemundo\Model\Type\Text\TextType($this);
$this->place->tableName = "calendar_calendar_index";
$this->place->fieldName = "place";
$this->place->aliasFieldName = "calendar_calendar_index_place";
$this->place->label = "Place";
$this->place->allowNullValue = false;
$this->place->length = 255;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "calendar_calendar_index_content");
$this->content->tableName = "calendar_calendar_index";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "calendar_calendar_index_content";
$this->content->label = "Content";
}
return $this;
}
}