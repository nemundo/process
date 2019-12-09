<?php
namespace Nemundo\Process\Template\Data\LargeText;
class LargeTextCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var LargeTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new LargeTextModel();
}
}