<?php
namespace Nemundo\Process\Group\Data\GroupType;
class GroupTypePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var GroupTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupTypeModel();
}
/**
* @return GroupTypeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new GroupTypeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}