<?php
namespace Nemundo\Process\Cms\Data\Cms;
class CmsPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var CmsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsModel();
}
/**
* @return CmsRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new CmsRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}