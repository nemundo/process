<?php
namespace Nemundo\Process\Search\Data\SearchContent;
class SearchContentValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var SearchContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchContentModel();
}
}