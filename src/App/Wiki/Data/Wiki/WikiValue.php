<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class WikiValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var WikiModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiModel();
}
}