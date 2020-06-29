<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
use Nemundo\Model\Data\AbstractModelUpdate;
class FeedItemUpdate extends AbstractModelUpdate {
/**
* @var FeedItemModel
*/
public $model;

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

/**
* @var \Nemundo\Core\Type\DateTime\DateTime
*/
public $dateTime;

public function __construct() {
parent::__construct();
$this->model = new FeedItemModel();
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime();
}
public function update() {
$this->typeValueList->setModelValue($this->model->feedId, $this->feedId);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->description, $this->description);
$this->typeValueList->setModelValue($this->model->url, $this->url);
$property = new \Nemundo\Model\Data\Property\DateTime\DateTimeDataProperty($this->model->dateTime, $this->typeValueList);
$property->setValue($this->dateTime);
parent::update();
}
}