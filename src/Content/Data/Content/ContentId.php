<?php
namespace Nemundo\Process\Content\Data\Content;
use Nemundo\Model\Id\AbstractModelIdValue;
class ContentId extends AbstractModelIdValue {
/**
* @var ContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentModel();
}
}