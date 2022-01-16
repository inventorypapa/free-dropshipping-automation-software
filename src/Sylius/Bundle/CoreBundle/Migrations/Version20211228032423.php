<?php

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228032423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_routed (id INT AUTO_INCREMENT NOT NULL, order_item_id INT NOT NULL, inventory_id INT NOT NULL, created_at DATETIME NOT NULL, sent LONGTEXT DEFAULT NULL, received LONGTEXT DEFAULT NULL, invoice_id VARCHAR(32) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('ALTER TABLE sylius_order_item ADD _id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_order_item ADD CONSTRAINT FK_77B587ED6641C530 FOREIGN KEY (_id) REFERENCES order_routed (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77B587ED6641C530 ON sylius_order_item (_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_order_item DROP FOREIGN KEY FK_77B587ED6641C530');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE order_routed');
        $this->addSql('DROP INDEX UNIQ_77B587ED6641C530 ON sylius_order_item');
        $this->addSql('ALTER TABLE sylius_order_item DROP _id');
    }
}
