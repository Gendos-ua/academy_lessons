-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2017-11-01 15:23:48.982

CREATE SCHEMA feedback;

-- tables
-- Table: author
CREATE TABLE feedback.author (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(50) NOT NULL,
    CONSTRAINT author_pk PRIMARY KEY (id)
);

-- Table: comment
CREATE TABLE feedback.comment (
    id int NOT NULL AUTO_INCREMENT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    comment text NOT NULL,
    author_id int NOT NULL,
    CONSTRAINT comment_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: comment_author (table: comment)
ALTER TABLE feedback.comment ADD CONSTRAINT comment_author FOREIGN KEY comment_author (author_id)
    REFERENCES feedback.author (id);

-- End of file.

