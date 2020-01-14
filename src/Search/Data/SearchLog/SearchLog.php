<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLog extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var SearchLogModel
*/
protected $model;

/**
* @var string
*/
public $searchQuery;

/**
* @var int
*/
public $resultCount;

public function __construct() {
parent::__construct();
$this->model = new SearchLogModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->searchQuery, $this->searchQuery);
$this->typeValueList->setModelValue($this->model->resultCount, $this->resultCount);
$id = parent::save();
return $id;
}
}