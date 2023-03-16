<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316074303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD main_book_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331497EFF4D FOREIGN KEY (main_book_id_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331497EFF4D ON book (main_book_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331497EFF4D');
        $this->addSql('DROP INDEX IDX_CBE5A331497EFF4D ON book');
        $this->addSql('ALTER TABLE book DROP main_book_id_id');
    }
}
