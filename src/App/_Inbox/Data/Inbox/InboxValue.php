<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
class InboxValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var InboxModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new InboxModel();
}
}