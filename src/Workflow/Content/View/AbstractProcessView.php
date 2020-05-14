<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Web\Site\AbstractSite;

class AbstractProcessView extends AbstractContentView
{

    use RedirectTrait;

    public $appendParameter = false;

    /**
     * @var AbstractSite
     */
    public $formRedirect;

}