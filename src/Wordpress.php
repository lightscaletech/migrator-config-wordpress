<?php

namespace Lightscale\Migrator\Config;

class Wordpress {

    private $load_path = '';
    private $namespace = '';
    private $version_key = '';
    private $directory = '';
    private $transactions = true;

    public function __construct(
        $namespace,
        $base_dir,
        $directory = './dbmigrations',
        $load_path = '../../../wp-load.php',
        $transactions = true) {

        $this->namespace = $namespace;
        $this->load_path = $base_dir . $load_path;
        $this->directory = $base_dir . $directory;
        $this->transactions = $transactions;

        $this->version_key = $this->namespace . '_migrator_version';
    }

    public function init_wp() {
        global $wpdb;
        if($wpdb) return;
        require_once('../../../wp-load.php');
    }

    public function version_get($db) {
        return get_option($this->version_key);
    }

    public function version_update($db, $version) {
        update_option($this->version_key, $version, false);
    }

    public function get_db() {
        global $wpdb;
        return $wpdb;
    }

    public function transaction_start($db) {
        $db->query('START TRANSACTION');
    }

    public function transaction_commit($db) {
        $db->query('COMMIT');
    }

    public function transaction_rollback($db) {
        $db->query('ROLLBACK');
    }

    public function config() {
        $conf = [
            'init'              => [$this, 'init_wp'],
            'version_update_fn' => [$this, 'version_update'],
            'version_get_fn'    => [$this, 'version_get'],
            'get_db_fn'         => [$this, 'get_db'],
            'migrations_dir' => $this->directory,
        ];

        if($this->transactions) {
            $conf['transactions_enabled'] = true;
            $conf['transaction_start'] = [$this, 'transaction_start'];
            $conf['transaction_commit'] = [$this, 'transaction_commit'];
            $conf['transaction_rollback'] = [$this, 'transaction_rollback'];
        }
        return $conf;
    }

}
