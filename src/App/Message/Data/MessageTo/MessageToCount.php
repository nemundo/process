<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
class MessageToCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var MessageToModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageToModel();
}
}