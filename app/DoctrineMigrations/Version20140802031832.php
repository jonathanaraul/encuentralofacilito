<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140802031832 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE sf2_articulo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, blog VARCHAR(255) NOT NULL, pendiente TINYINT(1) DEFAULT NULL, published TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, fuenteTipo INT NOT NULL, fuenteCategoria INT NOT NULL, INDEX IDX_5D46844AF6FFD933 (fuenteTipo), INDEX IDX_5D46844A58B9F3E0 (fuenteCategoria), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sf2_error (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, descripcion LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sf2_fuente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, blog VARCHAR(255) NOT NULL, published TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, fuenteTipo INT NOT NULL, fuenteCategoria INT NOT NULL, INDEX IDX_145D285BF6FFD933 (fuenteTipo), INDEX IDX_145D285B58B9F3E0 (fuenteCategoria), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sf2_fuente_categoria (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, descripcion LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sf2_fuente_tipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, descripcion LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sf2_imagen (id INT AUTO_INCREMENT NOT NULL, published TINYINT(1) DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, path VARCHAR(255) DEFAULT NULL, tags LONGTEXT DEFAULT NULL, ip VARCHAR(15) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sf2_noticia (id INT AUTO_INCREMENT NOT NULL, imagen INT NOT NULL, published TINYINT(1) DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, ip VARCHAR(15) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, video VARCHAR(255) NOT NULL, INDEX IDX_F03378FF8319D2B3 (imagen), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sf2_pronostico (id INT AUTO_INCREMENT NOT NULL, published TINYINT(1) DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, evento VARCHAR(255) NOT NULL, fecha VARCHAR(255) NOT NULL, pronostico VARCHAR(255) NOT NULL, cuota INT NOT NULL, skate INT NOT NULL, ip VARCHAR(15) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE sf2_articulo ADD CONSTRAINT FK_5D46844AF6FFD933 FOREIGN KEY (fuenteTipo) REFERENCES sf2_fuente_tipo (id)");
        $this->addSql("ALTER TABLE sf2_articulo ADD CONSTRAINT FK_5D46844A58B9F3E0 FOREIGN KEY (fuenteCategoria) REFERENCES sf2_fuente_categoria (id)");
        $this->addSql("ALTER TABLE sf2_fuente ADD CONSTRAINT FK_145D285BF6FFD933 FOREIGN KEY (fuenteTipo) REFERENCES sf2_fuente_tipo (id)");
        $this->addSql("ALTER TABLE sf2_fuente ADD CONSTRAINT FK_145D285B58B9F3E0 FOREIGN KEY (fuenteCategoria) REFERENCES sf2_fuente_categoria (id)");
        $this->addSql("ALTER TABLE sf2_noticia ADD CONSTRAINT FK_F03378FF8319D2B3 FOREIGN KEY (imagen) REFERENCES sf2_imagen (id)");
        $this->addSql("DROP TABLE migration_versions");
        $this->addSql("ALTER TABLE pay_bookies_values ADD CONSTRAINT FK_A81EF2F31922E068 FOREIGN KEY (bookies) REFERENCES bookies (id)");
        $this->addSql("ALTER TABLE pay_bookies_values ADD CONSTRAINT FK_A81EF2F3B9905FED FOREIGN KEY (paysafecardbookies) REFERENCES paysafecardbookies (id)");
        $this->addSql("ALTER TABLE paysafecard ADD CONSTRAINT FK_40B17B481922E068 FOREIGN KEY (bookies) REFERENCES bookies (id)");
        $this->addSql("ALTER TABLE pay_bookies ADD CONSTRAINT FK_FFC827A33AB2ED42 FOREIGN KEY (id_paysafecardbookies) REFERENCES paysafecardbookies (id)");
        $this->addSql("ALTER TABLE pay_bookies ADD CONSTRAINT FK_FFC827A3C7BF4918 FOREIGN KEY (id_bookies) REFERENCES bookies (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE sf2_articulo DROP FOREIGN KEY FK_5D46844A58B9F3E0");
        $this->addSql("ALTER TABLE sf2_fuente DROP FOREIGN KEY FK_145D285B58B9F3E0");
        $this->addSql("ALTER TABLE sf2_articulo DROP FOREIGN KEY FK_5D46844AF6FFD933");
        $this->addSql("ALTER TABLE sf2_fuente DROP FOREIGN KEY FK_145D285BF6FFD933");
        $this->addSql("ALTER TABLE sf2_noticia DROP FOREIGN KEY FK_F03378FF8319D2B3");
        $this->addSql("CREATE TABLE migration_versions (version VARCHAR(255) NOT NULL, PRIMARY KEY(version)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("DROP TABLE sf2_articulo");
        $this->addSql("DROP TABLE sf2_error");
        $this->addSql("DROP TABLE sf2_fuente");
        $this->addSql("DROP TABLE sf2_fuente_categoria");
        $this->addSql("DROP TABLE sf2_fuente_tipo");
        $this->addSql("DROP TABLE sf2_imagen");
        $this->addSql("DROP TABLE sf2_noticia");
        $this->addSql("DROP TABLE sf2_pronostico");
        $this->addSql("ALTER TABLE pay_bookies DROP FOREIGN KEY FK_FFC827A33AB2ED42");
        $this->addSql("ALTER TABLE pay_bookies DROP FOREIGN KEY FK_FFC827A3C7BF4918");
        $this->addSql("ALTER TABLE pay_bookies_values DROP FOREIGN KEY FK_A81EF2F31922E068");
        $this->addSql("ALTER TABLE pay_bookies_values DROP FOREIGN KEY FK_A81EF2F3B9905FED");
        $this->addSql("ALTER TABLE paysafecard DROP FOREIGN KEY FK_40B17B481922E068");
    }
}
