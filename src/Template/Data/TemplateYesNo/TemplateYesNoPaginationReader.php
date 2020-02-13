<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateYesNoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
/**
* @return TemplateYesNoRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateYesNoRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}