<?php
namespace Nemundo\Process\App\Share\Data\Share;
class SharePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ShareModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ShareModel();
}
/**
* @return ShareRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new ShareRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}