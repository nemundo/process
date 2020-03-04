<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
use Nemundo\Model\Id\AbstractModelIdValue;
class InboxId extends AbstractModelIdValue {
/**
* @var InboxModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new InboxModel();
}
}