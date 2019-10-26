<?php

namespace Lightscale\Migrator\Config;

class Wordpress {

    private $load_path = '';
    private $namespace = '';
    private $version_key = '';
    private $directory = '';

    public function __construct(
        $namespace,
        $directory = 'dbmigrations',
        $load_path = '../../../wp-load.php') {

        $this->namespace = $namespace;
        $this->load_path = $load_path;
        $this->directory = $directory;

        $this->version_key = $this->namespace . '_migrator_version';
    }

    public function init_wp() {
        global $wpdb;
        if($wpdb) return;
        require_once('../../../wp-load.php');
    }

    public function version_get() {
        return get_option($this->version_key);
    }

    public function version_update($version) {
        update_option($this->version_key, $version, false);
    }

    public function get_db() {
        global $wpdb;
        return $wpdb;
    }

    public function config() {
        return [
            'init'              => [$this, 'init_wp'],
            'version_update_fn' => [$this, 'version_update'],
            'version_get_fn'    => [$this, 'version_get'],
            'get_db_fn'         => [$this, 'get_db'],

            'migrations_dir' => $this->directory,
        ];
    }

}
