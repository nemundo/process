<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
use Nemundo\Model\Id\AbstractModelIdValue;
class FeedItemId extends AbstractModelIdValue {
/**
* @var FeedItemModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
}
}