<?php

use yii\db\Migration;

/**
 * Handles the creation for table `arbitro`.
 */
class m160520_185559_create_arbitro extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('arbitro', [
            'id' => $this->primaryKey(),
            'persona_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-arbitro-persona_id',
            'arbitro',
            'persona_id'
        );

        $this->addForeignKey(
            'fk-arbitro-persona_id',
            'arbitro',
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
            'fk-arbitro-persona_id',
            'arbitro'
        );

        $this->dropIndex(
            'idx-arbitro-persona_id',
            'arbitro'
        );
        
        $this->dropTable('arbitro');
    }
}
