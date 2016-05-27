<?php

use yii\db\Migration;

/**
 * Handles the creation for table `personas`.
 */
class m160520_180435_create_persona extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('persona', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'apellido' => $this->string()->notNull(),
            'fecha_nacimiento' => $this->date()->notNull(),
            'direccion' => $this->string()->notNull(),
            'telefono' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('persona');
    }
}
