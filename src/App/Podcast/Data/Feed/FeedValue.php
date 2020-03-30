<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class FeedValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var FeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FeedModel();
}
}