<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
class TemplateFileDeletePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateFileDeleteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileDeleteModel();
}
/**
* @return TemplateFileDeleteRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateFileDeleteRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}