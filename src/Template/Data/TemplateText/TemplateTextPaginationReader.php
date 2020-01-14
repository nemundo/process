<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
/**
* @return TemplateTextRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateTextRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}