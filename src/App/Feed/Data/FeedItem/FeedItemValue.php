<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var FeedItemModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
}
}