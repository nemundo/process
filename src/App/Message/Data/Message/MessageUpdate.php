<?php
namespace Nemundo\Process\App\Message\Data\Message;
use Nemundo\Model\Data\AbstractModelUpdate;
class MessageUpdate extends AbstractModelUpdate {
/**
* @var MessageModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->subject, $this->subject);
$this->typeValueList->setModelValue($this->model->message, $this->message);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
parent::update();
}
}