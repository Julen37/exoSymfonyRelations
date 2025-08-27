<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250827114915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract ADD _employee_id INT NOT NULL');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859D2BE43A2 FOREIGN KEY (_employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_E98F2859D2BE43A2 ON contract (_employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859D2BE43A2');
        $this->addSql('DROP INDEX IDX_E98F2859D2BE43A2 ON contract');
        $this->addSql('ALTER TABLE contract DROP _employee_id');
    }
}
