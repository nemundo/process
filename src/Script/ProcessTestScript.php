<?php


namespace Nemundo\Process\Script;


use Nemundo\App\Performance\PerformanceStopwatch;
use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Structure\ForLoop;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;
use Nemundo\Process\Template\Test\TextTestData;

class ProcessTestScript extends AbstractConsoleScript
{
    protected function loadScript()
    {
        $this->scriptName = 'process-test';
    }

    public function run()
    {




        $loop = new ForLoop();
        $loop->minNumber=1;
        $loop->maxNumber = 500;

        foreach ($loop->getData() as $number) {




            //(new TextTestData())->createTestData(1000);

            $stop = new PerformanceStopwatch('type');
            $type = new TextContentType();
            $type->text = 'hello world ';
            $type->saveType();
            $stop->stopStopwatch();



            $stop = new PerformanceStopwatch('_content');
            $data = new Content();
            $data->contentTypeId = '123';
            $data->save();
            $stop->stopStopwatch();

            $stop = new PerformanceStopwatch('_template');
            $data = new TemplateText();
            $data->text = '12312312312';
            $data->save();
            $stop->stopStopwatch();

        }

        (new PerformanceStopwatch())->writeToScreen();


        exit;


        /*

        $stop=new Stopwatch();

        $type = new TextContentType();
        $type->text = 'hello world ';
        $type->saveType();

        $stop->stopAndPrintOutput();*/


        //(new TextTestData())->createTestData(1000);

        (new PerformanceStopwatch())->writeToScreen();


        /*
        $loop = new ForLoop();
        $loop->minNumber = 1;
        $loop->maxNumber = 1;
        foreach ($loop->getData() as $number) {
            (new TextTestData())->createTestData(100);
        }*/


    }

}