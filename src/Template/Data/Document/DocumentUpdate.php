<?php
namespace Nemundo\Process\Template\Data\Document;
use Nemundo\Model\Data\AbstractModelUpdate;
class DocumentUpdate extends AbstractModelUpdate {
/**
* @var DocumentModel
*/
public $model;

/**
* @var bool
*/
public $active;

/**
* @var \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty
*/
public $document;

/**
* @var string
*/
public $workflowId;

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
$this->document = new \Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty($this->model->document, $this->typeValueList);
}
public function update() {
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->workflowId, $this->workflowId);
parent::update();
}
}