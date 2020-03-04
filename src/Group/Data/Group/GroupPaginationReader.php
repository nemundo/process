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
* @return \Nemundo\Process\Group\Row\GroupCustomRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new \Nemundo\Process\Group\Row\GroupCustomRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}