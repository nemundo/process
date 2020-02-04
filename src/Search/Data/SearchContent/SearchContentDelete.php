<?php
namespace Nemundo\Process\Search\Data\SearchContent;
class SearchContentDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var SearchContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchContentModel();
}
}