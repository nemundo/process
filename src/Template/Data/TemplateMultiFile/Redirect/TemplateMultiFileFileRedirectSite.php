<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile\Redirect;
class TemplateMultiFileFileRedirectSite extends \Nemundo\Model\Redirect\AbstractRedirectFilenameSite {
public function loadSite() {
parent::loadSite();
$this->url = "template-template-multi-file-file-redirect";
$this->model = new  \Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileModel();
$this->type = $this->model->file;
}
public function registerSite() {
TemplateMultiFileRedirectConfig::$redirectTemplateMultiFileFileSite = $this;
}
}