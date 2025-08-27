<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250827114025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD _type_id INT NOT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB1046DEE FOREIGN KEY (_type_id) REFERENCES type_of_company (id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FB1046DEE ON company (_type_id)');
        $this->addSql('ALTER TABLE contract ADD company_id INT NOT NULL');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_E98F2859979B1AD6 ON contract (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB1046DEE');
        $this->addSql('DROP INDEX IDX_4FBF094FB1046DEE ON company');
        $this->addSql('ALTER TABLE company DROP _type_id');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859979B1AD6');
        $this->addSql('DROP INDEX IDX_E98F2859979B1AD6 ON contract');
        $this->addSql('ALTER TABLE contract DROP company_id');
    }
}
