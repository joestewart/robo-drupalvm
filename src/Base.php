<?php

namespace JoeStewart\RoboDrupalVM;

use Robo\Contract\TaskInterface;

abstract class Base extends \Robo\Tasks implements TaskInterface
{
    
    private $vendor_dir;
    private $vendor_bin;

    /**
     * @var array
     */
    public $configuration = array();

    public function __construct() {


        if (file_exists($this->getVagrantConfig())) {
          $contents = file_get_contents($this->getVagrantConfig());
          $this->configuration = \Symfony\Component\Yaml\Yaml::parse($contents);
        }
    }

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

    protected function getVagrantConfig($config_file = 'config/config.yml') {
        return $this->getProjectRoot() . '/' . $config_file;
    }

    public function getConfigValue($variable_name) {
        $variable_value = $this->configuration[$variable_name];
        return $variable_value;
    }
}

