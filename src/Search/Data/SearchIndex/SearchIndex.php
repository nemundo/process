<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndex extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var SearchIndexModel
*/
protected $model;

public function __construct() {
parent::__construct();
$this->model = new SearchIndexModel();
}
public function save() {
$id = parent::save();
return $id;
}
}