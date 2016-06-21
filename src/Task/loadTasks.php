<?php
namespace JoeStewart\RoboDrupalVM\Task;

use Robo\Container\SimpleServiceProvider;

trait loadTasks
{
 
   /**
     * Return services.
     */
    public static function getVmServices()
    {
        return new SimpleServiceProvider(
            [
                'taskVmInit' => VmInit::class,
            ]
        );
    }

    /**
     * @return VagrantInit
     */
    protected function taskVmInit()
    {
        return new VmInit();
    }

}
