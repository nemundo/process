<?php
namespace Nemundo\Process\Template\Data\Document;
class DocumentModel extends \Nemundo\Model\Template\AbstractActiveModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\File\RedirectFilenameType
*/
public $document;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $workflowId;

protected function loadModel() {
$this->tableName = "process_template_document";
$this->aliasTableName = "process_template_document";
$this->label = "Document";

$this->primaryIndex = new \Nemundo\Db\Index\UniqueIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_document";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_document_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;


$this->document = new \Nemundo\Model\Type\File\RedirectFilenameType($this);
$this->document->tableName = "process_template_document";
$this->document->fieldName = "document";
$this->document->aliasFieldName = "process_template_document_document";
$this->document->label = "Document";
$this->document->allowNullValue = false;
$this->document->redirectSite = \Nemundo\Process\Template\Data\Document\Redirect\DocumentRedirectConfig::$redirectDocumentDocumentSite;

$this->workflowId = new \Nemundo\Model\Type\Text\TextType($this);
$this->workflowId->tableName = "process_template_document";
$this->workflowId->fieldName = "workflow_id";
$this->workflowId->aliasFieldName = "process_template_document_workflow_id";
$this->workflowId->label = "Workflow Id";
$this->workflowId->allowNullValue = false;
$this->workflowId->length = 36;

}
}