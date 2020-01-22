<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
class MessageToValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var MessageToModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageToModel();
}
}