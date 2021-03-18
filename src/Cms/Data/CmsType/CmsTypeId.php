<?php
namespace Nemundo\Process\Cms\Data\CmsType;
use Nemundo\Model\Id\AbstractModelIdValue;
class CmsTypeId extends AbstractModelIdValue {
/**
* @var CmsTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsTypeModel();
}
}