-- Suppression des tables existantes
DROP TABLE IF EXISTS FormationParticipants;
DROP TABLE IF EXISTS Formations;
DROP TABLE IF EXISTS Participants;
DROP TABLE IF EXISTS client_services;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS prestations;
DROP TABLE IF EXISTS interventions;
DROP TABLE IF EXISTS clients;

-- Création des tables
CREATE TABLE clients (
    client_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    adresse VARCHAR(255),
    ville VARCHAR(255),
    telephone VARCHAR(20)
);

CREATE TABLE services (
    service_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    libelle_services VARCHAR(255)
);

CREATE TABLE client_services (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    client_id INT(11),
    service_id INT(11),
    FOREIGN KEY (client_id) REFERENCES clients(client_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id)
);

CREATE TABLE Formations (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    description TEXT,
    cout DECIMAL(10, 2),
    date_debut DATE,
    date_fin DATE
);

CREATE TABLE Participants (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    adresse VARCHAR(255),
    ville VARCHAR(255),
    telephone VARCHAR(20)
);

CREATE TABLE prestations (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    client_id INT(11),
    type_prestation VARCHAR(255),
    description_prestation TEXT,
    cout_prestation DECIMAL(10, 2),
    date_debut_prestation DATE,
    date_fin_prestation DATE,
    statut_prestation VARCHAR(255),
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

CREATE TABLE interventions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    client_id INT(11),
    description_intervention TEXT,
    type_intervention TINYINT(1),
    cout_intervention DECIMAL(10, 2),
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

CREATE TABLE FormationParticipants (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    formation_id INT(11),
    participant_id INT(11),
    status VARCHAR(255),
    description TEXT,
    FOREIGN KEY (formation_id) REFERENCES Formations(id),
    FOREIGN KEY (participant_id) REFERENCES Participants(id)
);