<?php
namespace Nemundo\Process\Content\Data\Document;
class Document extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var DocumentModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->text, $this->text);
$id = parent::save();
return $id;
}
}