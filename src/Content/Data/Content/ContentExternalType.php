<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
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
* @var \Nemundo\Model\Type\Id\IdType
*/
public $userCreatedId;

/**
* @var \Nemundo\User\Data\User\UserExternalType
*/
public $userCreated;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = ContentModel::class;
$this->externalTableName = "content2_content";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->contentTypeId = new \Nemundo\Model\Type\Id\IdType();
$this->contentTypeId->fieldName = "content_type";
$this->contentTypeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentTypeId->aliasFieldName = $this->contentTypeId->tableName ."_".$this->contentTypeId->fieldName;
$this->contentTypeId->label = "Content Type";
$this->addType($this->contentTypeId);

$this->dataId = new \Nemundo\Model\Type\Text\TextType();
$this->dataId->fieldName = "data_id";
$this->dataId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->dataId->aliasFieldName = $this->dataId->tableName . "_" . $this->dataId->fieldName;
$this->dataId->label = "Data Id";
$this->addType($this->dataId);

$this->dateTimeCreated = new \Nemundo\Model\Type\DateTime\DateTimeType();
$this->dateTimeCreated->fieldName = "date_time_created";
$this->dateTimeCreated->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->dateTimeCreated->aliasFieldName = $this->dateTimeCreated->tableName . "_" . $this->dateTimeCreated->fieldName;
$this->dateTimeCreated->label = "Date Time Created";
$this->addType($this->dateTimeCreated);

$this->parentId = new \Nemundo\Model\Type\Text\TextType();
$this->parentId->fieldName = "parent_id";
$this->parentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->parentId->aliasFieldName = $this->parentId->tableName . "_" . $this->parentId->fieldName;
$this->parentId->label = "Parent Id";
$this->addType($this->parentId);

$this->itemOrder = new \Nemundo\Model\Type\Number\NumberType();
$this->itemOrder->fieldName = "item_order";
$this->itemOrder->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->itemOrder->aliasFieldName = $this->itemOrder->tableName . "_" . $this->itemOrder->fieldName;
$this->itemOrder->label = "Item Order";
$this->addType($this->itemOrder);

$this->userCreatedId = new \Nemundo\Model\Type\Id\IdType();
$this->userCreatedId->fieldName = "user_created";
$this->userCreatedId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->userCreatedId->aliasFieldName = $this->userCreatedId->tableName ."_".$this->userCreatedId->fieldName;
$this->userCreatedId->label = "User Created";
$this->addType($this->userCreatedId);

}
public function loadContentType() {
if ($this->contentType == null) {
$this->contentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType(null, $this->parentFieldName . "_content_type");
$this->contentType->fieldName = "content_type";
$this->contentType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentType->aliasFieldName = $this->contentType->tableName ."_".$this->contentType->fieldName;
$this->contentType->label = "Content Type";
$this->addType($this->contentType);
}
return $this;
}
public function loadUserCreated() {
if ($this->userCreated == null) {
$this->userCreated = new \Nemundo\User\Data\User\UserExternalType(null, $this->parentFieldName . "_user_created");
$this->userCreated->fieldName = "user_created";
$this->userCreated->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->userCreated->aliasFieldName = $this->userCreated->tableName ."_".$this->userCreated->fieldName;
$this->userCreated->label = "User Created";
$this->addType($this->userCreated);
}
return $this;
}
}