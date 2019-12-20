<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndexCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var SearchIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchIndexModel();
}
}