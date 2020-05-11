<?php


namespace Nemundo\Process\Template\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;

class TemplateCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'template-clean';
    }

    public function run()
    {


        $reader = new TemplateFileReader();
        foreach ($reader->getData() as $fileRow) {

            (new FileContentType($fileRow->id))
                ->deleteType();


        }


    }

}