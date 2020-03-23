<?php
namespace Nemundo\Process\App\Share\Data\Share;
use Nemundo\Model\Id\AbstractModelIdValue;
class ShareId extends AbstractModelIdValue {
/**
* @var ShareModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ShareModel();
}
}