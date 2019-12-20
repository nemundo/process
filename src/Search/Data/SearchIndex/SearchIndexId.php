<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
use Nemundo\Model\Id\AbstractModelIdValue;
class SearchIndexId extends AbstractModelIdValue {
/**
* @var SearchIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchIndexModel();
}
}