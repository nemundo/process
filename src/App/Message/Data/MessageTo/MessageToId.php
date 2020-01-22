<?php
namespace Nemundo\Process\App\Message\Data\MessageTo;
use Nemundo\Model\Id\AbstractModelIdValue;
class MessageToId extends AbstractModelIdValue {
/**
* @var MessageToModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageToModel();
}
}