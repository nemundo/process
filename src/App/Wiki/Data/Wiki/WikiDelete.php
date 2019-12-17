<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class WikiDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var WikiModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiModel();
}
}