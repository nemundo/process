<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class WikiCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var WikiModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiModel();
}
}