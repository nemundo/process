<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
class MessageToDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var MessageToModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageToModel();
}
}