<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316095410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, subject_id_id INT DEFAULT NULL, publisher_id_id INT DEFAULT NULL, book_number INT NOT NULL, title VARCHAR(255) NOT NULL, short_title VARCHAR(255) NOT NULL, list_type INT NOT NULL, school_form INT NOT NULL, info VARCHAR(255) DEFAULT NULL, ebook TINYINT(1) NOT NULL, ebook_plus TINYINT(1) NOT NULL, INDEX IDX_CBE5A3316ED75F8F (subject_id_id), INDEX IDX_CBE5A3318AAA43D0 (publisher_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_order (id INT AUTO_INCREMENT NOT NULL, school_class_id_id INT DEFAULT NULL, book_id_id INT DEFAULT NULL, price INT NOT NULL, count INT NOT NULL, ebook TINYINT(1) NOT NULL, ebook_plus TINYINT(1) NOT NULL, teacher_copy TINYINT(1) NOT NULL, INDEX IDX_FBEB86E1CA958DD1 (school_class_id_id), INDEX IDX_FBEB86E171868B2E (book_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_price (id INT AUTO_INCREMENT NOT NULL, book_id_id INT NOT NULL, year INT NOT NULL, price_inclusive_ebook INT NOT NULL, price_ebook INT DEFAULT NULL, price_ebook_plus INT DEFAULT NULL, INDEX IDX_C40A37A071868B2E (book_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, head_of_department_id INT NOT NULL, name VARCHAR(255) NOT NULL, budget INT NOT NULL, used_budget INT NOT NULL, UNIQUE INDEX UNIQ_CD1DE18AD8CDF922 (head_of_department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publisher (id INT AUTO_INCREMENT NOT NULL, publisher_number INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_class (id INT AUTO_INCREMENT NOT NULL, department_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, grade INT NOT NULL, student_amount INT NOT NULL, rep_amount INT NOT NULL, used_budget INT NOT NULL, budget INT NOT NULL, year INT NOT NULL, school_form INT NOT NULL, INDEX IDX_33B1AF8564E7214B (department_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_grade (id INT AUTO_INCREMENT NOT NULL, book_id_id INT DEFAULT NULL, grade INT NOT NULL, INDEX IDX_87A0182E71868B2E (book_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, head_of_subject_id INT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FBCE3E7ADA200AFE (head_of_subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, role_id_id INT NOT NULL, short_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D64988987678 (role_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3316ED75F8F FOREIGN KEY (subject_id_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3318AAA43D0 FOREIGN KEY (publisher_id_id) REFERENCES publisher (id)');
        $this->addSql('ALTER TABLE book_order ADD CONSTRAINT FK_FBEB86E1CA958DD1 FOREIGN KEY (school_class_id_id) REFERENCES school_class (id)');
        $this->addSql('ALTER TABLE book_order ADD CONSTRAINT FK_FBEB86E171868B2E FOREIGN KEY (book_id_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_price ADD CONSTRAINT FK_C40A37A071868B2E FOREIGN KEY (book_id_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AD8CDF922 FOREIGN KEY (head_of_department_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE school_class ADD CONSTRAINT FK_33B1AF8564E7214B FOREIGN KEY (department_id_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE school_grade ADD CONSTRAINT FK_87A0182E71868B2E FOREIGN KEY (book_id_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7ADA200AFE FOREIGN KEY (head_of_subject_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64988987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE book ADD main_book_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331497EFF4D FOREIGN KEY (main_book_id_id) REFERENCES book (id)');
       }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3316ED75F8F');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3318AAA43D0');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331497EFF4D');
        $this->addSql('DROP INDEX IDX_CBE5A331497EFF4D ON book');
        $this->addSql('ALTER TABLE book DROP main_book_id_id');
        $this->addSql('ALTER TABLE book_order DROP FOREIGN KEY FK_FBEB86E1CA958DD1');
        $this->addSql('ALTER TABLE book_order DROP FOREIGN KEY FK_FBEB86E171868B2E');
        $this->addSql('ALTER TABLE book_price DROP FOREIGN KEY FK_C40A37A071868B2E');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AD8CDF922');
        $this->addSql('ALTER TABLE school_class DROP FOREIGN KEY FK_33B1AF8564E7214B');
        $this->addSql('ALTER TABLE school_grade DROP FOREIGN KEY FK_87A0182E71868B2E');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7ADA200AFE');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64988987678');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_order');
        $this->addSql('DROP TABLE book_price');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE publisher');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE school_class');
        $this->addSql('DROP TABLE school_grade');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
