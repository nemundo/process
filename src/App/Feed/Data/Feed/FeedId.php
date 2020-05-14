<?php
namespace Nemundo\Process\App\Feed\Data\Feed;
use Nemundo\Model\Id\AbstractModelIdValue;
class FeedId extends AbstractModelIdValue {
/**
* @var FeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedModel();
}
}