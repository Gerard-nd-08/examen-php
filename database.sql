CREATE DATABASE hotel;

\c hotel;

CREATE TABLE reservations (
    id SERIAL PRIMARY KEY,
    nom_client VARCHAR(100) NOT NULL,
    numero_chambre INT NOT NULL,
    nombre_nuits INT NOT NULL,
    type_chambre ENUM('STANDARD','CONFORT','SUITE') NOT NULL,
    statut ENUM('VALIDEE','ANNULEE') DEFAULT 'VALIDEE'
);

INSERT INTO reservations (nom_client, numero_chambre, nombre_nuits, type_chambre, statut)
VALUES
('Moussa Ndiaye', 101, 2, 'STANDARD', 'VALIDEE'),
('Awa Diop', 205, 5, 'CONFORT', 'VALIDEE'),
('Fatou Sow', 310, 7, 'SUITE', 'VALIDEE'),
('Ibrahima Fall', 118, 1, 'STANDARD', 'ANNULEE')