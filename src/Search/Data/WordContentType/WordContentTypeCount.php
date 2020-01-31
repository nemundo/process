<?php
namespace Nemundo\Process\Search\Data\WordContentType;
class WordContentTypeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var WordContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WordContentTypeModel();
}
}