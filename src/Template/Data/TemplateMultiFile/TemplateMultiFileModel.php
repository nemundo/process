<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFileModel extends \Nemundo\Model\Template\AbstractActiveModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
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

protected function loadModel() {
$this->tableName = "process_template_multi_file";
$this->aliasTableName = "process_template_multi_file";
$this->label = "Template Multi File";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_multi_file";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_multi_file_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;


$this->dataContentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->dataContentId->tableName = "process_template_multi_file";
$this->dataContentId->fieldName = "data_content";
$this->dataContentId->aliasFieldName = "process_template_multi_file_data_content";
$this->dataContentId->label = "Data Content";
$this->dataContentId->allowNullValue = false;

$this->file = new \Nemundo\Model\Type\File\RedirectFilenameType($this);
$this->file->tableName = "process_template_multi_file";
$this->file->fieldName = "file";
$this->file->aliasFieldName = "process_template_multi_file_file";
$this->file->label = "File";
$this->file->allowNullValue = false;
$this->file->redirectSite = \Nemundo\Process\Template\Data\TemplateMultiFile\Redirect\TemplateMultiFileRedirectConfig::$redirectTemplateMultiFileFileSite;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content_data";
$index->addType($this->dataContentId);

}
public function loadDataContent() {
if ($this->dataContent == null) {
$this->dataContent = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_template_multi_file_data_content");
$this->dataContent->tableName = "process_template_multi_file";
$this->dataContent->fieldName = "data_content";
$this->dataContent->aliasFieldName = "process_template_multi_file_data_content";
$this->dataContent->label = "Data Content";
}
return $this;
}
}