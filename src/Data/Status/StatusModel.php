<?php
namespace Nemundo\Process\Data\Status;
class StatusModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $statusLabel;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $contentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $contentType;

protected function loadModel() {
$this->tableName = "process_status";
$this->aliasTableName = "process_status";
$this->label = "Status";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_status";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_status_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->statusLabel = new \Nemundo\Model\Type\Text\TextType($this);
$this->statusLabel->tableName = "process_status";
$this->statusLabel->fieldName = "status_label";
$this->statusLabel->aliasFieldName = "process_status_status_label";
$this->statusLabel->label = "Status Label";
$this->statusLabel->allowNullValue = false;
$this->statusLabel->length = 255;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "process_status";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "process_status_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "process_status_content_type");
$this->contentType->tableName = "process_status";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "process_status_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
}