<?php
namespace Nemundo\Process\Search\Data\SearchLog;
use Nemundo\Model\Data\AbstractModelUpdate;
class SearchLogUpdate extends AbstractModelUpdate {
/**
* @var SearchLogModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->searchQuery, $this->searchQuery);
$this->typeValueList->setModelValue($this->model->resultCount, $this->resultCount);
parent::update();
}
}