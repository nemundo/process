<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateImageIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageIndexModel();
}
/**
* @return TemplateImageIndexRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateImageIndexRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}