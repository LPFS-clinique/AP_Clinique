-- ************************************** `civilite`
DROP TABLE IF EXISTS `civilite`;
CREATE TABLE IF NOT EXISTS `civilite`
(
 `id_civilite` int(1) NOT NULL ,
 `type_civ`    varchar(15) NOT NULL ,

PRIMARY KEY (`id_civilite`)
);

-- Déchargement des données de la table `civilite`
INSERT INTO `civilite` (`id_civilite`, `type_civ`) VALUES
(1, 'Homme'),
(2, 'Femme'),
(3, 'Autre');


-- ************************************** `pays`
DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays`
(
 `id_pays`     int(3) NOT NULL AUTO_INCREMENT ,
 `code`        int NOT NULL,
 `alpha2`      varchar(2) NOT NULL ,
 `alpha3`      varchar(3) NOT NULL ,
 `nom_en_gb` varchar(55) NOT NULL ,
 `nom_fr_fr` varchar(55) NOT NULL ,

PRIMARY KEY (`id_pays`)
);

-- Déchargement de la table à la fin de fichier 


-- ************************************** `categorie_personne`
DROP TABLE IF EXISTS `categorie_personne`;
CREATE TABLE IF NOT EXISTS `categorie_personne`
(
 `id_categorie_personne` int(2) NOT NULL ,
 `categorie_personne`    varchar(45) NOT NULL ,

PRIMARY KEY (`id_categorie_personne`)
);

-- Déchargement des données de la table `categorie_personne`

INSERT INTO `categorie_personne` (`id_categorie_personne`, `categorie_personne`) VALUES
(1, 'Confiance'),
(2, 'Prévenir'),
(3, 'Confiance et Prévenir');


-- ************************************** `services`
DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services`
(
 `id_service`  int(2) NOT NULL AUTO_INCREMENT ,
 `nom_service` varchar(100) NOT NULL ,

PRIMARY KEY (`id_service`)
);

-- Déchargement des données de la table `services`
INSERT INTO `services` (`id_service`, `nom_service`) VALUES
(1, 'Chirurgie viscérale'),
(2, 'Chirurgie vasculaire'),
(3, 'Chirurgie gynécologique'),
(4, 'Chirurgie dentaire'),
(5, 'Chirurgie orthopédique'),
(6, 'Chirurgie O.R.L'),
(7, 'Chirurgie ophtalmologique'),
(8, 'Chirurgie urologique'),
(9, 'Neurochirurgie'),
(10, 'Cancérologie'),
(11, 'Cardiologie'),
(12, 'Gastro-entérologie'),
(13, 'Pneumologie'),
(14, 'Hématologie'),
(15, 'Neurologie'),
(16, 'Endocrinologie'),
(17, 'Pédiatrie'),
(18, 'Réadaptation cardiaque'),
(19, 'Rééducation nutritionnelle'),
(20, 'Soins palliatifs'),
(21, 'Imagerie de radiologie'),
(22, 'Maternité'),
(23, 'Centre AMP'),
(24, 'Plateau technique d’accès direct en cardiologie'),
(25, 'Service de soins non programmés 24H/24 – 7J/7');



-- ************************************** `chambre`
DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre`
(
 `num_type_chambre` int(4) NOT NULL ,
 `type`             varchar(20) NOT NULL ,

PRIMARY KEY (`num_type_chambre`)
);

-- Déchargement des données de la table `chambre`
INSERT INTO `chambre` (`num_type_chambre`, `type`) VALUES
(1, 'Individuelle'),
(2, 'Multi-patient'),
(4, 'Soins Intensifs'),
(5, 'Maternité');


-- ************************************** `poste`
DROP TABLE IF EXISTS `poste`;
CREATE TABLE IF NOT EXISTS `poste`
(
 `id_poste`  int(2) NOT NULL ,
 `nom_poste` varchar(45) NOT NULL ,

PRIMARY KEY (`id_poste`)
);

-- Déchargement des données de la table `poste`
INSERT INTO `poste` (`id_poste`, `nom_poste`) VALUES
(1, 'Directeur de Clinique'),
(2, 'Directeur Financier'),
(3, 'Chef de service Neurologique'),
(4, 'Chef de service Radiologie'),
(5, 'Chef de service Chirurgie'),
(6, 'Responsable sécurité systemes d\'information'),
(7, 'Responsable Pôle Infrastructure et serveurs'),
(8, 'Responsable Pôle Application'),
(9, 'Responsable Pôle RGPD'),
(10, 'Administrateur Réseaux et systèmes'),
(11, 'Développeurs d\'application'),
(12, 'Technicien Support'),
(13, 'Responsable Agents Techniques'),
(14, 'Agent technique'),
(15, 'Médecins'),
(16, 'Infirmiers'),
(17, 'Aides-soignants');


-- ************************************** `documents`
DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents`
(
 `id_doc`     int(2) NOT NULL AUTO_INCREMENT ,
 `ci_recto`   mediumblob NOT NULL ,
 `ci_verso`   mediumblob NOT NULL ,
 `cv`         mediumblob NOT NULL ,
 `mutuelle`   mediumblob NOT NULL ,
 `livret_fam` mediumblob NULL ,

PRIMARY KEY (`id_doc`)
);


