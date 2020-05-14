<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var FeedItemModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
}
}