<?php
namespace Nemundo\Process\Template\Data\TemplateMultiImage;
class TemplateMultiImagePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateMultiImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiImageModel();
}
/**
* @return TemplateMultiImageRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateMultiImageRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}