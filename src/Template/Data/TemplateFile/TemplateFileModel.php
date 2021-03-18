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

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $text;

protected function loadModel() {
$this->tableName = "process_template_file";
$this->aliasTableName = "process_template_file";
$this->label = "Template File";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_file";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_file_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;


$this->file = new \Nemundo\Model\Type\File\RedirectFilenameType($this);
$this->file->tableName = "process_template_file";
$this->file->fieldName = "file";
$this->file->aliasFieldName = "process_template_file_file";
$this->file->label = "File";
$this->file->allowNullValue = false;
$this->file->redirectSite = \Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileRedirectConfig::$redirectTemplateFileFileSite;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_template_file";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_template_file_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = true;

$this->text = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->text->tableName = "process_template_file";
$this->text->fieldName = "text";
$this->text->aliasFieldName = "process_template_file_text";
$this->text->label = "Text";
$this->text->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_template_file_content");
$this->content->tableName = "process_template_file";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_template_file_content";
$this->content->label = "Content";
}
return $this;
}
}