<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $documentId;

/**
* @var \Nemundo\Process\Content\Data\Document\DocumentExternalType
*/
public $document;

/**
* @var \Nemundo\Workflow\App\Identification\Model\IdentificationModelType
*/
public $identification;

protected function loadModel() {
$this->tableName = "content_access";
$this->aliasTableName = "content_access";
$this->label = "Access";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "content_access";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "content_access_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->documentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->documentId->tableName = "content_access";
$this->documentId->fieldName = "document";
$this->documentId->aliasFieldName = "content_access_document";
$this->documentId->label = "Document";
$this->documentId->allowNullValue = false;

$this->identification = new \Nemundo\Workflow\App\Identification\Model\IdentificationModelType($this);
$this->identification->tableName = "content_access";
$this->identification->fieldName = "identification";
$this->identification->aliasFieldName = "content_access_identification";
$this->identification->label = "Identification";
$this->identification->allowNullValue = false;

}
public function loadDocument() {
if ($this->document == null) {
$this->document = new \Nemundo\Process\Content\Data\Document\DocumentExternalType($this, "content_access_document");
$this->document->tableName = "content_access";
$this->document->fieldName = "document";
$this->document->aliasFieldName = "content_access_document";
$this->document->label = "Document";
}
return $this;
}
}