<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
class TemplateFileDeleteModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $fileId;

/**
* @var \Nemundo\Process\Template\Data\TemplateFile\TemplateFileExternalType
*/
public $file;

protected function loadModel() {
$this->tableName = "template_template_file_delete";
$this->aliasTableName = "template_template_file_delete";
$this->label = "Template File Delete";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_file_delete";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_file_delete_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->fileId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->fileId->tableName = "template_template_file_delete";
$this->fileId->fieldName = "file";
$this->fileId->aliasFieldName = "template_template_file_delete_file";
$this->fileId->label = "File";
$this->fileId->allowNullValue = false;

}
public function loadFile() {
if ($this->file == null) {
$this->file = new \Nemundo\Process\Template\Data\TemplateFile\TemplateFileExternalType($this, "template_template_file_delete_file");
$this->file->tableName = "template_template_file_delete";
$this->file->fieldName = "file";
$this->file->aliasFieldName = "template_template_file_delete_file";
$this->file->label = "File";
}
return $this;
}
}