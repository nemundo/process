<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFileExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $active;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $dataContentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $dataContent;

/**
* @var \Nemundo\Model\Type\File\RedirectFilenameType
*/
public $file;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TemplateMultiFileModel::class;
$this->externalTableName = "process_template_multi_file";
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

$this->dataContentId = new \Nemundo\Model\Type\Id\IdType();
$this->dataContentId->fieldName = "data_content";
$this->dataContentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->dataContentId->aliasFieldName = $this->dataContentId->tableName ."_".$this->dataContentId->fieldName;
$this->dataContentId->label = "Data Content";
$this->addType($this->dataContentId);

$this->file = new \Nemundo\Model\Type\File\RedirectFilenameType();
$this->file->fieldName = "file";
$this->file->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->file->aliasFieldName = $this->file->tableName . "_" . $this->file->fieldName;
$this->file->label = "File";
$this->file->createObject();
$this->addType($this->file);

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