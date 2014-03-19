<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140319161448 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Comment (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, INDEX IDX_5BC96BF0F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Ticket (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, status_id INT DEFAULT NULL, version_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, time VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, isValidated TINYINT(1) NOT NULL, isBlocked TINYINT(1) NOT NULL, githubLink VARCHAR(255) DEFAULT NULL, INDEX IDX_900CA89561220EA6 (creator_id), INDEX IDX_900CA8956BF700BD (status_id), INDEX IDX_900CA8954BBC2705 (version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ticket_team (ticket_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_F63BB327700047D2 (ticket_id), INDEX IDX_F63BB327296CD8AE (team_id), PRIMARY KEY(ticket_id, team_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ticket_role (ticket_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_65B29F52700047D2 (ticket_id), INDEX IDX_65B29F52D60322AC (role_id), PRIMARY KEY(ticket_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ticket_category (ticket_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_8325E540700047D2 (ticket_id), INDEX IDX_8325E54012469DE2 (category_id), PRIMARY KEY(ticket_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ticket_package (ticket_id INT NOT NULL, package_id INT NOT NULL, INDEX IDX_D2A43EC7700047D2 (ticket_id), INDEX IDX_D2A43EC7F44CABFF (package_id), PRIMARY KEY(ticket_id, package_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Version (id INT AUTO_INCREMENT NOT NULL, versionName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Status (id INT AUTO_INCREMENT NOT NULL, statusName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Package (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF0F675F31B FOREIGN KEY (author_id) REFERENCES Ticket (id)");
        $this->addSql("ALTER TABLE Ticket ADD CONSTRAINT FK_900CA89561220EA6 FOREIGN KEY (creator_id) REFERENCES fos_user (id)");
        $this->addSql("ALTER TABLE Ticket ADD CONSTRAINT FK_900CA8956BF700BD FOREIGN KEY (status_id) REFERENCES Status (id)");
        $this->addSql("ALTER TABLE Ticket ADD CONSTRAINT FK_900CA8954BBC2705 FOREIGN KEY (version_id) REFERENCES Version (id)");
        $this->addSql("ALTER TABLE ticket_team ADD CONSTRAINT FK_F63BB327700047D2 FOREIGN KEY (ticket_id) REFERENCES Ticket (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE ticket_team ADD CONSTRAINT FK_F63BB327296CD8AE FOREIGN KEY (team_id) REFERENCES Team (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE ticket_role ADD CONSTRAINT FK_65B29F52700047D2 FOREIGN KEY (ticket_id) REFERENCES Ticket (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE ticket_role ADD CONSTRAINT FK_65B29F52D60322AC FOREIGN KEY (role_id) REFERENCES Role (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE ticket_category ADD CONSTRAINT FK_8325E540700047D2 FOREIGN KEY (ticket_id) REFERENCES Ticket (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE ticket_category ADD CONSTRAINT FK_8325E54012469DE2 FOREIGN KEY (category_id) REFERENCES Category (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE ticket_package ADD CONSTRAINT FK_D2A43EC7700047D2 FOREIGN KEY (ticket_id) REFERENCES Ticket (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE ticket_package ADD CONSTRAINT FK_D2A43EC7F44CABFF FOREIGN KEY (package_id) REFERENCES Package (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE ticket_team DROP FOREIGN KEY FK_F63BB327296CD8AE");
        $this->addSql("ALTER TABLE ticket_category DROP FOREIGN KEY FK_8325E54012469DE2");
        $this->addSql("ALTER TABLE Comment DROP FOREIGN KEY FK_5BC96BF0F675F31B");
        $this->addSql("ALTER TABLE ticket_team DROP FOREIGN KEY FK_F63BB327700047D2");
        $this->addSql("ALTER TABLE ticket_role DROP FOREIGN KEY FK_65B29F52700047D2");
        $this->addSql("ALTER TABLE ticket_category DROP FOREIGN KEY FK_8325E540700047D2");
        $this->addSql("ALTER TABLE ticket_package DROP FOREIGN KEY FK_D2A43EC7700047D2");
        $this->addSql("ALTER TABLE Ticket DROP FOREIGN KEY FK_900CA89561220EA6");
        $this->addSql("ALTER TABLE Ticket DROP FOREIGN KEY FK_900CA8954BBC2705");
        $this->addSql("ALTER TABLE Ticket DROP FOREIGN KEY FK_900CA8956BF700BD");
        $this->addSql("ALTER TABLE ticket_package DROP FOREIGN KEY FK_D2A43EC7F44CABFF");
        $this->addSql("ALTER TABLE ticket_role DROP FOREIGN KEY FK_65B29F52D60322AC");
        $this->addSql("DROP TABLE Comment");
        $this->addSql("DROP TABLE Team");
        $this->addSql("DROP TABLE Category");
        $this->addSql("DROP TABLE Ticket");
        $this->addSql("DROP TABLE ticket_team");
        $this->addSql("DROP TABLE ticket_role");
        $this->addSql("DROP TABLE ticket_category");
        $this->addSql("DROP TABLE ticket_package");
        $this->addSql("DROP TABLE fos_user");
        $this->addSql("DROP TABLE Version");
        $this->addSql("DROP TABLE Status");
        $this->addSql("DROP TABLE Package");
        $this->addSql("DROP TABLE Role");
    }
}
