<?php
namespace Nemundo\Process\App\Message\Data\Message;
class MessageValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var MessageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageModel();
}
}