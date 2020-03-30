<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
use Nemundo\Model\Data\AbstractModelUpdate;
class FeedUpdate extends AbstractModelUpdate {
/**
* @var FeedModel
*/
public $model;

/**
* @var string
*/
public $rssUrl;

/**
* @var string
*/
public $title;

public function __construct() {
parent::__construct();
$this->model = new FeedModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->rssUrl, $this->rssUrl);
$this->typeValueList->setModelValue($this->model->title, $this->title);
parent::update();
}
}