<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFileExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $active;

/**
* @var \Nemundo\Model\Type\File\RedirectFilenameType
*/
public $file;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = TemplateFileModel::class;
$this->externalTableName = "template_template_file";
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

$this->file = new \Nemundo\Model\Type\File\RedirectFilenameType();
$this->file->fieldName = "file";
$this->file->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->file->aliasFieldName = $this->file->tableName . "_" . $this->file->fieldName;
$this->file->label = "File";
$this->file->createObject();
$this->addType($this->file);

}
}