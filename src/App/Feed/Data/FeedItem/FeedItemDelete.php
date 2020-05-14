<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var FeedItemModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
}
}