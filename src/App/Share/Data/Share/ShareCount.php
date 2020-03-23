<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var ShareModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ShareModel();
}
}