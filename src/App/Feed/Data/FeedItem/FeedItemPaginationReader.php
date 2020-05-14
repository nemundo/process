<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var FeedItemModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
}
/**
* @return FeedItemRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new FeedItemRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}