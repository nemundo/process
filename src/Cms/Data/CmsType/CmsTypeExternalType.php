<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $parentContentTypeId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $parentContentType;

/**
* @var \Nemundo\Model\Type\Id\IdType
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

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = CmsTypeModel::class;
$this->externalTableName = "cms_cms_type";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->parentContentTypeId = new \Nemundo\Model\Type\Id\IdType();
$this->parentContentTypeId->fieldName = "parent_content_type";
$this->parentContentTypeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->parentContentTypeId->aliasFieldName = $this->parentContentTypeId->tableName ."_".$this->parentContentTypeId->fieldName;
$this->parentContentTypeId->label = "Parent Content Type";
$this->addType($this->parentContentTypeId);

$this->cmsContentTypeId = new \Nemundo\Model\Type\Id\IdType();
$this->cmsContentTypeId->fieldName = "cms_content_type";
$this->cmsContentTypeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->cmsContentTypeId->aliasFieldName = $this->cmsContentTypeId->tableName ."_".$this->cmsContentTypeId->fieldName;
$this->cmsContentTypeId->label = "Cms Content Type";
$this->addType($this->cmsContentTypeId);

$this->setupStatus = new \Nemundo\Model\Type\Number\YesNoType();
$this->setupStatus->fieldName = "setup_status";
$this->setupStatus->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->setupStatus->aliasFieldName = $this->setupStatus->tableName . "_" . $this->setupStatus->fieldName;
$this->setupStatus->label = "Setup Status";
$this->addType($this->setupStatus);

}
public function loadParentContentType() {
if ($this->parentContentType == null) {
$this->parentContentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType(null, $this->parentFieldName . "_parent_content_type");
$this->parentContentType->fieldName = "parent_content_type";
$this->parentContentType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->parentContentType->aliasFieldName = $this->parentContentType->tableName ."_".$this->parentContentType->fieldName;
$this->parentContentType->label = "Parent Content Type";
$this->addType($this->parentContentType);
}
return $this;
}
public function loadCmsContentType() {
if ($this->cmsContentType == null) {
$this->cmsContentType = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType(null, $this->parentFieldName . "_cms_content_type");
$this->cmsContentType->fieldName = "cms_content_type";
$this->cmsContentType->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->cmsContentType->aliasFieldName = $this->cmsContentType->tableName ."_".$this->cmsContentType->fieldName;
$this->cmsContentType->label = "Cms Content Type";
$this->addType($this->cmsContentType);
}
return $this;
}
}