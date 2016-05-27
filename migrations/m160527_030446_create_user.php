<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160527_030446_create_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
            'activate' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'tipo'=> $this->smallInteger(1)->notNull()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
