<?php

use yii\db\Migration;

/**
 * Handles the creation for table `equipo_color`.
 * Has foreign keys to the tables:
 *
 * - `equipo`
 * - `color`
 */
class m160524_044022_create_junction_equipo_and_color extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('equipo_color', [
            'equipo_id' => $this->integer(),
            'color_id' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
            'PRIMARY KEY(equipo_id, color_id)',
        ]);

        // creates index for column `equipo_id`
        $this->createIndex(
            'idx-equipo_color-equipo_id',
            'equipo_color',
            'equipo_id'
        );

        // add foreign key for table `equipo`
        $this->addForeignKey(
            'fk-equipo_color-equipo_id',
            'equipo_color',
            'equipo_id',
            'equipo',
            'id',
            'CASCADE'
        );

        // creates index for column `color_id`
        $this->createIndex(
            'idx-equipo_color-color_id',
            'equipo_color',
            'color_id'
        );

        // add foreign key for table `color`
        $this->addForeignKey(
            'fk-equipo_color-color_id',
            'equipo_color',
            'color_id',
            'color',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `equipo`
        $this->dropForeignKey(
            'fk-equipo_color-equipo_id',
            'equipo_color'
        );

        // drops index for column `equipo_id`
        $this->dropIndex(
            'idx-equipo_color-equipo_id',
            'equipo_color'
        );

        // drops foreign key for table `color`
        $this->dropForeignKey(
            'fk-equipo_color-color_id',
            'equipo_color'
        );

        // drops index for column `color_id`
        $this->dropIndex(
            'idx-equipo_color-color_id',
            'equipo_color'
        );

        $this->dropTable('equipo_color');
    }
}
