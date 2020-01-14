<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLogRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var SearchLogModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $searchQuery;

/**
* @var int
*/
public $resultCount;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->searchQuery = $this->getModelValue($model->searchQuery);
$this->resultCount = intval($this->getModelValue($model->resultCount));
}
}