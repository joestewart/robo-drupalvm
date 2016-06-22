<?php

namespace JoeStewart\RoboDrupalVM\Command;

trait Vm
{

	/**
     * Vm Init task.
     *
     * @return object Result
     */
    public function vmInit()
    {
        $result = $this->taskVmInit()
            ->configFile()
            ->vagrantFile()
            ->run();
        return $result;
    }
}
