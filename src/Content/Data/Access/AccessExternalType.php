<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $documentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $document;

/**
* @var \Nemundo\Workflow\App\Identification\Model\IdentificationModelType
*/
public $identification;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = AccessModel::class;
$this->externalTableName = "content_access";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->documentId = new \Nemundo\Model\Type\Id\IdType();
$this->documentId->fieldName = "document";
$this->documentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->documentId->aliasFieldName = $this->documentId->tableName ."_".$this->documentId->fieldName;
$this->documentId->label = "Document";
$this->addType($this->documentId);

$this->identification = new \Nemundo\Workflow\App\Identification\Model\IdentificationModelType();
$this->identification->fieldName = "identification";
$this->identification->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->identification->aliasFieldName = $this->identification->tableName . "_" . $this->identification->fieldName;
$this->identification->label = "Identification";
$this->identification->createObject();
$this->addType($this->identification);

}
public function loadDocument() {
if ($this->document == null) {
$this->document = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_document");
$this->document->fieldName = "document";
$this->document->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->document->aliasFieldName = $this->document->tableName ."_".$this->document->fieldName;
$this->document->label = "Document";
$this->addType($this->document);
}
return $this;
}
}