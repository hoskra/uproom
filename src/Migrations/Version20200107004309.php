<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107004309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE building (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE employee (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, surname VARCHAR(50) NOT NULL, last_name VARCHAR(100) NOT NULL, function VARCHAR(255) NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, webpage VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, description VARCHAR(500) DEFAULT NULL)');
        $this->addSql('CREATE TABLE employee_role (employee_id INTEGER NOT NULL, role_id INTEGER NOT NULL, PRIMARY KEY(employee_id, role_id))');
        $this->addSql('CREATE INDEX IDX_E2B0C02D8C03F15C ON employee_role (employee_id)');
        $this->addSql('CREATE INDEX IDX_E2B0C02DD60322AC ON employee_role (role_id)');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER DEFAULT NULL, target_user_id INTEGER NOT NULL, room_id INTEGER NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_42C84955B03A8386 ON reservation (created_by_id)');
        $this->addSql('CREATE INDEX IDX_42C849556C066AFE ON reservation (target_user_id)');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('CREATE TABLE roles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(600) DEFAULT NULL, is_visible BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, building_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, is_private BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_729F519B4D2A7E12 ON room (building_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, room_manager_id INTEGER DEFAULT NULL, group_manager_id INTEGER DEFAULT NULL, name VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, superuser BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494CCC447F ON user (room_manager_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AFF355D1 ON user (group_manager_id)');
        $this->addSql('CREATE TABLE user_user_group (user_id INTEGER NOT NULL, user_group_id INTEGER NOT NULL, PRIMARY KEY(user_id, user_group_id))');
        $this->addSql('CREATE INDEX IDX_28657971A76ED395 ON user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_286579711ED93D47 ON user_user_group (user_group_id)');
        $this->addSql('CREATE TABLE user_room (user_id INTEGER NOT NULL, room_id INTEGER NOT NULL, PRIMARY KEY(user_id, room_id))');
        $this->addSql('CREATE INDEX IDX_81E1D52A76ED395 ON user_room (user_id)');
        $this->addSql('CREATE INDEX IDX_81E1D5254177093 ON user_room (room_id)');
        $this->addSql('CREATE TABLE user_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_role');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_user_group');
        $this->addSql('DROP TABLE user_room');
        $this->addSql('DROP TABLE user_group');
    }
}
