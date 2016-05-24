<?php

use yii\db\Migration;

/**
 * Handles the creation for table `partido`.
 */
class m160520_190054_create_partido extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('partido', [
            'id' => $this->primaryKey(),
            'fecha' => $this->dateTime()->notNull(),
            'lugar' => $this->string()->notNull(),
            'arbitro_id' => $this->integer()->notNull(),
            'equipo_local_id' => $this->integer()->notNull(),
            'equipo_visitante_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-partido-arbitro_id',
            'partido',
            'arbitro_id'
        );

        $this->addForeignKey(
            'fk-partido-arbitro_id',
            'partido',
            'arbitro_id',
            'arbitro',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-partido-equipo_visitante_id',
            'partido',
            'equipo_visitante_id'
        );

        $this->addForeignKey(
            'fk-partido-equipo_visitante_id',
            'partido',
            'equipo_visitante_id',
            'equipo',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-partido-equipo_local_id',
            'partido',
            'equipo_local_id'
        );

        $this->addForeignKey(
            'fk-partido-equipo_local_id',
            'partido',
            'equipo_local_id',
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
        $this->dropForeignKey(
            'fk-partido-arbitro_id',
            'partido'
        );

        $this->dropIndex(
            'idx-partido-arbitro_id',
            'partido'
        );

        $this->dropForeignKey(
            'idx-partido-equipo_local_id',
            'equipo'
        );

        $this->dropIndex(
            'fk-partido-equipo_local_id',
            'equipo'
        );

        $this->dropForeignKey(
            'idx-partido-equipo_visitante_id',
            'equipo'
        );

        $this->dropIndex(
            'fk-partido-equipo_visitante_id',
            'equipo'
        );

        $this->dropTable('partido');
    }
}
