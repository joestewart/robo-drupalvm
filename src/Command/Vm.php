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