<?php
namespace Nemundo\Process\Search\Data\SearchContent;
class SearchContentCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var SearchContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchContentModel();
}
}