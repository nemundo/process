<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $parentContentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $parentContentType;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $cmsContentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $cmsContentType;

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
$this->tableName = "cms_cms_type";
$this->aliasTableName = "cms_cms_type";
$this->label = "Cms Type";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "cms_cms_type";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "cms_cms_type_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->parentContentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->parentContentTypeId->tableName = "cms_cms_type";
$this->parentContentTypeId->fieldName = "parent_content_type";
$this->parentContentTypeId->aliasFieldName = "cms_cms_type_parent_content_type";
$this->parentContentTypeId->label = "Parent Content Type";
$this->parentContentTypeId->allowNullValue = false;

$this->cmsContentTypeId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->cmsContentTypeId->tableName = "cms_cms_type";
$this->cmsContentTypeId->fieldName = "cms_content_type";
$this->cmsContentTypeId->aliasFieldName = "cms_cms_type_cms_content_type";
$this->cmsContentTypeId->label = "Cms Content Type";
$this->cmsContentTypeId->allowNullValue = false;

$this->setupStatus = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->setupStatus->tableName = "cms_cms_type";
$this->setupStatus->fieldName = "setup_status";
$this->setupStatus->aliasFieldName = "cms_cms_type_setup_status";
$this->setupStatus->label = "Setup Status";
$this->setupStatus->allowNullValue = false;

$this->applicationId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->applicationId->tableName = "cms_cms_type";
$this->applicationId->fieldName = "application";
$this->applicationId->aliasFieldName = "cms_cms_type_application";
$this->applicationId->label = "Application";
$this->applicationId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "parent_cms";
$index->addType($this->parentContentTypeId);
$index->addType($this->cmsContentTypeId);

}
public function loadParentContentType() {
if ($this->parentContentType == null) {
$this->parentContentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "cms_cms_type_parent_content_type");
$this->parentContentType->tableName = "cms_cms_type";
$this->parentContentType->fieldName = "parent_content_type";
$this->parentContentType->aliasFieldName = "cms_cms_type_parent_content_type";
$this->parentContentType->label = "Parent Content Type";
}
return $this;
}
public function loadCmsContentType() {
if ($this->cmsContentType == null) {
$this->cmsContentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "cms_cms_type_cms_content_type");
$this->cmsContentType->tableName = "cms_cms_type";
$this->cmsContentType->fieldName = "cms_content_type";
$this->cmsContentType->aliasFieldName = "cms_cms_type_cms_content_type";
$this->cmsContentType->label = "Cms Content Type";
}
return $this;
}
public function loadApplication() {
if ($this->application == null) {
$this->application = new \Nemundo\App\Application\Data\Application\ApplicationExternalType($this, "cms_cms_type_application");
$this->application->tableName = "cms_cms_type";
$this->application->fieldName = "application";
$this->application->aliasFieldName = "cms_cms_type_application";
$this->application->label = "Application";
}
return $this;
}
}