CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    phone VARCHAR(20),
    status VARCHAR(50),
    type_login VARCHAR(50)
);

-- Admin table
CREATE TABLE admin (
    id INT PRIMARY KEY,
    user_id INT,
    structure VARCHAR(100),
    password VARCHAR(255),
    email VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Agent table
CREATE TABLE agent (
    id INT PRIMARY KEY,
    user_id INT,
    empreinte VARCHAR(255),
    status VARCHAR(50),
    quota DECIMAL(10,2),
    code_pin VARCHAR(50),
    cumule_retard BOOLEAN,
    email VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Site table
CREATE TABLE site (
    id INT PRIMARY KEY,
    nom VARCHAR(100),
    status VARCHAR(50)
);

-- Region table
CREATE TABLE region (
    id INT PRIMARY KEY,
    emplacement VARCHAR(100),
    nom_region VARCHAR(100)
);

-- Societe Gardinage table
CREATE TABLE societe_gardinage (
    id INT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100),
    status VARCHAR(50),
    prenom VARCHAR(100),
    structure VARCHAR(100),
    contact VARCHAR(100)
);

-- Ronde table
CREATE TABLE ronde (
    id INT PRIMARY KEY,
    qrcode VARCHAR(255),
    emplacement VARCHAR(100)
);

-- Incident table
CREATE TABLE incident (
    id INT PRIMARY KEY,
    description TEXT,
    date DATE,
    type VARCHAR(50)
);

-- Media table
CREATE TABLE media (
    id INT PRIMARY KEY,
    type VARCHAR(50),
    url VARCHAR(255)
);

-- Presence table
CREATE TABLE presence (
    id INT PRIMARY KEY,
    heure_entre DATETIME,
    heure_sorti DATETIME,
    date DATE
);

-- Planning table
CREATE TABLE planning (
    id INT PRIMARY KEY,
    status VARCHAR(50),
    heure_entre DATETIME,
    heure_sorti DATETIME
);

-- Enumeration tables
CREATE TABLE enumeration_status (
    id INT PRIMARY KEY,
    status VARCHAR(50)
);

CREATE TABLE enumeration_role (
    id INT PRIMARY KEY,
    role VARCHAR(50)
);

CREATE TABLE enumeration_horaire (
    id INT PRIMARY KEY,
    matin VARCHAR(50),
    soir VARCHAR(50),
    nuit VARCHAR(50)
);

CREATE TABLE enumeration_presence (
    id INT PRIMARY KEY,
    present VARCHAR(50),
    absent VARCHAR(50),
    retard VARCHAR(50)
);

-- Transfer Vigile table
CREATE TABLE transfer_vigile (
    id INT PRIMARY KEY,
    ancien_site_id INT,
    nouveau_site_id INT,
    date_transfert DATE,
    FOREIGN KEY (ancien_site_id) REFERENCES site(id),
    FOREIGN KEY (nouveau_site_id) REFERENCES site(id)
);

-- Demand Access table
CREATE TABLE demande_acces (
    id INT PRIMARY KEY,
    date DATE,
    status VARCHAR(50)
);