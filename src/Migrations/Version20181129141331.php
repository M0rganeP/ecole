<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129141331 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classe_enseignant (classe_id INT NOT NULL, enseignant_id INT NOT NULL, INDEX IDX_249CCE8A8F5EA509 (classe_id), INDEX IDX_249CCE8AE455FCC0 (enseignant_id), PRIMARY KEY(classe_id, enseignant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_evaluation (eleve_id INT NOT NULL, evaluation_id INT NOT NULL, INDEX IDX_11194A27A6CC7B2 (eleve_id), INDEX IDX_11194A27456C5646 (evaluation_id), PRIMARY KEY(eleve_id, evaluation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_matiere (eleve_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_7CAE6C56A6CC7B2 (eleve_id), INDEX IDX_7CAE6C56F46CD258 (matiere_id), PRIMARY KEY(eleve_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant_matiere (enseignant_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_33D1A024E455FCC0 (enseignant_id), INDEX IDX_33D1A024F46CD258 (matiere_id), PRIMARY KEY(enseignant_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE represenant (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe_enseignant ADD CONSTRAINT FK_249CCE8A8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_enseignant ADD CONSTRAINT FK_249CCE8AE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_evaluation ADD CONSTRAINT FK_11194A27A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_evaluation ADD CONSTRAINT FK_11194A27456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_matiere ADD CONSTRAINT FK_7CAE6C56A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_matiere ADD CONSTRAINT FK_7CAE6C56F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant_matiere ADD CONSTRAINT FK_33D1A024E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant_matiere ADD CONSTRAINT FK_33D1A024F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absence_retard ADD noms_eleves_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE absence_retard ADD CONSTRAINT FK_D661D3CE2413F38 FOREIGN KEY (noms_eleves_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_D661D3CE2413F38 ON absence_retard (noms_eleves_id)');
        $this->addSql('ALTER TABLE administrateur ADD identifiants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8D462B653 FOREIGN KEY (identifiants_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32EB52E8D462B653 ON administrateur (identifiants_id)');
        $this->addSql('ALTER TABLE eleve ADD representants_id INT DEFAULT NULL, ADD role_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F75AA0056B FOREIGN KEY (representants_id) REFERENCES representant (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F788987678 FOREIGN KEY (role_id_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F75AA0056B ON eleve (representants_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECA105F788987678 ON eleve (role_id_id)');
        $this->addSql('ALTER TABLE representant ADD role_id_id INT DEFAULT NULL, ADD roles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE representant ADD CONSTRAINT FK_80D5DBC988987678 FOREIGN KEY (role_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE representant ADD CONSTRAINT FK_80D5DBC938C751C4 FOREIGN KEY (roles_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80D5DBC988987678 ON representant (role_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_80D5DBC938C751C4 ON representant (roles_id)');
        $this->addSql('ALTER TABLE utilisateur ADD role VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE classe_enseignant');
        $this->addSql('DROP TABLE eleve_evaluation');
        $this->addSql('DROP TABLE eleve_matiere');
        $this->addSql('DROP TABLE enseignant_matiere');
        $this->addSql('DROP TABLE represenant');
        $this->addSql('ALTER TABLE absence_retard DROP FOREIGN KEY FK_D661D3CE2413F38');
        $this->addSql('DROP INDEX IDX_D661D3CE2413F38 ON absence_retard');
        $this->addSql('ALTER TABLE absence_retard DROP noms_eleves_id');
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8D462B653');
        $this->addSql('DROP INDEX UNIQ_32EB52E8D462B653 ON administrateur');
        $this->addSql('ALTER TABLE administrateur DROP identifiants_id');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F75AA0056B');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F788987678');
        $this->addSql('DROP INDEX IDX_ECA105F75AA0056B ON eleve');
        $this->addSql('DROP INDEX UNIQ_ECA105F788987678 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP representants_id, DROP role_id_id');
        $this->addSql('ALTER TABLE representant DROP FOREIGN KEY FK_80D5DBC988987678');
        $this->addSql('ALTER TABLE representant DROP FOREIGN KEY FK_80D5DBC938C751C4');
        $this->addSql('DROP INDEX UNIQ_80D5DBC988987678 ON representant');
        $this->addSql('DROP INDEX UNIQ_80D5DBC938C751C4 ON representant');
        $this->addSql('ALTER TABLE representant DROP role_id_id, DROP roles_id');
        $this->addSql('ALTER TABLE utilisateur DROP role');
    }
}
