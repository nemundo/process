<?php
namespace Nemundo\Process\Content\Data\ContentType;
use Nemundo\Model\Id\AbstractModelIdValue;
class ContentTypeId extends AbstractModelIdValue {
/**
* @var ContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
}