<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

trait ContentFormTrait
{

    /**
     * @var AbstractTreeContentType
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
    public $appendParameter =true;  // false;

    protected function loadUpdateForm()
    {
        (new Debug())->write('loadUpdateForm');
    }

}