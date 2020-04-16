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
$this->tableName = "process_template_file_delete";
$this->aliasTableName = "process_template_file_delete";
$this->label = "Template File Delete";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_file_delete";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_file_delete_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->fileId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->fileId->tableName = "process_template_file_delete";
$this->fileId->fieldName = "file";
$this->fileId->aliasFieldName = "process_template_file_delete_file";
$this->fileId->label = "File";
$this->fileId->allowNullValue = false;

}
public function loadFile() {
if ($this->file == null) {
$this->file = new \Nemundo\Process\Template\Data\TemplateFile\TemplateFileExternalType($this, "process_template_file_delete_file");
$this->file->tableName = "process_template_file_delete";
$this->file->fieldName = "file";
$this->file->aliasFieldName = "process_template_file_delete_file";
$this->file->label = "File";
}
return $this;
}
}