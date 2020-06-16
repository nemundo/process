<?php


namespace Nemundo\Process;


use Nemundo\Core\File\Path;
use Nemundo\Core\Path\PathNew;
use Nemundo\Project\AbstractProject;

class ProcessProject extends AbstractProject
{

    protected function loadProject()
    {

        $this->project = 'Process';
        $this->projectName = 'process';
        $this->path = __DIR__;
        $this->namespace = __NAMESPACE__;

        $this->modelPath = (new PathNew())
            ->addPath(__DIR__)
            ->addPath('..')
            ->addPath('model')
            ->getPath();

    }

}