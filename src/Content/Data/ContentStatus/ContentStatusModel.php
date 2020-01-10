<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatusModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $statusId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $status;

protected function loadModel() {
$this->tableName = "content_content_status";
$this->aliasTableName = "content_content_status";
$this->label = "Content Status";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content_content_status";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content_content_status_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentId->tableName = "content_content_status";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "content_content_status_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->statusId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->statusId->tableName = "content_content_status";
$this->statusId->fieldName = "status";
$this->statusId->aliasFieldName = "content_content_status_status";
$this->statusId->label = "Status";
$this->statusId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "content_content_status_content");
$this->content->tableName = "content_content_status";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "content_content_status_content";
$this->content->label = "Content";
}
return $this;
}
public function loadStatus() {
if ($this->status == null) {
$this->status = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "content_content_status_status");
$this->status->tableName = "content_content_status";
$this->status->fieldName = "status";
$this->status->aliasFieldName = "content_content_status_status";
$this->status->label = "Status";
}
return $this;
}
}