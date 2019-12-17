<?php
namespace Nemundo\Process\Template\Data\Document;
class DocumentBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var DocumentModel
*/
protected $model;

/**
* @var string
*/
public $id;

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
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->active, $this->active);
$this->typeValueList->setModelValue($this->model->workflowId, $this->workflowId);
$id = parent::save();
return $id;
}
}