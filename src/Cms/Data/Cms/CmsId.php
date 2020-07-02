<?php
namespace Nemundo\Process\Cms\Data\Cms;
use Nemundo\Model\Id\AbstractModelIdValue;
class CmsId extends AbstractModelIdValue {
/**
* @var CmsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsModel();
}
}