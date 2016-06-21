<?php
namespace JoeStewart\RoboDrupalVM\Task;

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