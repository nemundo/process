<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var AccessModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $documentId;

/**
* @var \Nemundo\Process\Content\Data\Document\DocumentRow
*/
public $document;

/**
* @var \Nemundo\Workflow\App\Identification\Model\Identification
*/
public $identification;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->documentId = $this->getModelValue($model->documentId);
if ($model->document !== null) {
$this->loadNemundoProcessContentDataDocumentDocumentdocumentRow($model->document);
}
$property = new \Nemundo\Workflow\App\Identification\Model\IdentificationReaderProperty($row, $model->identification);
$this->identification = $property->getValue();
}
private function loadNemundoProcessContentDataDocumentDocumentdocumentRow($model) {
$this->document = new \Nemundo\Process\Content\Data\Document\DocumentRow($this->row, $model);
}
}