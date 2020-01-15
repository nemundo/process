<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFilePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
}
/**
* @return TemplateFileRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateFileRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}