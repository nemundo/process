<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var PlzModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PlzModel();
}
}