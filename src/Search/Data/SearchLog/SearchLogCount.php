<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var SearchLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchLogModel();
}
}