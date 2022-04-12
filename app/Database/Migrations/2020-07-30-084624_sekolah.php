<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sekolah extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 15,
				'auto_increment' => TRUE
			],
			'address' => [
				'type' => 'VARCHAR',
				'constraint' => 70
			],
			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => 70
			],
			'industry' => [
				'type' => 'ENUM("SD","SMP","SMA","SMK")'
			],
			'photo' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'description' => [
				'type' => 'TEXT'
			],
			'status' => [
				'type' => 'VARCHAR',
                'constraint' => 50
			],
			'website' => [
				'type' => 'VARCHAR',
				'constraint' => 30
			],
			'latitude' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'longitude' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'created_at' => [
				'type' => 'DATETIME'
			],
			'updated_at' => [
				'type' => 'DATETIME'
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('tbl_sekolah');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
