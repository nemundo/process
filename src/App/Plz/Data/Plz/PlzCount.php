<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var PlzModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PlzModel();
}
}