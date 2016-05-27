<?php

use yii\db\Migration;

/**
 * Handles the creation for table `color`.
 */
class m160520_202103_create_color extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('color', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'hex' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('color');
    }
}
