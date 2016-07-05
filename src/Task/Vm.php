<?php

namespace JoeStewart\RoboDrupalVM\Task;


use Robo\Result;
use Robo\Task\BaseTask;
use Robo\Common\ExecOneCommand;
use Robo\Contract\CommandInterface;
use Robo\Contract\TaskInterface;
use Robo\Contract\PrintedInterface;
use Robo\Exception\TaskException;

class Vm extends \JoeStewart\RoboDrupalVM\Task\Base
{

    /**
     * @return Result
     */
    public function run()
    {
        return new Result(
            $this,
            0,
            'Vm'
        );
    }
}
