<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $dataId;

/**
* @var \Nemundo\Model\Type\DateTime\DateTimeType
*/
public $dateTimeCreated;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $parentId;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $itemOrder;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $userCreatedId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $userCreated;

protected function loadModel() {
$this->tableName = "content2_content";
$this->aliasTableName = "content2_content";
$this->label = "Content";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content2_content";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content2_content_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->contentTypeId->tableName = "content2_content";
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->aliasFieldName = "content2_content_content_type";
$this->contentTypeId->label = "Content Type";
$this->contentTypeId->allowNullValue = false;

$this->dataId = new \Nemundo\Model\Type\Text\TextType($this);
$this->dataId->tableName = "content2_content";
$this->dataId->fieldName = "data_id";
$this->dataId->aliasFieldName = "content2_content_data_id";
$this->dataId->label = "Data Id";
$this->dataId->allowNullValue = false;
$this->dataId->length = 36;

$this->dateTimeCreated = new \Nemundo\Model\Type\DateTime\DateTimeType($this);
$this->dateTimeCreated->tableName = "content2_content";
$this->dateTimeCreated->fieldName = "date_time_created";
$this->dateTimeCreated->aliasFieldName = "content2_content_date_time_created";
$this->dateTimeCreated->label = "Date Time Created";
$this->dateTimeCreated->allowNullValue = false;

$this->parentId = new \Nemundo\Model\Type\Text\TextType($this);
$this->parentId->tableName = "content2_content";
$this->parentId->fieldName = "parent_id";
$this->parentId->aliasFieldName = "content2_content_parent_id";
$this->parentId->label = "Parent Id";
$this->parentId->allowNullValue = false;
$this->parentId->length = 36;

$this->itemOrder = new \Nemundo\Model\Type\Number\NumberType($this);
$this->itemOrder->tableName = "content2_content";
$this->itemOrder->fieldName = "item_order";
$this->itemOrder->aliasFieldName = "content2_content_item_order";
$this->itemOrder->label = "Item Order";
$this->itemOrder->allowNullValue = false;

$this->userCreatedId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->userCreatedId->tableName = "content2_content";
$this->userCreatedId->fieldName = "user_created";
$this->userCreatedId->aliasFieldName = "content2_content_user_created";
$this->userCreatedId->label = "User Created";
$this->userCreatedId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "data_id";
$index->addType($this->dataId);

}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "content2_content_content_type");
$this->contentType->tableName = "content2_content";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "content2_content_content_type";
$this->contentType->label = "Content Type";
}
return $this;
}
public function loadUserCreated() {
if ($this->userCreated == null) {
$this->userCreated = new \Nemundo\User\Data\User\UserExternalType($this, "content2_content_user_created");
$this->userCreated->tableName = "content2_content";
$this->userCreated->fieldName = "user_created";
$this->userCreated->aliasFieldName = "content2_content_user_created";
$this->userCreated->label = "User Created";
}
return $this;
}
}