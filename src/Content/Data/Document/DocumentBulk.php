<?php
namespace Nemundo\Process\Content\Data\Document;
class DocumentBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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
public function save() {
$this->typeValueList->setModelValue($this->model->dataId, $this->dataId);
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->text, $this->text);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTime, $this->typeValueList);
$property->setValue($this->dateTime);
$this->typeValueList->setModelValue($this->model->userId, $this->userId);
$id = parent::save();
return $id;
}
}