<?php
namespace Nemundo\Process\App\Share\Data\Share;
class ShareDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ShareModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ShareModel();
}
}