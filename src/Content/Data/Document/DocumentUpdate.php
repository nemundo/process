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

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

/**
* @var string
*/
public $userId;

public function __construct() {
parent::__construct();
$this->model = new DocumentModel();
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime();
}
public function update() {
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->text, $this->text);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTime, $this->typeValueList);
$property->setValue($this->dateTime);
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
parent::update();
}
}