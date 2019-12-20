<?php
namespace Nemundo\Process\Content\Data\Document;
use Nemundo\Model\Data\AbstractModelUpdate;
class DocumentUpdate extends AbstractModelUpdate {
/**
* @var DocumentModel
*/
public $model;

/**
* @var string
*/
public $dataId;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $text;

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->text, $this->text);
parent::update();
}
}