<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
class MessageTo extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var MessageToModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->messageId, $this->messageId);
$this->typeValueList->setModelValue($this->model->toId, $this->toId);
$id = parent::save();
return $id;
}
}