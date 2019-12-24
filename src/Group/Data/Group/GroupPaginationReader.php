<?php
namespace Nemundo\Process\Group\Data\Group;
class GroupPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var GroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupModel();
}
/**
* @return GroupRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new GroupRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}