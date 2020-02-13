<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDatePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateDateModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
}
/**
* @return TemplateDateRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateDateRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}