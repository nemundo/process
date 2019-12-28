<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var PlzModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PlzModel();
}
}