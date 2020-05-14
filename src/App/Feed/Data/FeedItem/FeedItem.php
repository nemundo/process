<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItem extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var FeedItemModel
*/
protected $model;

/**
* @var string
*/
public $feedId;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $description;

/**
* @var string
*/
public $url;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->feedId, $this->feedId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->description, $this->description);
$this->typeValueList->setModelValue($this->model->url, $this->url);
$id = parent::save();
return $id;
}
}