-- ************************************** `couverture_sociale`
DROP TABLE IF EXISTS `couverture_sociale`;
CREATE TABLE IF NOT EXISTS `couverture_sociale`
(
 `id_secu`    int(2) NOT NULL AUTO_INCREMENT ,
 `nom_secu`   varchar(45) NOT NULL ,
 `assure`     boolean NOT NULL ,
 `ald`        boolean NOT NULL ,
 `nom_mutu`   varchar(45) NULL ,
 `num_mutu`   int(20) NULL ,

PRIMARY KEY (`id_secu`)
);



-- ************************************** `salarie`
DROP TABLE IF EXISTS `salarie`;
CREATE TABLE IF NOT EXISTS `salarie`
(
 `id_salarie`  int(3) NOT NULL AUTO_INCREMENT ,
 `mail_s`      varchar(50) NOT NULL ,
 `nom_s`       varchar(50) NOT NULL ,
 `prenom_s`    varchar(50) NOT NULL ,
 `id_poste`    int(2) NOT NULL ,
 `id_civilite` int(1) NOT NULL ,

PRIMARY KEY (`id_salarie`),
KEY `FK_2` (`id_poste`),
CONSTRAINT `FK_23_2` FOREIGN KEY `FK_2` (`id_poste`) REFERENCES `poste` (`id_poste`),
KEY `FK_2_1` (`id_civilite`),
CONSTRAINT `FK_30` FOREIGN KEY `FK_2_1` (`id_civilite`) REFERENCES `civilite` (`id_civilite`)
);

INSERT INTO `salarie` (`id_salarie`, `mail_s`, `nom_s`, `prenom_s`, `id_poste`, `id_civilite`) VALUES
(1, 'huppe.victor@lpfs.fr', 'Huppe', 'Victor', 1, 1);


-- ************************************** `medecin`
DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin`
(
 `id_medecin` int(3) NOT NULL AUTO_INCREMENT ,
 `id_service` int(2) NOT NULL ,
 `id_salarie` int(3) NOT NULL ,

PRIMARY KEY (`id_medecin`),
KEY `FK_1` (`id_service`),
CONSTRAINT `FK_17` FOREIGN KEY `FK_1` (`id_service`) REFERENCES `services` (`id_service`),
KEY `FK_2` (`id_salarie`),
CONSTRAINT `FK_28_1` FOREIGN KEY `FK_2` (`id_salarie`) REFERENCES `salarie` (`id_salarie`)
);

INSERT INTO `medecin` (`id_medecin`, `id_service`, `id_salarie`) VALUES
(1, 3, 1);

-- ************************************** `personne`
DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne`
(
 `id_personne`           int(3) NOT NULL AUTO_INCREMENT ,
 `nom_p`                   varchar(50) NOT NULL ,
 `prenom_p`                varchar(50) NOT NULL ,
 `adresse_p`               varchar(50) NOT NULL ,
 `num_tel_p`               varchar(15) NOT NULL ,
 `cp_p`                    int(5) NOT NULL ,
 `ville_p`                 varchar(85) NOT NULL ,
 `id_categorie_personne` int(2) NOT NULL ,
 `id_pays`               int(3) NOT NULL ,
 `id_civilite`           int(1) NOT NULL ,

PRIMARY KEY (`id_personne`),
KEY `FK_1` (`id_pays`),
CONSTRAINT `FK_22` FOREIGN KEY `FK_1` (`id_pays`) REFERENCES `pays` (`id_pays`),
KEY `FK_2` (`id_civilite`),
CONSTRAINT `FK_28` FOREIGN KEY `FK_2` (`id_civilite`) REFERENCES `civilite` (`id_civilite`),
KEY `FK_3` (`id_categorie_personne`),
CONSTRAINT `FK_39` FOREIGN KEY `FK_3` (`id_categorie_personne`) REFERENCES `categorie_personne` (`id_categorie_personne`)
);


