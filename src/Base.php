<?php

namespace JoeStewart\RoboDrupalVM;

use Robo\Result;
use Robo\Task\BaseTask;
use Robo\Common\ExecOneCommand;
use Robo\Contract\CommandInterface;
use Robo\Contract\TaskInterface;
use Robo\Contract\PrintedInterface;
use Robo\Exception\TaskException;
use Robo\Common\Timer;
use Symfony\Component\Console\Output\NullOutput;

abstract class Base extends \Robo\Tasks implements TaskInterface
{
    
    private $vendor_dir;
    private $vendor_bin;

    protected function getProjectRoot($project_root =  __DIR__ . '/../../../../') {
      return realpath($project_root);
    }
    
    protected function getComposerJson() {
      return $this->getProjectRoot() . '/composer.json';
    }
    
    protected function getVendorDir() {
      if(!$this->vendor_dir) {
        $this->vendor_dir = $this->getComposerConfig( 'vendor-dir');
      }
      return $this->vendor_dir;
    }

    protected function getVendorBin() {
      if(!$this->vendor_bin) {
        $this->vendor_bin = $this->getComposerConfig( 'bin-dir');
      }
      return $this->vendor_bin;
    }

    protected function getWebRoot() {
      return $this->getProjectRoot() . '/web';
    }

    protected function getTmpDir() {
      return $this->getProjectRoot() . '/tmp';
    }

    protected function getDrush() {
      return $this->getVendorBin() . '/drush';
    }

    private function getComposerConfig( $setting) {
      $value = $this->taskExec('composer')
          ->arg('config ' . $setting . ' --absolute --working-dir=' . $this->getProjectRoot())
          ->printed(false)
          ->run()
          ->getMessage();
      return str_replace("\n", '', $value);
    }
}

