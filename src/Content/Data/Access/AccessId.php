<?php
namespace Nemundo\Process\Content\Data\Access;
use Nemundo\Model\Id\AbstractModelIdValue;
class AccessId extends AbstractModelIdValue {
/**
* @var AccessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AccessModel();
}
}