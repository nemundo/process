<?php
namespace Nemundo\Process\App\Wiki\Data\WikiType;
class WikiTypeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var WikiTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiTypeModel();
}
}