-- ************************************** `connexion`
DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion`
(
 `id_connexion` int(3) NOT NULL AUTO_INCREMENT ,
 `identifiant`  varchar(40) NOT NULL ,
 `mdp`          varchar(30) NOT NULL ,
 `premiere_co`  boolean NOT NULL ,
 `mdp_modif`    int NOT NULL ,
 `id_salarie`   int(3) NOT NULL ,

PRIMARY KEY (`id_connexion`),
KEY `FK_1` (`id_salarie`),
CONSTRAINT `FK_29` FOREIGN KEY `FK_1` (`id_salarie`) REFERENCES `salarie` (`id_salarie`)
);

-- INSERT INTO `connexion` (`id_connexion`, `identifiant`, `mdp`, `premiere_co`, `mdp_modif`, `id_salarie`) VALUES
-- (1, 'v.huppe', '$2y$10$B3rAyIUhUXhowcaWojldf.602CJAQNIpInf8sY.8Li9i9Y72M9TEG', 1, 1701776617, 1);


-- ************************************** `patient`
DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient`
(
 `id_patient`       int(4) NOT NULL AUTO_INCREMENT ,
 `num_secu`         varchar(15) NOT NULL ,
 `nom_naissance_pt` varchar(50) NOT NULL ,
 `nom_epouse_pt`    varchar(50) NULL ,
 `prenom_pt`        varchar(50) NOT NULL ,
 `ddn_pt`           date NOT NULL ,
 `adresse_pt`       varchar(50) NOT NULL ,
 `cp_pt`            numeric(5) NOT NULL ,
 `ville_pt`         varchar(85) NOT NULL ,
 `mail_pt`          varchar(55) NOT NULL ,
 `num_tel_pt`       varchar(15) NOT NULL ,
 `id_civilite`      int(1) NOT NULL ,
 `id_doc`           int(2) NOT NULL ,
 `id_secu`          int(2) NOT NULL ,
 `id_pays`          int(3) NOT NULL ,

UNIQUE (`id_doc`),
UNIQUE (`id_secu`),
PRIMARY KEY (`id_patient`),
KEY `FK_1` (`id_civilite`),
CONSTRAINT `FK_11` FOREIGN KEY `FK_1` (`id_civilite`) REFERENCES `civilite` (`id_civilite`),
KEY `FK_3` (`id_doc`),
CONSTRAINT `FK_12` FOREIGN KEY `FK_3` (`id_doc`) REFERENCES `documents` (`id_doc`),
KEY `FK_6_1` (`id_secu`),
CONSTRAINT `FK_13` FOREIGN KEY `FK_6_1` (`id_secu`) REFERENCES `couverture_sociale` (`id_secu`),
KEY `FK_7` (`id_pays`),
CONSTRAINT `FK_16` FOREIGN KEY `FK_7` (`id_pays`) REFERENCES `pays` (`id_pays`)
);


-- ************************************** `personne_patient`
DROP TABLE IF EXISTS `personne_patient`;
CREATE TABLE IF NOT EXISTS `personne_patient`
(
 `id_personne` int(3) NOT NULL ,
 `id_patient`  int(4) NOT NULL ,

PRIMARY KEY (`id_personne`, `id_patient`),
KEY `FK_1` (`id_personne`),
CONSTRAINT `FK_44_1` FOREIGN KEY `FK_1` (`id_personne`) REFERENCES `personne` (`id_personne`),
KEY `FK_2` (`id_patient`),
CONSTRAINT `FK_45_1` FOREIGN KEY `FK_2` (`id_patient`) REFERENCES `patient` (`id_patient`)
);


-- ************************************** `type_hospitalisation`
DROP TABLE IF EXISTS `type_hospitalisation`;
CREATE TABLE IF NOT EXISTS `type_hospitalisation`
(
 `id_type_hospitalisation` int(2) NOT NULL ,
 `type`                    varchar(45) NOT NULL ,

PRIMARY KEY (`id_type_hospitalisation`)
);

-- Déchargement des données de la table `type_hospitalisation`
INSERT INTO `type_hospitalisation` (`id_type_hospitalisation`, `type`) VALUES
(2, 'Hospitalisation'),
(1, 'Ambulatoire Chirurgie');



