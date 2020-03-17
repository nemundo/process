<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateTextLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
/**
* @return TemplateTextLogRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateTextLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}