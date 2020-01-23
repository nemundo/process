<?php


namespace Nemundo\Process\Template\Test;


use Nemundo\Dev\TestData\AbstractTestData;
use Nemundo\Process\Template\Content\Text\TextContentType;

class TextTestData extends AbstractTestData
{

    protected function createItem($n)
    {


        $type=new TextContentType();
        $type->text='hello world';
        $type->saveType();


    }

}