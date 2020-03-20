<?php
namespace Nemundo\Process\App\Message\Data\Message;
class MessageBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var MessageModel
*/
protected $model;

/**
* @var string
*/
public $subject;

/**
* @var string
*/
public $message;

/**
* @var string
*/
public $toId;

public function __construct() {
parent::__construct();
$this->model = new MessageModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->message, $this->message);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
$id = parent::save();
return $id;
}
}