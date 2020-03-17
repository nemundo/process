<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
class TemplateDateLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateDateLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateLogModel();
}
/**
* @return TemplateDateLogRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateDateLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}