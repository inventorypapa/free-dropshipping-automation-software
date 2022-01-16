<?php

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228095516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_routed ADD CONSTRAINT FK_728957A19EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('CREATE INDEX IDX_728957A19EEA759 ON order_routed (inventory_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_idx ON order_routed (order_item_id, inventory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_routed DROP FOREIGN KEY FK_728957A19EEA759');
        $this->addSql('DROP INDEX IDX_728957A19EEA759 ON order_routed');
        $this->addSql('DROP INDEX uniq_idx ON order_routed');
    }
}