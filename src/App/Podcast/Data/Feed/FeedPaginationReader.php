<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class FeedPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var FeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedModel();
}
/**
* @return FeedRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new FeedRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}