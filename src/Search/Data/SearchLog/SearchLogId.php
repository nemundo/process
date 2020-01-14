<?php
namespace Nemundo\Process\Search\Data\SearchLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class SearchLogId extends AbstractModelIdValue {
/**
* @var SearchLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SearchLogModel();
}
}