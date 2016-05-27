<?php

use yii\db\Migration;

/**
 * Handles the creation for table `jugador`.
 */
class m160520_185547_create_jugador extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('jugador', [
            'id' => $this->primaryKey(),
            'persona_id' => $this->integer()->notNull(),
            'num_camiseta' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-jugador-persona_id',
            'jugador',
            'persona_id'
        );

        $this->addForeignKey(
            'fk-jugador-persona_id',
            'jugador',
            'persona_id',
            'persona',
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
            'fk-jugador-persona_id',
            'jugador'
        );

        $this->dropIndex(
            'idx-jugador-persona_id',
            'jugador'
        );
        
        $this->dropTable('jugador');
    }
}
