
CREATE database sistemacidadao;
use sistemacidadao;
CREATE TABLE citizens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  nis VARCHAR(15) NOT NULL UNIQUE
);
