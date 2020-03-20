<?php
namespace Nemundo\Process\App\Message\Data\Message;
use Nemundo\Model\Id\AbstractModelIdValue;
class MessageId extends AbstractModelIdValue {
/**
* @var MessageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageModel();
}
}