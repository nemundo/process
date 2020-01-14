<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var SourceLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
/**
* @return SourceLogRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new SourceLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}