<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240903191923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alias_directory (id UUID NOT NULL, alias_name VARCHAR(255) NOT NULL, minimal_raiting INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN alias_directory.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE comment (id UUID NOT NULL, publication_id UUID NOT NULL, news_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C38B217A7 ON comment (publication_id)');
        $this->addSql('CREATE INDEX IDX_9474526CB5A459A0 ON comment (news_id)');
        $this->addSql('COMMENT ON COLUMN comment.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN comment.publication_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN comment.news_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE country_directory (id UUID NOT NULL, country_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN country_directory.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE data (id UUID NOT NULL, main_text VARCHAR(5000) NOT NULL, date_send DATE NOT NULL, is_delete BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN data.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE mail (id UUID NOT NULL, sender_id UUID NOT NULL, reciver_id UUID NOT NULL, data_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5126AC48F624B39D ON mail (sender_id)');
        $this->addSql('CREATE INDEX IDX_5126AC4893173582 ON mail (reciver_id)');
        $this->addSql('CREATE INDEX IDX_5126AC4837F5A13C ON mail (data_id)');
        $this->addSql('COMMENT ON COLUMN mail.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN mail.sender_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN mail.reciver_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN mail.data_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE news (id UUID NOT NULL, publication_id UUID NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1DD3995038B217A7 ON news (publication_id)');
        $this->addSql('COMMENT ON COLUMN news.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN news.publication_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE person (id UUID NOT NULL, town_directory_id UUID NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, biography VARCHAR(1000) DEFAULT NULL, date_of_birth DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_34DCD176CA58DF17 ON person (town_directory_id)');
        $this->addSql('COMMENT ON COLUMN person.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN person.town_directory_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE publication (id UUID NOT NULL, profile_id UUID NOT NULL, data_id UUID NOT NULL, raiting INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AF3C6779CCFA12B8 ON publication (profile_id)');
        $this->addSql('CREATE INDEX IDX_AF3C677937F5A13C ON publication (data_id)');
        $this->addSql('COMMENT ON COLUMN publication.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN publication.profile_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN publication.data_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE town_directory (id UUID NOT NULL, country_directory_id UUID NOT NULL, town_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B1E5120620378A8D ON town_directory (country_directory_id)');
        $this->addSql('COMMENT ON COLUMN town_directory.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN town_directory.country_directory_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, person_id UUID NOT NULL, alias_directory_id UUID NOT NULL, date_registration DATE NOT NULL, url_address VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_rejected BOOLEAN NOT NULL, main_raiting INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649217BBB47 ON "user" (person_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649793527DB ON "user" (alias_directory_id)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".person_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".alias_directory_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users_friend (id UUID NOT NULL, profile_id UUID NOT NULL, friend_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A0922F1CCFA12B8 ON users_friend (profile_id)');
        $this->addSql('CREATE INDEX IDX_5A0922F16A5458E8 ON users_friend (friend_id)');
        $this->addSql('COMMENT ON COLUMN users_friend.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users_friend.profile_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users_friend.friend_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC48F624B39D FOREIGN KEY (sender_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC4893173582 FOREIGN KEY (reciver_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC4837F5A13C FOREIGN KEY (data_id) REFERENCES data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD3995038B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176CA58DF17 FOREIGN KEY (town_directory_id) REFERENCES town_directory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779CCFA12B8 FOREIGN KEY (profile_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677937F5A13C FOREIGN KEY (data_id) REFERENCES data (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE town_directory ADD CONSTRAINT FK_B1E5120620378A8D FOREIGN KEY (country_directory_id) REFERENCES country_directory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649793527DB FOREIGN KEY (alias_directory_id) REFERENCES alias_directory (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_friend ADD CONSTRAINT FK_5A0922F1CCFA12B8 FOREIGN KEY (profile_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_friend ADD CONSTRAINT FK_5A0922F16A5458E8 FOREIGN KEY (friend_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C38B217A7');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CB5A459A0');
        $this->addSql('ALTER TABLE mail DROP CONSTRAINT FK_5126AC48F624B39D');
        $this->addSql('ALTER TABLE mail DROP CONSTRAINT FK_5126AC4893173582');
        $this->addSql('ALTER TABLE mail DROP CONSTRAINT FK_5126AC4837F5A13C');
        $this->addSql('ALTER TABLE news DROP CONSTRAINT FK_1DD3995038B217A7');
        $this->addSql('ALTER TABLE person DROP CONSTRAINT FK_34DCD176CA58DF17');
        $this->addSql('ALTER TABLE publication DROP CONSTRAINT FK_AF3C6779CCFA12B8');
        $this->addSql('ALTER TABLE publication DROP CONSTRAINT FK_AF3C677937F5A13C');
        $this->addSql('ALTER TABLE town_directory DROP CONSTRAINT FK_B1E5120620378A8D');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649217BBB47');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649793527DB');
        $this->addSql('ALTER TABLE users_friend DROP CONSTRAINT FK_5A0922F1CCFA12B8');
        $this->addSql('ALTER TABLE users_friend DROP CONSTRAINT FK_5A0922F16A5458E8');
        $this->addSql('DROP TABLE alias_directory');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE country_directory');
        $this->addSql('DROP TABLE data');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE town_directory');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE users_friend');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
