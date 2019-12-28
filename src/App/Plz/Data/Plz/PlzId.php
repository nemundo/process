<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
use Nemundo\Model\Id\AbstractModelIdValue;
class PlzId extends AbstractModelIdValue {
/**
* @var PlzModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new PlzModel();
}
}