-- ************************************** `hospitalisation`
DROP TABLE IF EXISTS `hospitalisation`;
CREATE TABLE IF NOT EXISTS `hospitalisation`
(
 `id_hosp`                 int(2) NOT NULL AUTO_INCREMENT ,
 `date`                    date NOT NULL ,
 `heure`                   time NOT NULL ,
 `passe`                   boolean NOT NULL ,
 `id_patient`              int(4) NOT NULL ,
 `id_medecin`              int(3) NOT NULL ,
 `num_type_chambre`        int(4) NOT NULL ,
 `id_type_hospitalisation` int(2) NOT NULL ,

PRIMARY KEY (`id_hosp`),
KEY `FK_1` (`id_medecin`),
CONSTRAINT `FK_8` FOREIGN KEY `FK_1` (`id_medecin`) REFERENCES `medecin` (`id_medecin`),
KEY `FK_2` (`num_type_chambre`),
CONSTRAINT `FK_23_1` FOREIGN KEY `FK_2` (`num_type_chambre`) REFERENCES `chambre` (`num_type_chambre`),
KEY `FK_3` (`id_type_hospitalisation`),
CONSTRAINT `FK_40` FOREIGN KEY `FK_3` (`id_type_hospitalisation`) REFERENCES `type_hospitalisation` (`id_type_hospitalisation`),
KEY `FK_4` (`id_patient`),
CONSTRAINT `FK_45_2` FOREIGN KEY `FK_4` (`id_patient`) REFERENCES `patient` (`id_patient`)
);




