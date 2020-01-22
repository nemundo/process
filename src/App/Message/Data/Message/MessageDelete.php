<?php
namespace Nemundo\Process\App\Message\Data\Message;
class MessageDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var MessageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageModel();
}
}