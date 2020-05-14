<?php
namespace Nemundo\Process\App\Feed\Data\Feed;
class Feed extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var FeedModel
*/
protected $model;

/**
* @var string
*/
public $feedUrl;

/**
* @var string
*/
public $title;

public function __construct() {
parent::__construct();
$this->model = new FeedModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->feedUrl, $this->feedUrl);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$id = parent::save();
return $id;
}
}