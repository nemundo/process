<?php
namespace Nemundo\Process\App\Bookmark\Data\Bookmark;
class BookmarkRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var BookmarkModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $url;

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
$this->url = $this->getModelValue($model->url);
$this->title = $this->getModelValue($model->title);
$this->description = $this->getModelValue($model->description);
}
}