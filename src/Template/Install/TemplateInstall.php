<?php


namespace Nemundo\Process\Template\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Template\Content\Audio\AudioContentType;
use Nemundo\Process\Template\Content\File\FileActiveContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Content\FileList\FileListContentType;
use Nemundo\Process\Template\Content\Image\ImageContentType;
use Nemundo\Process\Template\Content\Item\ActiveItemContentType;
use Nemundo\Process\Template\Content\Item\CreateItemContentType;
use Nemundo\Process\Template\Content\Item\EditItemContentType;
use Nemundo\Process\Template\Content\Item\InactiveItemContentType;
use Nemundo\Process\Template\Content\LargeText\LargeTextContentType;
use Nemundo\Process\Template\Content\Source\Add\ChildAddContentType;
use Nemundo\Process\Template\Content\Source\Add\SourceAddContentType;
use Nemundo\Process\Template\Content\Source\Remove\ChildRemoveContentType;
use Nemundo\Process\Template\Content\Source\Remove\SourceRemoveContentType;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Content\Url\UrlContentType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\Process\Template\Content\VersionText\VersionTextContentType;
use Nemundo\Process\Template\Content\Video\VideoContentType;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Process\Template\Script\TemplateCleanScript;
use Nemundo\Process\Template\Script\TemplateTestScript;
use Nemundo\Process\Template\Status\File\FileProcessStatus;
use Nemundo\Process\Template\Status\Reopen\ReopenWorkflowProcessStatus;
use Nemundo\Process\Template\Status\SubjectChange\SubjectChangeProcessStatus;
use Nemundo\Process\Template\Status\WorkflowDelete\WorkflowDeleteStatus;
use Nemundo\Process\Template\Status\WorkflowRestore\WorkflowRestoreStatus;
use Nemundo\Project\Install\AbstractInstall;


class TemplateInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new TemplateCollection());

        $setup = new ContentTypeSetup();
        $setup->addContentType(new LargeTextContentType());
        $setup->addContentType(new FileContentType());
        $setup->addContentType(new FileInactiveContentType());
        $setup->addContentType(new FileActiveContentType());
        $setup->addContentType(new TextContentType());
        $setup->addContentType(new VersionTextContentType());
        $setup->addContentType(new VideoContentType());
        $setup->addContentType(new AudioContentType());
        $setup->addContentType(new ImageContentType());


        $setup = new GroupSetup();
        $setup->addGroupType(new UserContentType());


        (new ContentTypeSetup())
            ->addContentType(new SourceAddContentType())
            ->addContentType(new SourceRemoveContentType())
            ->addContentType(new ChildAddContentType())
            ->addContentType(new ChildRemoveContentType())
            ->addContentType(new ReopenWorkflowProcessStatus())
            ->addContentType(new FileListContentType())
            ->addContentType(new UrlContentType())
            ->addContentType(new WorkflowRestoreStatus())
            ->addContentType(new FileProcessStatus());


        //  $setup->addContentType(new UserContentType());


        $setup = new ContentTypeSetup();
        $setup->addContentType(new SourceAddContentType());
        $setup->addContentType(new SourceRemoveContentType());
        $setup->addContentType(new WorkflowDeleteStatus());


        $setup->addContentType(new SubjectChangeProcessStatus());
        $setup->addContentType(new \Nemundo\Process\Template\Status\DeadlineChange\DeadlineChangeProcessStatus());

        $setup->addContentType(new ActiveItemContentType());
        $setup->addContentType(new CreateItemContentType());
        $setup->addContentType(new EditItemContentType());
        $setup->addContentType(new InactiveItemContentType());

        (new ScriptSetup())
            ->addScript(new TemplateTestScript())
            ->addScript(new TemplateCleanScript());


    }

}