<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
class InboxDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var InboxModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new InboxModel();
}
}