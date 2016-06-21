<?php

use  JoeStewart\RoboDrupalVM\Task\Vm;

class RoboFile extends \Robo\Tasks
{
    use \JoeStewart\RoboDrupalVM\Task\loadTasks;
    use \JoeStewart\RoboDrupalVM\Command\Vm;

    private $vm;
    private $configuration;

    public function __construct() {

      $this->vm = New Vm();
      $this->configuration = $this->vm->configuration;
    }

    public function vmTest()
    {
        $this->stopOnFail(true);
        $this->taskPHPUnit()
            ->option('disallow-test-output')
            ->option('report-useless-tests')
            ->option('strict-coverage')
            ->option('-v')
            ->option('-d error_reporting=-1')
            ->arg('tests')
            ->run();
    }
}
