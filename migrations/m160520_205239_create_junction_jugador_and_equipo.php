<?php

use yii\db\Migration;

/**
 * Handles the creation for table `jugador_equipo`.
 * Has foreign keys to the tables:
 *
 * - `jugador`
 * - `equipo`
 */
class m160520_205239_create_junction_jugador_and_equipo extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('jugador_equipo', [
            'jugador_id' => $this->integer(),
            'equipo_id' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
            'PRIMARY KEY(jugador_id, equipo_id)',
        ]);

        // creates index for column `jugador_id`
        $this->createIndex(
            'idx-jugador_equipo-jugador_id',
            'jugador_equipo',
            'jugador_id'
        );

        // add foreign key for table `jugador`
        $this->addForeignKey(
            'fk-jugador_equipo-jugador_id',
            'jugador_equipo',
            'jugador_id',
            'jugador',
            'id',
            'CASCADE'
        );

        // creates index for column `equipo_id`
        $this->createIndex(
            'idx-jugador_equipo-equipo_id',
            'jugador_equipo',
            'equipo_id'
        );

        // add foreign key for table `equipo`
        $this->addForeignKey(
            'fk-jugador_equipo-equipo_id',
            'jugador_equipo',
            'equipo_id',
            'equipo',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `jugador`
        $this->dropForeignKey(
            'fk-jugador_equipo-jugador_id',
            'jugador_equipo'
        );

        // drops index for column `jugador_id`
        $this->dropIndex(
            'idx-jugador_equipo-jugador_id',
            'jugador_equipo'
        );

        // drops foreign key for table `equipo`
        $this->dropForeignKey(
            'fk-jugador_equipo-equipo_id',
            'jugador_equipo'
        );

        // drops index for column `equipo_id`
        $this->dropIndex(
            'idx-jugador_equipo-equipo_id',
            'jugador_equipo'
        );

        $this->dropTable('jugador_equipo');
    }
}
