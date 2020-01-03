<?php
namespace Nemundo\Process\App\Wiki\Data\WikiType;
use Nemundo\Model\Id\AbstractModelIdValue;
class WikiTypeId extends AbstractModelIdValue {
/**
* @var WikiTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WikiTypeModel();
}
}