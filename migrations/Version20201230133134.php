<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201230133134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Adds product table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE product (
                --(DC2Type:uuid)
                uuid BLOB NOT NULL,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY(uuid)
            )
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE product');
    }
}
