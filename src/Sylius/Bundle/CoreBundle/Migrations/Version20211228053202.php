<?php

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228053202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_routed ADD CONSTRAINT FK_728957A1E415FB15 FOREIGN KEY (order_item_id) REFERENCES sylius_order_item (id)');
        $this->addSql('ALTER TABLE order_routed ADD CONSTRAINT FK_728957A19EEA759 FOREIGN KEY (inventory_id) REFERENCES inventory (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_728957A1E415FB15 ON order_routed (order_item_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_728957A19EEA759 ON order_routed (inventory_id)');
        $this->addSql('ALTER TABLE sylius_order_item DROP FOREIGN KEY FK_77B587ED6641C530');
        $this->addSql('DROP INDEX UNIQ_77B587ED6641C530 ON sylius_order_item');
        $this->addSql('ALTER TABLE sylius_order_item CHANGE _id routed_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_routed DROP FOREIGN KEY FK_728957A1E415FB15');
        $this->addSql('ALTER TABLE order_routed DROP FOREIGN KEY FK_728957A19EEA759');
        $this->addSql('DROP INDEX UNIQ_728957A1E415FB15 ON order_routed');
        $this->addSql('DROP INDEX UNIQ_728957A19EEA759 ON order_routed');
        $this->addSql('ALTER TABLE sylius_order_item CHANGE routed_id _id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_order_item ADD CONSTRAINT FK_77B587ED6641C530 FOREIGN KEY (_id) REFERENCES order_routed (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77B587ED6641C530 ON sylius_order_item (_id)');
    }
}
