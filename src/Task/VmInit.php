<?php

namespace JoeStewart\RoboDrupalVM\Task;


use Robo\Result;
use Robo\Common\ResourceExistenceChecker;
use Robo\Common\Timer;
use Robo\Common\TaskIO;

class VmInit extends \JoeStewart\RoboDrupalVM\Task\Base
{
    // use TaskIO;
    use Timer;
    use ResourceExistenceChecker;


    /**
     * Ensures config.yml is installed.
     *
     * @return $this
     */
    public function configFile()
    {
        if(!file_exists($this->getVagrantConfig())) {
            $source_file = $this->getVagrantSourceConfig();
            $dest_file = $this->getVagrantConfig();
            $value = $this->taskFileSystemStack()
                ->copy($source_file, $dest_file)
                ->run();
        }
        return $this;
    }

    /**
     * Ensures Vagrantfile is installed in project root.
     *
     * @return $this
     */
    public function vagrantFile()
    {
        if(!file_exists($this->getProjectRoot() . '/Vagrantfile')) {
           // $this->printTaskInfo($this->getProjectRoot() . '/Vagrantfile' . 'file not found, initializing...');
           $text = <<<EOF
 # The absolute path to the root directory of the project. Both Drupal VM and
# the config file need to be contained within this path.
ENV['DRUPALVM_PROJECT_ROOT'] = "#{__dir__}"
# The relative path from the project root to the config directory where you
# placed your config.yml file.
ENV['DRUPALVM_CONFIG_DIR'] = "config"
# The relative path from the project root to the directory where Drupal VM is located.
ENV['DRUPALVM_DIR'] = "vendor/geerlingguy/drupal-vm"

# Load the real Vagrantfile
load "#{__dir__}/#{ENV['DRUPALVM_DIR']}/Vagrantfile"
EOF;
            $this->taskWriteToFile($this->getProjectRoot() . '/Vagrantfile')
                ->text($text)
                ->run();
        }
        return $this;
    }

    /**
     * @return Result
     */
    public function run()
    {
        $this->startTimer();
        $this->stopTimer();
        return new Result(
            $this,
            0,
            'VmInit',
            ['time' => $this->getExecutionTime()]
        );

    }
}