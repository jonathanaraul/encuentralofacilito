<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140802044503 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE sf2_articulo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, blog VARCHAR(255) NOT NULL, pendiente TINYINT(1) DEFAULT NULL, published TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, fuenteTipo INT NOT NULL, fuenteCategoria INT NOT NULL, INDEX IDX_5D46844AF6FFD933 (fuenteTipo), INDEX IDX_5D46844A58B9F3E0 (fuenteCategoria), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE sf2_articulo ADD CONSTRAINT FK_5D46844AF6FFD933 FOREIGN KEY (fuenteTipo) REFERENCES sf2_fuente_tipo (id)");
        $this->addSql("ALTER TABLE sf2_articulo ADD CONSTRAINT FK_5D46844A58B9F3E0 FOREIGN KEY (fuenteCategoria) REFERENCES sf2_fuente_categoria (id)");
        $this->addSql("ALTER TABLE sf2_fuente_categoria ADD published TINYINT(1) DEFAULT NULL");
        $this->addSql("ALTER TABLE sf2_fuente_tipo ADD published TINYINT(1) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE sf2_articulo");
        $this->addSql("ALTER TABLE sf2_fuente_categoria DROP published");
        $this->addSql("ALTER TABLE sf2_fuente_tipo DROP published");
    }
}
