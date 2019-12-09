<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var LargeTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new LargeTextModel();
}
/**
* @return LargeTextRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new LargeTextRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}