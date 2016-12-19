<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phones`.
 */
class m161218_150853_create_phones_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("
            CREATE TABLE `phone` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `uid` int(11) NOT NULL,
                `phone` varchar(30) NOT NULL,                  
                PRIMARY KEY (`id`),
                KEY (`uid`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phone');
    }
}