-- Déchargement des données de la table `pays`
INSERT INTO `pays` (`id_pays`, `code`, `alpha2`, `alpha3`, `nom_en_gb`, `nom_fr_fr`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan', 'Afghanistan'),
(2, 8, 'AL', 'ALB', 'Albania', 'Albanie'),
(3, 10, 'AQ', 'ATA', 'Antarctica', 'Antarctique'),
(4, 12, 'DZ', 'DZA', 'Algeria', 'Algérie'),
(5, 16, 'AS', 'ASM', 'American Samoa', 'Samoa Américaines'),
(6, 20, 'AD', 'AND', 'Andorra', 'Andorre'),
(7, 24, 'AO', 'AGO', 'Angola', 'Angola'),
(8, 28, 'AG', 'ATG', 'Antigua and Barbuda', 'Antigua-et-Barbuda'),
(9, 31, 'AZ', 'AZE', 'Azerbaijan', 'Azerbaïdjan'),
(10, 32, 'AR', 'ARG', 'Argentina', 'Argentine'),
(11, 36, 'AU', 'AUS', 'Australia', 'Australie'),
(12, 40, 'AT', 'AUT', 'Austria', 'Autriche'),
(13, 44, 'BS', 'BHS', 'Bahamas', 'Bahamas'),
(14, 48, 'BH', 'BHR', 'Bahrain', 'Bahreïn'),
(15, 50, 'BD', 'BGD', 'Bangladesh', 'Bangladesh'),
(16, 51, 'AM', 'ARM', 'Armenia', 'Arménie'),
(17, 52, 'BB', 'BRB', 'Barbados', 'Barbade'),
(18, 56, 'BE', 'BEL', 'Belgium', 'Belgique'),
(19, 60, 'BM', 'BMU', 'Bermuda', 'Bermudes'),
(20, 64, 'BT', 'BTN', 'Bhutan', 'Bhoutan'),
(21, 68, 'BO', 'BOL', 'Bolivia', 'Bolivie'),
(22, 70, 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnie-Herzégovine'),
(23, 72, 'BW', 'BWA', 'Botswana', 'Botswana'),
(24, 74, 'BV', 'BVT', 'Bouvet Island', 'Île Bouvet'),
(25, 76, 'BR', 'BRA', 'Brazil', 'Brésil'),
(26, 84, 'BZ', 'BLZ', 'Belize', 'Belize'),
(27, 86, 'IO', 'IOT', 'British Indian Ocean Territory', 'Territoire Britannique de l\'Océan Indien'),
(28, 90, 'SB', 'SLB', 'Solomon Islands', 'Îles Salomon'),
(29, 92, 'VG', 'VGB', 'British Virgin Islands', 'Îles Vierges Britanniques'),
(30, 96, 'BN', 'BRN', 'Brunei Darussalam', 'Brunéi Darussalam'),
(31, 100, 'BG', 'BGR', 'Bulgaria', 'Bulgarie'),
(32, 104, 'MM', 'MMR', 'Myanmar', 'Myanmar'),
(33, 108, 'BI', 'BDI', 'Burundi', 'Burundi'),
(34, 112, 'BY', 'BLR', 'Belarus', 'Bélarus'),
(35, 116, 'KH', 'KHM', 'Cambodia', 'Cambodge'),
(36, 120, 'CM', 'CMR', 'Cameroon', 'Cameroun'),
(37, 124, 'CA', 'CAN', 'Canada', 'Canada'),
(38, 132, 'CV', 'CPV', 'Cape Verde', 'Cap-vert'),
(39, 136, 'KY', 'CYM', 'Cayman Islands', 'Îles Caïmanes'),
(40, 140, 'CF', 'CAF', 'Central African', 'République Centrafricaine'),
(41, 144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lanka'),
(42, 148, 'TD', 'TCD', 'Chad', 'Tchad'),
(43, 152, 'CL', 'CHL', 'Chile', 'Chili'),
(44, 156, 'CN', 'CHN', 'China', 'Chine'),
(45, 158, 'TW', 'TWN', 'Taiwan', 'Taïwan'),
(46, 162, 'CX', 'CXR', 'Christmas Island', 'Île Christmas'),
(47, 166, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'Îles Cocos (Keeling)'),
(48, 170, 'CO', 'COL', 'Colombia', 'Colombie'),
(49, 174, 'KM', 'COM', 'Comoros', 'Comores'),
(50, 175, 'YT', 'MYT', 'Mayotte', 'Mayotte'),
(51, 178, 'CG', 'COG', 'Republic of the Congo', 'République du Congo'),
(52, 180, 'CD', 'COD', 'The Democratic Republic Of The Congo', 'République Démocratique du Congo'),
(53, 184, 'CK', 'COK', 'Cook Islands', 'Îles Cook'),
(54, 188, 'CR', 'CRI', 'Costa Rica', 'Costa Rica'),
(55, 191, 'HR', 'HRV', 'Croatia', 'Croatie'),
(56, 192, 'CU', 'CUB', 'Cuba', 'Cuba'),
(57, 196, 'CY', 'CYP', 'Cyprus', 'Chypre'),
(58, 203, 'CZ', 'CZE', 'Czech Republic', 'République Tchèque'),
(59, 204, 'BJ', 'BEN', 'Benin', 'Bénin'),
(60, 208, 'DK', 'DNK', 'Denmark', 'Danemark'),
(61, 212, 'DM', 'DMA', 'Dominica', 'Dominique'),
(62, 214, 'DO', 'DOM', 'Dominican Republic', 'République Dominicaine'),
(63, 218, 'EC', 'ECU', 'Ecuador', 'Équateur'),
(64, 222, 'SV', 'SLV', 'El Salvador', 'El Salvador'),
(65, 226, 'GQ', 'GNQ', 'Equatorial Guinea', 'Guinée Équatoriale'),
(66, 231, 'ET', 'ETH', 'Ethiopia', 'Éthiopie'),
(67, 232, 'ER', 'ERI', 'Eritrea', 'Érythrée'),
(68, 233, 'EE', 'EST', 'Estonia', 'Estonie'),
(69, 234, 'FO', 'FRO', 'Faroe Islands', 'Îles Féroé'),
(70, 238, 'FK', 'FLK', 'Falkland Islands', 'Îles (malvinas) Falkland'),
(71, 239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'Géorgie du Sud et les Îles Sandwich du Sud'),
(72, 242, 'FJ', 'FJI', 'Fiji', 'Fidji'),
(73, 246, 'FI', 'FIN', 'Finland', 'Finlande'),
(74, 248, 'AX', 'ALA', 'Åland Islands', 'Îles Åland'),
(75, 250, 'FR', 'FRA', 'France', 'France'),
(76, 254, 'GF', 'GUF', 'French Guiana', 'Guyane Française'),
(77, 258, 'PF', 'PYF', 'French Polynesia', 'Polynésie Française'),
(78, 260, 'TF', 'ATF', 'French Southern Territories', 'Terres Australes Françaises'),
(79, 262, 'DJ', 'DJI', 'Djibouti', 'Djibouti'),
(80, 266, 'GA', 'GAB', 'Gabon', 'Gabon'),
(81, 268, 'GE', 'GEO', 'Georgia', 'Géorgie'),
(82, 270, 'GM', 'GMB', 'Gambia', 'Gambie'),
(83, 275, 'PS', 'PSE', 'Occupied Palestinian Territory', 'Territoire Palestinien Occupé'),
(84, 276, 'DE', 'DEU', 'Germany', 'Allemagne'),
(85, 288, 'GH', 'GHA', 'Ghana', 'Ghana'),
(86, 292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar'),
(87, 296, 'KI', 'KIR', 'Kiribati', 'Kiribati'),
(88, 300, 'GR', 'GRC', 'Greece', 'Grèce'),
(89, 304, 'GL', 'GRL', 'Greenland', 'Groenland'),
(90, 308, 'GD', 'GRD', 'Grenada', 'Grenade'),
(91, 312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe'),
(92, 316, 'GU', 'GUM', 'Guam', 'Guam'),
(93, 320, 'GT', 'GTM', 'Guatemala', 'Guatemala'),
(94, 324, 'GN', 'GIN', 'Guinea', 'Guinée'),
(95, 328, 'GY', 'GUY', 'Guyana', 'Guyana'),
(96, 332, 'HT', 'HTI', 'Haiti', 'Haïti'),
(97, 334, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'Îles Heard et Mcdonald'),
(98, 336, 'VA', 'VAT', 'Vatican City State', 'Saint-Siège (état de la Cité du Vatican)'),
(99, 340, 'HN', 'HND', 'Honduras', 'Honduras'),
(100, 344, 'HK', 'HKG', 'Hong Kong', 'Hong-Kong'),
(101, 348, 'HU', 'HUN', 'Hungary', 'Hongrie'),
(102, 352, 'IS', 'ISL', 'Iceland', 'Islande'),
(103, 356, 'IN', 'IND', 'India', 'Inde'),
(104, 360, 'ID', 'IDN', 'Indonesia', 'Indonésie'),
(105, 364, 'IR', 'IRN', 'Islamic Republic of Iran', 'République Islamique d\'Iran'),
(106, 368, 'IQ', 'IRQ', 'Iraq', 'Iraq'),
(107, 372, 'IE', 'IRL', 'Ireland', 'Irlande'),
(108, 376, 'IL', 'ISR', 'Israel', 'Israël'),
(109, 380, 'IT', 'ITA', 'Italy', 'Italie'),
(110, 384, 'CI', 'CIV', 'Côte d\'Ivoire', 'Côte d\'Ivoire'),
(111, 388, 'JM', 'JAM', 'Jamaica', 'Jamaïque'),
(112, 392, 'JP', 'JPN', 'Japan', 'Japon'),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstan'),
(114, 400, 'JO', 'JOR', 'Jordan', 'Jordanie'),
(115, 404, 'KE', 'KEN', 'Kenya', 'Kenya'),
(116, 408, 'KP', 'PRK', 'Democratic People\'s Republic of Korea', 'République Populaire Démocratique de Corée'),
(117, 410, 'KR', 'KOR', 'Republic of Korea', 'République de Corée'),
(118, 414, 'KW', 'KWT', 'Kuwait', 'Koweït'),
(119, 417, 'KG', 'KGZ', 'Kyrgyzstan', 'Kirghizistan'),
(120, 418, 'LA', 'LAO', 'Lao People\'s Democratic Republic', 'République Démocratique Populaire Lao'),
(121, 422, 'LB', 'LBN', 'Lebanon', 'Liban'),
(122, 426, 'LS', 'LSO', 'Lesotho', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Latvia', 'Lettonie'),
(124, 430, 'LR', 'LBR', 'Liberia', 'Libéria'),
(125, 434, 'LY', 'LBY', 'Libyan Arab Jamahiriya', 'Jamahiriya Arabe Libyenne'),
(126, 438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein'),
(127, 440, 'LT', 'LTU', 'Lithuania', 'Lituanie'),
(128, 442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg'),
(129, 446, 'MO', 'MAC', 'Macao', 'Macao'),
(130, 450, 'MG', 'MDG', 'Madagascar', 'Madagascar'),
(131, 454, 'MW', 'MWI', 'Malawi', 'Malawi'),
(132, 458, 'MY', 'MYS', 'Malaysia', 'Malaisie'),
(133, 462, 'MV', 'MDV', 'Maldives', 'Maldives'),
(134, 466, 'ML', 'MLI', 'Mali', 'Mali'),
(135, 470, 'MT', 'MLT', 'Malta', 'Malte'),
(136, 474, 'MQ', 'MTQ', 'Martinique', 'Martinique'),
(137, 478, 'MR', 'MRT', 'Mauritania', 'Mauritanie'),
(138, 480, 'MU', 'MUS', 'Mauritius', 'Maurice'),
(139, 484, 'MX', 'MEX', 'Mexico', 'Mexique'),
(140, 492, 'MC', 'MCO', 'Monaco', 'Monaco'),
(141, 496, 'MN', 'MNG', 'Mongolia', 'Mongolie'),
(142, 498, 'MD', 'MDA', 'Republic of Moldova', 'République de Moldova'),
(143, 500, 'MS', 'MSR', 'Montserrat', 'Montserrat'),
(144, 504, 'MA', 'MAR', 'Morocco', 'Maroc'),
(145, 508, 'MZ', 'MOZ', 'Mozambique', 'Mozambique'),
(146, 512, 'OM', 'OMN', 'Oman', 'Oman'),
(147, 516, 'NA', 'NAM', 'Namibia', 'Namibie'),
(148, 520, 'NR', 'NRU', 'Nauru', 'Nauru'),
(149, 524, 'NP', 'NPL', 'Nepal', 'Népal'),
(150, 528, 'NL', 'NLD', 'Netherlands', 'Pays-Bas'),
(151, 530, 'AN', 'ANT', 'Netherlands Antilles', 'Antilles Néerlandaises'),
(152, 533, 'AW', 'ABW', 'Aruba', 'Aruba'),
(153, 540, 'NC', 'NCL', 'New Caledonia', 'Nouvelle-Calédonie'),
(154, 548, 'VU', 'VUT', 'Vanuatu', 'Vanuatu'),
(155, 554, 'NZ', 'NZL', 'New Zealand', 'Nouvelle-Zélande'),
(156, 558, 'NI', 'NIC', 'Nicaragua', 'Nicaragua'),
(157, 562, 'NE', 'NER', 'Niger', 'Niger'),
(158, 566, 'NG', 'NGA', 'Nigeria', 'Nigéria'),
(159, 570, 'NU', 'NIU', 'Niue', 'Niué'),
(160, 574, 'NF', 'NFK', 'Norfolk Island', 'Île Norfolk'),
(161, 578, 'NO', 'NOR', 'Norway', 'Norvège'),
(162, 580, 'MP', 'MNP', 'Northern Mariana Islands', 'Îles Mariannes du Nord'),
(163, 581, 'UM', 'UMI', 'United States Minor Outlying Islands', 'Îles Mineures Éloignées des États-Unis'),
(164, 583, 'FM', 'FSM', 'Federated States of Micronesia', 'États Fédérés de Micronésie'),
(165, 584, 'MH', 'MHL', 'Marshall Islands', 'Îles Marshall'),
(166, 585, 'PW', 'PLW', 'Palau', 'Palaos'),
(167, 586, 'PK', 'PAK', 'Pakistan', 'Pakistan'),
(168, 591, 'PA', 'PAN', 'Panama', 'Panama'),
(169, 598, 'PG', 'PNG', 'Papua New Guinea', 'Papouasie-Nouvelle-Guinée'),
(170, 600, 'PY', 'PRY', 'Paraguay', 'Paraguay'),
(171, 604, 'PE', 'PER', 'Peru', 'Pérou'),
(172, 608, 'PH', 'PHL', 'Philippines', 'Philippines'),
(173, 612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn'),
(174, 616, 'PL', 'POL', 'Poland', 'Pologne'),
(175, 620, 'PT', 'PRT', 'Portugal', 'Portugal'),
(176, 624, 'GW', 'GNB', 'Guinea-Bissau', 'Guinée-Bissau'),
(177, 626, 'TL', 'TLS', 'Timor-Leste', 'Timor-Leste'),
(178, 630, 'PR', 'PRI', 'Puerto Rico', 'Porto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar', 'Qatar'),
(180, 638, 'RE', 'REU', 'Réunion', 'Réunion'),
(181, 642, 'RO', 'ROU', 'Romania', 'Roumanie'),
(182, 643, 'RU', 'RUS', 'Russian Federation', 'Fédération de Russie'),
(183, 646, 'RW', 'RWA', 'Rwanda', 'Rwanda'),
(184, 654, 'SH', 'SHN', 'Saint Helena', 'Sainte-Hélène'),
(185, 659, 'KN', 'KNA', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis'),
(186, 660, 'AI', 'AIA', 'Anguilla', 'Anguilla'),
(187, 662, 'LC', 'LCA', 'Saint Lucia', 'Sainte-Lucie'),
(188, 666, 'PM', 'SPM', 'Saint-Pierre and Miquelon', 'Saint-Pierre-et-Miquelon'),
(189, 670, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint-Vincent-et-les Grenadines'),
(190, 674, 'SM', 'SMR', 'San Marino', 'Saint-Marin'),
(191, 678, 'ST', 'STP', 'Sao Tome and Principe', 'Sao Tomé-et-Principe'),
(192, 682, 'SA', 'SAU', 'Saudi Arabia', 'Arabie Saoudite'),
(193, 686, 'SN', 'SEN', 'Senegal', 'Sénégal'),
(194, 690, 'SC', 'SYC', 'Seychelles', 'Seychelles'),
(195, 694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leone'),
(196, 702, 'SG', 'SGP', 'Singapore', 'Singapour'),
(197, 703, 'SK', 'SVK', 'Slovakia', 'Slovaquie'),
(198, 704, 'VN', 'VNM', 'Vietnam', 'Viet Nam'),
(199, 705, 'SI', 'SVN', 'Slovenia', 'Slovénie'),
(200, 706, 'SO', 'SOM', 'Somalia', 'Somalie'),
(201, 710, 'ZA', 'ZAF', 'South Africa', 'Afrique du Sud'),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwe'),
(203, 724, 'ES', 'ESP', 'Spain', 'Espagne'),
(204, 732, 'EH', 'ESH', 'Western Sahara', 'Sahara Occidental'),
(205, 736, 'SD', 'SDN', 'Sudan', 'Soudan'),
(206, 740, 'SR', 'SUR', 'Suriname', 'Suriname'),
(207, 744, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard etÎle Jan Mayen'),
(208, 748, 'SZ', 'SWZ', 'Swaziland', 'Swaziland'),
(209, 752, 'SE', 'SWE', 'Sweden', 'Suède'),
(210, 756, 'CH', 'CHE', 'Switzerland', 'Suisse'),
(211, 760, 'SY', 'SYR', 'Syrian Arab Republic', 'République Arabe Syrienne'),
(212, 762, 'TJ', 'TJK', 'Tajikistan', 'Tadjikistan'),
(213, 764, 'TH', 'THA', 'Thailand', 'Thaïlande'),
(214, 768, 'TG', 'TGO', 'Togo', 'Togo'),
(215, 772, 'TK', 'TKL', 'Tokelau', 'Tokelau'),
(216, 776, 'TO', 'TON', 'Tonga', 'Tonga'),
(217, 780, 'TT', 'TTO', 'Trinidad and Tobago', 'Trinité-et-Tobago'),
(218, 784, 'AE', 'ARE', 'United Arab Emirates', 'Émirats Arabes Unis'),
(219, 788, 'TN', 'TUN', 'Tunisia', 'Tunisie'),
(220, 792, 'TR', 'TUR', 'Turkey', 'Turquie'),
(221, 795, 'TM', 'TKM', 'Turkmenistan', 'Turkménistan'),
(222, 796, 'TC', 'TCA', 'Turks and Caicos Islands', 'Îles Turks et Caïques'),
(223, 798, 'TV', 'TUV', 'Tuvalu', 'Tuvalu'),
(224, 800, 'UG', 'UGA', 'Uganda', 'Ouganda'),
(225, 804, 'UA', 'UKR', 'Ukraine', 'Ukraine'),
(226, 807, 'MK', 'MKD', 'The Former Yugoslav Republic of Macedonia', 'L\'ex-République Yougoslave de Macédoine'),
(227, 818, 'EG', 'EGY', 'Egypt', 'Égypte'),
(228, 826, 'GB', 'GBR', 'United Kingdom', 'Royaume-Uni'),
(229, 833, 'IM', 'IMN', 'Isle of Man', 'Île de Man'),
(230, 834, 'TZ', 'TZA', 'United Republic Of Tanzania', 'République-Unie de Tanzanie'),
(231, 840, 'US', 'USA', 'United States', 'États-Unis'),
(232, 850, 'VI', 'VIR', 'U.S. Virgin Islands', 'Îles Vierges des États-Unis'),
(233, 854, 'BF', 'BFA', 'Burkina Faso', 'Burkina Faso'),
(234, 858, 'UY', 'URY', 'Uruguay', 'Uruguay'),
(235, 860, 'UZ', 'UZB', 'Uzbekistan', 'Ouzbékistan'),
(236, 862, 'VE', 'VEN', 'Venezuela', 'Venezuela'),
(237, 876, 'WF', 'WLF', 'Wallis and Futuna', 'Wallis et Futuna'),
(238, 882, 'WS', 'WSM', 'Samoa', 'Samoa'),
(239, 887, 'YE', 'YEM', 'Yemen', 'Yémen'),
(240, 891, 'CS', 'SCG', 'Serbia and Montenegro', 'Serbie-et-Monténégro'),
(241, 894, 'ZM', 'ZMB', 'Zambia', 'Zambie');




DELIMITER $$
--
-- Évènements
--
DROP EVENT IF EXISTS `update_passe`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_passe` ON SCHEDULE EVERY 1 DAY STARTS '2024-03-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
  UPDATE hospitalisation
  SET passe = 1
  WHERE date < CURRENT_DATE;
END$$

DELIMITER ;
COMMIT;

SET GLOBAL event_scheduler="ON" 
