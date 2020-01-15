<?php
namespace Nemundo\Process\Template\Data\TemplateFile\Redirect;
class TemplateFileFileRedirectSite extends \Nemundo\Model\Redirect\AbstractRedirectFilenameSite {
public function loadSite() {
parent::loadSite();
$this->url = "template-template-file-file-redirect";
$this->model = new  \Nemundo\Process\Template\Data\TemplateFile\TemplateFileModel();
$this->type = $this->model->file;
}
public function registerSite() {
TemplateFileRedirectConfig::$redirectTemplateFileFileSite = $this;
}
}