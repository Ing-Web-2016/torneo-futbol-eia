<?php

use yii\db\Migration;

/**
 * Handles the creation for table `equipo`.
 */
class m160520_190000_create_equipo extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('equipo', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'capitan_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-equipo-capitan_id',
            'equipo',
            'capitan_id'
        );

        $this->addForeignKey(
            'fk-equipo-capitan_id',
            'equipo',
            'capitan_id',
            'jugador',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-equipo-capitan_id',
            'equipo'
        );

        $this->dropIndex(
            'idx-equipo-capitan_id',
            'equipo'
        );
        
        $this->dropTable('equipo');
    }
}
