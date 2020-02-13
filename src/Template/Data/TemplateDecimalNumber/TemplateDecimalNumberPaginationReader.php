<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumberPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateDecimalNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDecimalNumberModel();
}
/**
* @return TemplateDecimalNumberRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateDecimalNumberRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}