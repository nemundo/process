<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
/**
* @return TemplateNumberRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateNumberRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}