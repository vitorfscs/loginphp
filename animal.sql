CREATE TABLE usuarios (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    idade DATE NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE Animais (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    idade DATE NOT NULL,
    animal VARCHAR(255) NOT NULL
);

CREATE TABLE MeusAmigos (
    dono_id INT NOT NULL,
    animal_id INT NOT NULL,
    PRIMARY KEY (dono_id, animal_id),
    CONSTRAINT FK_Dono FOREIGN KEY (dono_id) REFERENCES usuarios(id),
    CONSTRAINT FK_Animal FOREIGN KEY (animal_id) REFERENCES Animais(id)
);
