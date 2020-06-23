<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var YouTubeModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $youtubeId;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $description;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->youtubeId = $this->getModelValue($model->youtubeId);
$this->title = $this->getModelValue($model->title);
$this->description = $this->getModelValue($model->description);
}
}