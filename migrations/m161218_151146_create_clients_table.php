<?php

use yii\db\Migration;

/**
 * Handles the creation of table `clients`.
 */
class m161218_151146_create_clients_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
            CREATE TABLE `client` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(50) NOT NULL,
                `last_name` varchar(50) NOT NULL,
                `second_name` varchar(50) NOT NULL,
                `date_birth` datetime NOT NULL,
                `sex` tinyint(1) NOT NULL,
                `date_create` datetime NOT NULL,
                `date_change` datetime NOT NULL,          
                PRIMARY KEY (`id`)                
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('client');
    }
}
