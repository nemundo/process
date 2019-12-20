<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndexValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var SearchIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchIndexModel();
}
}