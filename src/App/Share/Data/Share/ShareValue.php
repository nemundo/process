<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var ShareModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ShareModel();
}
}