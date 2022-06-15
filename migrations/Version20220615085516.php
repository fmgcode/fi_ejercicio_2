<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615085516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_product_category DROP FOREIGN KEY FK_9107F58B12469DE2');
        $this->addSql('ALTER TABLE products_product_category DROP FOREIGN KEY FK_9107F58B4584665A');
        $this->addSql('CREATE TABLE customer (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, first_lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE products_category');
        $this->addSql('DROP TABLE products_product');
        $this->addSql('DROP TABLE products_product_category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products_category (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_product (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, price_pvp DOUBLE PRECISION DEFAULT \'0\' NOT NULL, price_pvr DOUBLE PRECISION DEFAULT \'0\' NOT NULL, start_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_product_category (product_id INT UNSIGNED NOT NULL, category_id INT UNSIGNED NOT NULL, INDEX IDX_9107F58B12469DE2 (category_id), INDEX IDX_9107F58B4584665A (product_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE products_product_category ADD CONSTRAINT FK_9107F58B12469DE2 FOREIGN KEY (category_id) REFERENCES products_category (id)');
        $this->addSql('ALTER TABLE products_product_category ADD CONSTRAINT FK_9107F58B4584665A FOREIGN KEY (product_id) REFERENCES products_product (id)');
        $this->addSql('DROP TABLE customer');
    }
}
