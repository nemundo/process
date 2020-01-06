<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Type\AbstractContentType;

trait ContentFormTrait
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    /**
     * @var string
     */
    public $dataId;

    /**
     * @var string
     */
    public $parentId;

    /**
     * @var bool
     */
    public $createMode = true;

    /**
     * @var bool
     */
    public $appendParameter = false;

    protected function loadUpdateForm()
    {
        (new Debug())->write('loadUpdateForm');
    }

}