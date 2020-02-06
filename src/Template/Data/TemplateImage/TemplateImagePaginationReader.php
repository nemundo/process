<?php
namespace Nemundo\Process\Template\Data\TemplateImage;
class TemplateImagePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TemplateImageModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateImageModel();
}
/**
* @return TemplateImageRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TemplateImageRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}