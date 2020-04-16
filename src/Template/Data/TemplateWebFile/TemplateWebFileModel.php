<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
class TemplateWebFileModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\File\FileType
*/
public $file;

protected function loadModel() {
$this->tableName = "template_template_web_file";
$this->aliasTableName = "template_template_web_file";
$this->label = "Template Web File";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_web_file";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_web_file_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->file = new \Nemundo\Model\Type\File\FileType($this);
$this->file->tableName = "template_template_web_file";
$this->file->fieldName = "file";
$this->file->aliasFieldName = "template_template_web_file_file";
$this->file->label = "File";
$this->file->allowNullValue = false;

}
}