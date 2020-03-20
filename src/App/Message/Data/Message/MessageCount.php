<?php
namespace Nemundo\Process\App\Message\Data\Message;
class MessageCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var MessageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageModel();
}
}