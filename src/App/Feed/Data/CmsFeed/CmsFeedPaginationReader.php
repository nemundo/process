<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var CmsFeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
/**
* @return CmsFeedRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new CmsFeedRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}