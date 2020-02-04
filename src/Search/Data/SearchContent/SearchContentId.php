<?php
namespace Nemundo\Process\Search\Data\SearchContent;
use Nemundo\Model\Id\AbstractModelIdValue;
class SearchContentId extends AbstractModelIdValue {
/**
* @var SearchContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchContentModel();
}
}