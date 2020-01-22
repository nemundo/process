<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
use Nemundo\Model\Data\AbstractModelUpdate;
class MessageToUpdate extends AbstractModelUpdate {
/**
* @var MessageToModel
*/
public $model;

/**
* @var string
*/
public $messageId;

/**
* @var string
*/
public $toId;

public function __construct() {
parent::__construct();
$this->model = new MessageToModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->messageId, $this->messageId);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
parent::update();
}
}