<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class FeedDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var FeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedModel();
}
}