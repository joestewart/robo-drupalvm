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

}
