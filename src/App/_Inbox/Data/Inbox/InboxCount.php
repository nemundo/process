<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
class InboxCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var InboxModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new InboxModel();
}
}