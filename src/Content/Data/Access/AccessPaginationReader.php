<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var AccessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AccessModel();
}
/**
* @return AccessRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new AccessRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}