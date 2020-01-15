<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFileModel extends \Nemundo\Model\Template\AbstractActiveModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\File\RedirectFilenameType
*/
public $file;

protected function loadModel() {
$this->tableName = "template_template_file";
$this->aliasTableName = "template_template_file";
$this->label = "Template File";

$this->primaryIndex = new \Nemundo\Db\Index\UniqueIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_file";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_file_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;


$this->file = new \Nemundo\Model\Type\File\RedirectFilenameType($this);
$this->file->tableName = "template_template_file";
$this->file->fieldName = "file";
$this->file->aliasFieldName = "template_template_file_file";
$this->file->label = "File";
$this->file->allowNullValue = false;
$this->file->redirectSite = \Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileRedirectConfig::$redirectTemplateFileFileSite;

}
}