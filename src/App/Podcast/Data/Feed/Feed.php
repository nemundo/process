<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class Feed extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var FeedModel
*/
protected $model;

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
public function save() {
$this->typeValueList->setModelValue($this->model->rssUrl, $this->rssUrl);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$id = parent::save();
return $id;
}
}