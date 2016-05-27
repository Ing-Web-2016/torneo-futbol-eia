<?php

use yii\db\Migration;

/**
 * Handles the creation for table `gol`.
 * Has foreign keys to the tables:
 *
 * - `partido`
 * - `jugador`
 */
class m160524_045809_create_gol extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('gol', [
            'id' => $this->primaryKey(),
            'minuto' => $this->string()->notNull(),
            'partido_id' => $this->integer()->notNull(),
            'jugador_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `partido_id`
        $this->createIndex(
            'idx-gol-partido_id',
            'gol',
            'partido_id'
        );

        // add foreign key for table `partido`
        $this->addForeignKey(
            'fk-gol-partido_id',
            'gol',
            'partido_id',
            'partido',
            'id',
            'CASCADE'
        );

        // creates index for column `jugador_id`
        $this->createIndex(
            'idx-gol-jugador_id',
            'gol',
            'jugador_id'
        );

        // add foreign key for table `jugador`
        $this->addForeignKey(
            'fk-gol-jugador_id',
            'gol',
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
        // drops foreign key for table `partido`
        $this->dropForeignKey(
            'fk-gol-partido_id',
            'gol'
        );

        // drops index for column `partido_id`
        $this->dropIndex(
            'idx-gol-partido_id',
            'gol'
        );

        // drops foreign key for table `jugador`
        $this->dropForeignKey(
            'fk-gol-jugador_id',
            'gol'
        );

        // drops index for column `jugador_id`
        $this->dropIndex(
            'idx-gol-jugador_id',
            'gol'
        );

        $this->dropTable('gol');
    }
}
