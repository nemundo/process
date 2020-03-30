<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class FeedRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var FeedModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $rssUrl;

/**
* @var string
*/
public $title;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->rssUrl = $this->getModelValue($model->rssUrl);
$this->title = $this->getModelValue($model->title);
}
}