<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140414090523 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Comment DROP FOREIGN KEY FK_5BC96BF0F675F31B");
        $this->addSql("DROP INDEX IDX_5BC96BF0F675F31B ON Comment");
        $this->addSql("ALTER TABLE Comment ADD creator_id INT NOT NULL, ADD comment LONGTEXT NOT NULL, CHANGE author_id ticket_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF0700047D2 FOREIGN KEY (ticket_id) REFERENCES Ticket (id)");
        $this->addSql("ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF061220EA6 FOREIGN KEY (creator_id) REFERENCES fos_user (id)");
        $this->addSql("CREATE INDEX IDX_5BC96BF0700047D2 ON Comment (ticket_id)");
        $this->addSql("CREATE INDEX IDX_5BC96BF061220EA6 ON Comment (creator_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Comment DROP FOREIGN KEY FK_5BC96BF0700047D2");
        $this->addSql("ALTER TABLE Comment DROP FOREIGN KEY FK_5BC96BF061220EA6");
        $this->addSql("DROP INDEX IDX_5BC96BF0700047D2 ON Comment");
        $this->addSql("DROP INDEX IDX_5BC96BF061220EA6 ON Comment");
        $this->addSql("ALTER TABLE Comment DROP creator_id, DROP comment, CHANGE ticket_id author_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF0F675F31B FOREIGN KEY (author_id) REFERENCES Ticket (id)");
        $this->addSql("CREATE INDEX IDX_5BC96BF0F675F31B ON Comment (author_id)");
    }
}
