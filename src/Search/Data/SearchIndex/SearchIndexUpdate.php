<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
use Nemundo\Model\Data\AbstractModelUpdate;
class SearchIndexUpdate extends AbstractModelUpdate {
/**
* @var SearchIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchIndexModel();
}
public function update() {
parent::update();
}
}