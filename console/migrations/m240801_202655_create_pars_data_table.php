<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pars_data}}`.
 */
class m240801_202655_create_pars_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%pars_data}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer()->notNull(),
            'client_ip' => $this->string()->null(),
            'time_local' => $this->string()->null(),
            'request' => $this->string()->null(),
            'status' => $this->string()->null(),
            'body_bytes_sent' => $this->string()->null(),
            'http_referer' => $this->string()->null(),
            'http_user_agent' => $this->string()->null(),
            'full_row' => $this->text()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);


        // creates index
        $this->createIndex(
            'idx-pars_data-file_id',
            'pars_data',
            'file_id'
        );

        // add foreign key
        $this->addForeignKey(
            'fk-pars_data-file_id',
            'pars_data',
            'file_id',
            'file',
            'id',
            null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey(
            'fk-pars_data-file_id',
            'pars_data'
        );

        // drops index for column `personnel_id`
        $this->dropIndex(
            'idx-pars_data-file_id',
            'pars_data'
        );

        $this->dropTable('{{%pars_data}}');
    }
}
