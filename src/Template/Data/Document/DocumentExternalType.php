<?php
namespace Nemundo\Process\Template\Data\Document;
class DocumentExternalType extends \Nemundo\Model\Type\External\ExternalType {
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
public $document;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $workflowId;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = DocumentModel::class;
$this->externalTableName = "process_template_document";
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

$this->document = new \Nemundo\Model\Type\File\RedirectFilenameType();
$this->document->fieldName = "document";
$this->document->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->document->aliasFieldName = $this->document->tableName . "_" . $this->document->fieldName;
$this->document->label = "Document";
$this->document->createObject();
$this->addType($this->document);

$this->workflowId = new \Nemundo\Model\Type\Text\TextType();
$this->workflowId->fieldName = "workflow_id";
$this->workflowId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->workflowId->aliasFieldName = $this->workflowId->tableName . "_" . $this->workflowId->fieldName;
$this->workflowId->label = "Workflow Id";
$this->addType($this->workflowId);

}
}