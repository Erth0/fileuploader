<?php

namespace Database;

use PDO;
use PDOException;

Class Connection {
    /**
     * Database Connfigurations
     *
     * @var array
     */
    protected $config;

    /**
     * Database Connection
     *
     * @var object
     */
    public $db;

    public function __construct(array $config ) {
        $this->config = $config;
        $this->getPDOConnection();
    }

    public function __destruct() {
		$this->db = NULL;
	}

    /**
     * Get the PDO connection
     *
     * @return void
     */
    private function getPDOConnection() {
        // Check if the connection is already established
        if ($this->db == NULL) {
            // Create the connection
            $dsn = "" .
                $this->config['driver'] .
                ":host=" . $this->config['host'] .
                ";dbname=" . $this->config['dbname'];
            try {
                $this->db = new PDO( $dsn, $this->config[ 'username' ], $this->config[ 'password' ] );
            } catch( PDOException $e ) {
                echo __LINE__.$e->getMessage();
            }
        }
    }

    /**
     * Executes query
     *
     * @param string $sql
     * @return void
     */
    public function query($sql) {
        try {
            $count = $this->db->exec($sql) or print_r($this->db->errorInfo());
        } catch(PDOException $e) {
        	echo __LINE__.$e->getMessage();
        }
        return $count;
    }

}
