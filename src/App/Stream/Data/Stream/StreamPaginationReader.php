<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
class StreamPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var StreamModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StreamModel();
}
/**
* @return StreamRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new StreamRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}