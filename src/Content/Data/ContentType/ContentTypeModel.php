<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $phpClass;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $contentType;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $setupStatus;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $applicationId;

/**
* @var \Nemundo\App\Application\Data\Application\ApplicationExternalType
*/
public $application;

protected function loadModel() {
$this->tableName = "process_content_type";
$this->aliasTableName = "process_content_type";
$this->label = "Content Type";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_content_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_content_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->phpClass = new \Nemundo\Model\Type\Text\TextType($this);
$this->phpClass->tableName = "process_content_type";
$this->phpClass->fieldName = "php_class";
$this->phpClass->aliasFieldName = "process_content_type_php_class";
$this->phpClass->label = "Php Class";
$this->phpClass->allowNullValue = false;
$this->phpClass->length = 255;

$this->contentType = new \Nemundo\Model\Type\Text\TextType($this);
$this->contentType->tableName = "process_content_type";
$this->contentType->fieldName = "content_type";
$this->contentType->aliasFieldName = "process_content_type_content_type";
$this->contentType->label = "Content Type";
$this->contentType->allowNullValue = false;
$this->contentType->length = 255;

$this->setupStatus = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->setupStatus->tableName = "process_content_type";
$this->setupStatus->fieldName = "setup_status";
$this->setupStatus->aliasFieldName = "process_content_type_setup_status";
$this->setupStatus->label = "Setup Status";
$this->setupStatus->allowNullValue = false;

$this->applicationId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->applicationId->tableName = "process_content_type";
$this->applicationId->fieldName = "application";
$this->applicationId->aliasFieldName = "process_content_type_application";
$this->applicationId->label = "Application";
$this->applicationId->allowNullValue = true;

}
public function loadApplication() {
if ($this->application == null) {
$this->application = new \Nemundo\App\Application\Data\Application\ApplicationExternalType($this, "process_content_type_application");
$this->application->tableName = "process_content_type";
$this->application->fieldName = "application";
$this->application->aliasFieldName = "process_content_type_application";
$this->application->label = "Application";
}
return $this;
}
}