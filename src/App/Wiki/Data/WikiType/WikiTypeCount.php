<?php
namespace Nemundo\Process\App\Wiki\Data\WikiType;
class WikiTypeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var WikiTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiTypeModel();
}
}