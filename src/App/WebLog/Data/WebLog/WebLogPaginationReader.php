<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var WebLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
/**
* @return WebLogRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new WebLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}