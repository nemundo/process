<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var FeedItemModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $feedId;

/**
* @var \Nemundo\Process\App\Feed\Data\Feed\FeedRow
*/
public $feed;

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

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->feedId = intval($this->getModelValue($model->feedId));
if ($model->feed !== null) {
$this->loadNemundoProcessAppFeedDataFeedFeedfeedRow($model->feed);
}
$this->title = $this->getModelValue($model->title);
$this->description = $this->getModelValue($model->description);
$this->url = $this->getModelValue($model->url);
$this->dateTime = new \Nemundo\Core\Type\DateTime\DateTime($this->getModelValue($model->dateTime));
}
private function loadNemundoProcessAppFeedDataFeedFeedfeedRow($model) {
$this->feed = new \Nemundo\Process\App\Feed\Data\Feed\FeedRow($this->row, $model);
}
}