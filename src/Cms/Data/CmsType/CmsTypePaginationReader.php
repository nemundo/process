<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var CmsTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsTypeModel();
}
/**
* @return CmsTypeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new CmsTypeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}