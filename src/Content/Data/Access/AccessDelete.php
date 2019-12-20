<?php
namespace Nemundo\Process\Content\Data\Access;
class AccessDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var AccessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AccessModel();
}
}