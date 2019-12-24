<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
use Nemundo\Model\Id\AbstractModelIdValue;
class ContentGroupId extends AbstractModelIdValue {
/**
* @var ContentGroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentGroupModel();
}
}