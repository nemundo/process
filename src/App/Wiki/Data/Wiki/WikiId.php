<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
use Nemundo\Model\Id\AbstractModelIdValue;
class WikiId extends AbstractModelIdValue {
/**
* @var WikiModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiModel();
}
}