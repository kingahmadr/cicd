<?php

namespace App\Database\Migrations;

class Migration_create_users_table extends \CodeIgniter\Database\Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => true            
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
                'null' => true
            ],
            'created_at' => [ 
                'type' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP'
            ],
            'password_reset_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => true
            ],
            'email_verification_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => true
            ],
            'email_verified_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }

}