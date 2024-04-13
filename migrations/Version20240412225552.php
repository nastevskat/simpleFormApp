<?php
declare(strict_types=1);
namespace DoctrineMigrations;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240412225552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (
            id INT AUTO_INCREMENT NOT NULL,
            full_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NOT NULL,
            dob DATE NOT NULL,
            PRIMARY KEY (id)
        )
        DEFAULT CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci
        ENGINE = InnoDB;');
    }
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
