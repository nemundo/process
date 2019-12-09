<?php
namespace Nemundo\Process\Template\Data\Document;
class DocumentRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var DocumentModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var bool
*/
public $active;

/**
* @var \Nemundo\Model\Reader\Property\File\RedirectFilenameReaderProperty
*/
public $document;

/**
* @var string
*/
public $workflowId;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->active = boolval($this->getModelValue($model->active));
$this->document = new \Nemundo\Model\Reader\Property\File\RedirectFilenameReaderProperty($row, $model->document, $this->id);
$this->workflowId = $this->getModelValue($model->workflowId);
}
}