-- if you want to reset the default contents of the db, run php load_db.php in this directory.

--
-- Structure of the table `poissons`
--

DROP TABLE IF EXISTS poissons;

CREATE TABLE IF NOT EXISTS poissons (
    idP INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    dlc TEXT NOT NULL,
    prix REAL NOT NULL,
    stock INTEGER NOT NULL,
    desc TEXT NOT NULL,
    image TEXT
);

--
-- Contenu of the table `poissons`
--

INSERT INTO poissons (idP, nom, dlc, prix, stock, desc, image) VALUES
(1, 'Salmon', '2026-03-01', '20', '3', "Similar to trout, it lives in all the temperate seas of the Northern Hemisphere.", "../images/saumon.jpg"),
(2, 'Trout', '2021-12-04', '17', '5', 'She has a slender body, a strong face, and a wide mouth.', "../images/truite.jpg"),
(3, 'Whiting', '2004-01-03', '10', '7', 'A small, edible saltwater fish that lives in schools in the English Channel.', "../images/merlan.jpg"),
(4, 'Mackerel', '2022-7-26', '14', '20', "A fish found in temperate seas that is the subject of significant fishing.", "../images/maquereau.jpg")

