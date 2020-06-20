<?php
namespace Nemundo\Process\App\Stream\Data\UserStream;
class UserStreamPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var UserStreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserStreamModel();
}
/**
* @return UserStreamRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new UserStreamRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}