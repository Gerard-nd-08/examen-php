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