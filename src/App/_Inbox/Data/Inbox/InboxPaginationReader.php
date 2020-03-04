<?php
namespace Nemundo\Process\App\Inbox\Data\Inbox;
class InboxPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var InboxModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new InboxModel();
}
/**
* @return InboxRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new InboxRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}