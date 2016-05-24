<?php

use yii\db\Migration;

/**
 * Handles the creation for table `tarjeta`.
 * Has foreign keys to the tables:
 *
 * - `partido_id`
 * - `jugador_id`
 */
class m160524_045532_create_tarjeta extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tarjeta', [
            'id' => $this->primaryKey(),
            'tipo' => $this->binary()->notNull(),
            'partido_id' => $this->integer()->notNull(),
            'jugador_id' => $this->integer()->notNull(),
            'causa' => $this->string()->notNull(),
            'minuto' => $this->string()->notNull(),
        ]);

        // creates index for column `partido_id`
        $this->createIndex(
            'idx-tarjeta-partido_id',
            'tarjeta',
            'partido_id'
        );

        // add foreign key for table `partido_id`
        $this->addForeignKey(
            'fk-tarjeta-partido_id',
            'tarjeta',
            'partido_id',
            'partido',
            'id',
            'CASCADE'
        );

        // creates index for column `jugador_id`
        $this->createIndex(
            'idx-tarjeta-jugador_id',
            'tarjeta',
            'jugador_id'
        );

        // add foreign key for table `jugador_id`
        $this->addForeignKey(
            'fk-tarjeta-jugador_id',
            'tarjeta',
            'jugador_id',
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
        // drops foreign key for table `partido_id`
        $this->dropForeignKey(
            'fk-tarjeta-partido_id',
            'tarjeta'
        );

        // drops index for column `partido_id`
        $this->dropIndex(
            'idx-tarjeta-partido_id',
            'tarjeta'
        );

        // drops foreign key for table `jugador_id`
        $this->dropForeignKey(
            'fk-tarjeta-jugador_id',
            'tarjeta'
        );

        // drops index for column `jugador_id`
        $this->dropIndex(
            'idx-tarjeta-jugador_id',
            'tarjeta'
        );

        $this->dropTable('tarjeta');
    }
}
