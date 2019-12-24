<?php
namespace Nemundo\Process\Group\Data\GroupUser;
class GroupUserPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var GroupUserModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupUserModel();
}
/**
* @return GroupUserRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new GroupUserRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}