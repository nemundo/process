<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
class TemplateWebFilePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateWebFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
}
/**
* @return TemplateWebFileRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateWebFileRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}