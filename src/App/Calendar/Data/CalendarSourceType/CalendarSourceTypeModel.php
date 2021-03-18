<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarSourceType;
class CalendarSourceTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $contentType;

protected function loadModel() {
$this->tableName = "calendar_calendar_source_type";
$this->aliasTableName = "calendar_calendar_source_type";
$this->label = "Calendar Source Type";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "calendar_calendar_source_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "calendar_calendar_source_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "calendar_calendar_source_type";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "calendar_calendar_source_type_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content_type";
$index->addType($this->contentTypeId);

}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "calendar_calendar_source_type_content_type");
$this->contentType->tableName = "calendar_calendar_source_type";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "calendar_calendar_source_type_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
}