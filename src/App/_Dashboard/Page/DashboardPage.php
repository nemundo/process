<?php


namespace Nemundo\Process\App\Dashboard\Page;


use Nemundo\Com\Template\AbstractTemplateDocument;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\Cms\Com\Container\CmsEditorContainer;

class DashboardPage extends AbstractTemplateDocument
{

    public function getContent()
    {

        $layout=new BootstrapTwoColumnLayout($this);

        $type=new WikiPageContentType('addc985e-9cd0-4bcb-a54d-0ca3b05fd9db');
        //$type->getView($layout->col1);
        $editor=new CmsEditorContainer($layout->col1);
        $editor->editorName='left';
        $editor->contentType=$type;

        $type=new WikiPageContentType('e4b42912-ae54-4adb-b9e3-4a2463126435');
        //$type->getView($layout->col1);
        $editor=new CmsEditorContainer($layout->col2);
        $editor->editorName='right';
        $editor->contentType=$type;


        return parent::getContent();
    }

}