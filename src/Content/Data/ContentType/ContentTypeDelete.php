<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
}