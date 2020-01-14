<?php
namespace Nemundo\Process\Template\Data\TemplateText;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateTextId extends AbstractModelIdValue {
/**
* @var TemplateTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
}