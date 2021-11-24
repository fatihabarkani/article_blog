<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120134912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'migration relation article-category';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_blog ADD id_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_blog ADD CONSTRAINT FK_7057D642A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_7057D642A545015 ON article_blog (id_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_blog DROP FOREIGN KEY FK_7057D642A545015');
        $this->addSql('DROP INDEX IDX_7057D642A545015 ON article_blog');
        $this->addSql('ALTER TABLE article_blog DROP id_category_id');
    }
}
