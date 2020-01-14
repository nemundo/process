<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLogValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var SearchLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchLogModel();
}
}