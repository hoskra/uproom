<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106215906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_E2B0C02DD60322AC');
        $this->addSql('DROP INDEX IDX_E2B0C02D8C03F15C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__employee_role AS SELECT employee_id, role_id FROM employee_role');
        $this->addSql('DROP TABLE employee_role');
        $this->addSql('CREATE TABLE employee_role (employee_id INTEGER NOT NULL, role_id INTEGER NOT NULL, PRIMARY KEY(employee_id, role_id), CONSTRAINT FK_E2B0C02D8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E2B0C02DD60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO employee_role (employee_id, role_id) SELECT employee_id, role_id FROM __temp__employee_role');
        $this->addSql('DROP TABLE __temp__employee_role');
        $this->addSql('CREATE INDEX IDX_E2B0C02DD60322AC ON employee_role (role_id)');
        $this->addSql('CREATE INDEX IDX_E2B0C02D8C03F15C ON employee_role (employee_id)');
        $this->addSql('DROP INDEX IDX_42C8495554177093');
        $this->addSql('DROP INDEX IDX_42C849556C066AFE');
        $this->addSql('DROP INDEX IDX_42C84955B03A8386');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, created_by_id, target_user_id, room_id, date FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER DEFAULT NULL, target_user_id INTEGER NOT NULL, room_id INTEGER NOT NULL, date DATETIME NOT NULL, CONSTRAINT FK_42C84955B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C849556C066AFE FOREIGN KEY (target_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reservation (id, created_by_id, target_user_id, room_id, date) SELECT id, created_by_id, target_user_id, room_id, date FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('CREATE INDEX IDX_42C849556C066AFE ON reservation (target_user_id)');
        $this->addSql('CREATE INDEX IDX_42C84955B03A8386 ON reservation (created_by_id)');
        $this->addSql('DROP INDEX IDX_729F519B4D2A7E12');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, building_id, name FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, building_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, is_private BOOLEAN DEFAULT NULL, CONSTRAINT FK_729F519B4D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO room (id, building_id, name) SELECT id, building_id, name FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B4D2A7E12 ON room (building_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649AFF355D1');
        $this->addSql('DROP INDEX UNIQ_8D93D6494CCC447F');
        $this->addSql('DROP INDEX IDX_8D93D6498C03F15C');
        $this->addSql('DROP INDEX UNIQ_8D93D6495E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, employee_id, room_manager_id, group_manager_id, name, roles, password, superuser FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER DEFAULT NULL, room_manager_id INTEGER DEFAULT NULL, group_manager_id INTEGER DEFAULT NULL, name VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , password VARCHAR(255) NOT NULL COLLATE BINARY, superuser BOOLEAN DEFAULT NULL, CONSTRAINT FK_8D93D6498C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D6494CCC447F FOREIGN KEY (room_manager_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D649AFF355D1 FOREIGN KEY (group_manager_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, employee_id, room_manager_id, group_manager_id, name, roles, password, superuser) SELECT id, employee_id, room_manager_id, group_manager_id, name, roles, password, superuser FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AFF355D1 ON user (group_manager_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494CCC447F ON user (room_manager_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498C03F15C ON user (employee_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
        $this->addSql('DROP INDEX IDX_8F02BF9DFE54D947');
        $this->addSql('DROP INDEX IDX_8F02BF9DA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_group AS SELECT user_id, group_id FROM user_group');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('CREATE TABLE user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id), CONSTRAINT FK_8F02BF9DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8F02BF9DFE54D947 FOREIGN KEY (group_id) REFERENCES "group" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_group (user_id, group_id) SELECT user_id, group_id FROM __temp__user_group');
        $this->addSql('DROP TABLE __temp__user_group');
        $this->addSql('CREATE INDEX IDX_8F02BF9DFE54D947 ON user_group (group_id)');
        $this->addSql('CREATE INDEX IDX_8F02BF9DA76ED395 ON user_group (user_id)');
        $this->addSql('DROP INDEX IDX_81E1D5254177093');
        $this->addSql('DROP INDEX IDX_81E1D52A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_room AS SELECT user_id, room_id FROM user_room');
        $this->addSql('DROP TABLE user_room');
        $this->addSql('CREATE TABLE user_room (user_id INTEGER NOT NULL, room_id INTEGER NOT NULL, PRIMARY KEY(user_id, room_id), CONSTRAINT FK_81E1D52A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_81E1D5254177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_room (user_id, room_id) SELECT user_id, room_id FROM __temp__user_room');
        $this->addSql('DROP TABLE __temp__user_room');
        $this->addSql('CREATE INDEX IDX_81E1D5254177093 ON user_room (room_id)');
        $this->addSql('CREATE INDEX IDX_81E1D52A76ED395 ON user_room (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_E2B0C02D8C03F15C');
        $this->addSql('DROP INDEX IDX_E2B0C02DD60322AC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__employee_role AS SELECT employee_id, role_id FROM employee_role');
        $this->addSql('DROP TABLE employee_role');
        $this->addSql('CREATE TABLE employee_role (employee_id INTEGER NOT NULL, role_id INTEGER NOT NULL, PRIMARY KEY(employee_id, role_id))');
        $this->addSql('INSERT INTO employee_role (employee_id, role_id) SELECT employee_id, role_id FROM __temp__employee_role');
        $this->addSql('DROP TABLE __temp__employee_role');
        $this->addSql('CREATE INDEX IDX_E2B0C02D8C03F15C ON employee_role (employee_id)');
        $this->addSql('CREATE INDEX IDX_E2B0C02DD60322AC ON employee_role (role_id)');
        $this->addSql('DROP INDEX IDX_42C84955B03A8386');
        $this->addSql('DROP INDEX IDX_42C849556C066AFE');
        $this->addSql('DROP INDEX IDX_42C8495554177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, created_by_id, target_user_id, room_id, date FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_by_id INTEGER DEFAULT NULL, target_user_id INTEGER NOT NULL, room_id INTEGER NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO reservation (id, created_by_id, target_user_id, room_id, date) SELECT id, created_by_id, target_user_id, room_id, date FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C84955B03A8386 ON reservation (created_by_id)');
        $this->addSql('CREATE INDEX IDX_42C849556C066AFE ON reservation (target_user_id)');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('DROP INDEX IDX_729F519B4D2A7E12');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, building_id, name FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, building_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO room (id, building_id, name) SELECT id, building_id, name FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B4D2A7E12 ON room (building_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D6495E237E06');
        $this->addSql('DROP INDEX IDX_8D93D6498C03F15C');
        $this->addSql('DROP INDEX UNIQ_8D93D6494CCC447F');
        $this->addSql('DROP INDEX UNIQ_8D93D649AFF355D1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, employee_id, room_manager_id, group_manager_id, name, roles, password, superuser FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employee_id INTEGER DEFAULT NULL, room_manager_id INTEGER DEFAULT NULL, group_manager_id INTEGER DEFAULT NULL, name VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, superuser BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, employee_id, room_manager_id, group_manager_id, name, roles, password, superuser) SELECT id, employee_id, room_manager_id, group_manager_id, name, roles, password, superuser FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
        $this->addSql('CREATE INDEX IDX_8D93D6498C03F15C ON user (employee_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494CCC447F ON user (room_manager_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AFF355D1 ON user (group_manager_id)');
        $this->addSql('DROP INDEX IDX_8F02BF9DA76ED395');
        $this->addSql('DROP INDEX IDX_8F02BF9DFE54D947');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_group AS SELECT user_id, group_id FROM user_group');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('CREATE TABLE user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('INSERT INTO user_group (user_id, group_id) SELECT user_id, group_id FROM __temp__user_group');
        $this->addSql('DROP TABLE __temp__user_group');
        $this->addSql('CREATE INDEX IDX_8F02BF9DA76ED395 ON user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_8F02BF9DFE54D947 ON user_group (group_id)');
        $this->addSql('DROP INDEX IDX_81E1D52A76ED395');
        $this->addSql('DROP INDEX IDX_81E1D5254177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_room AS SELECT user_id, room_id FROM user_room');
        $this->addSql('DROP TABLE user_room');
        $this->addSql('CREATE TABLE user_room (user_id INTEGER NOT NULL, room_id INTEGER NOT NULL, PRIMARY KEY(user_id, room_id))');
        $this->addSql('INSERT INTO user_room (user_id, room_id) SELECT user_id, room_id FROM __temp__user_room');
        $this->addSql('DROP TABLE __temp__user_room');
        $this->addSql('CREATE INDEX IDX_81E1D52A76ED395 ON user_room (user_id)');
        $this->addSql('CREATE INDEX IDX_81E1D5254177093 ON user_room (room_id)');
    }
}
