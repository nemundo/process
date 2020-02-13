<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFilePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateMultiFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiFileModel();
}
/**
* @return TemplateMultiFileRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateMultiFileRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}