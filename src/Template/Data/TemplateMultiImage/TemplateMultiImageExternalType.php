<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImageExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $active;

/**
* @var \Nemundo\Model\Type\File\ImageType
*/
public $image;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $dataContentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $dataContent;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TemplateMultiImageModel::class;
$this->externalTableName = "process_template_multi_image";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->active = new \Nemundo\Model\Type\Number\YesNoType();
$this->active->fieldName = "active";
$this->active->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->active->aliasFieldName = $this->active->tableName . "_" . $this->active->fieldName;
$this->active->label = "Active";
$this->addType($this->active);

$this->image = new \Nemundo\Model\Type\File\ImageType();
$this->image->fieldName = "image";
$this->image->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->image->aliasFieldName = $this->image->tableName . "_" . $this->image->fieldName;
$this->image->label = "Image";
$this->addType($this->image);

$this->dataContentId = new \Nemundo\Model\Type\Id\IdType();
$this->dataContentId->fieldName = "data_content";
$this->dataContentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->dataContentId->aliasFieldName = $this->dataContentId->tableName ."_".$this->dataContentId->fieldName;
$this->dataContentId->label = "Data Content";
$this->addType($this->dataContentId);

}
public function loadDataContent() {
if ($this->dataContent == null) {
$this->dataContent = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_data_content");
$this->dataContent->fieldName = "data_content";
$this->dataContent->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->dataContent->aliasFieldName = $this->dataContent->tableName ."_".$this->dataContent->fieldName;
$this->dataContent->label = "Data Content";
$this->addType($this->dataContent);
}
return $this;
}
}