<?php

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228101722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item_reconcile ADD CONSTRAINT FK_3B06AC87E415FB15 FOREIGN KEY (order_item_id) REFERENCES sylius_order_item (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B06AC87E415FB15 ON order_item_reconcile (order_item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_item_reconcile DROP FOREIGN KEY FK_3B06AC87E415FB15');
        $this->addSql('DROP INDEX UNIQ_3B06AC87E415FB15 ON order_item_reconcile');
    }
}
