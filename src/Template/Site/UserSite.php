<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Template\Content\User\UserContentAdmin;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\Web\Site\AbstractSite;

class UserSite extends AbstractSite
{

    protected function loadSite()
    {
   $this->title='User';
   $this->url='user';
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $type=new UserContentType();
        $type->getAdmin($page);


        $page->render();


    }

}