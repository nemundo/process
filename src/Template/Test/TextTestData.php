<?php


namespace Nemundo\Process\Template\Test;


use Nemundo\Dev\TestData\AbstractTestData;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;

class TextTestData extends AbstractTestData
{

    protected function createItem($n)
    {


       /* $data = new TemplateText();
        $data->text = 'hello world ' . $n;
         $data->save();*/


        $type = new TextContentType();
        $type->text = 'hello world ' . $n;
        $type->saveType();

    }

}