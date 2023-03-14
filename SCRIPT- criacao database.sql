# Se existir schema com nome , deleto:
drop database if exists coisasemprestadas;
# se não houver database  crio:
create database if not exists coisasemprestadas;
#aponto para o banco recém criado:
use coisasemprestadas;


# Crio a tabela usuário:
CREATE TABLE IF NOT EXISTS usuario(
id INT unsigned AUTO_INCREMENT not null,
nome VARCHAR(100) not null,
cpf char(14) not null,
logradouro varchar(255) not null,
cidade varchar(60) not null,
uf char(2) not null,
telefone varchar(15) not null,
email varchar(100) not null,
senha varchar(80) not null,
foto varchar(100),
tipo_usuario tinyint unsigned,
primary key (id)
);

# Crio a tabela coisas:
CREATE TABLE IF NOT EXISTS coisa(
id INT unsigned not null AUTO_INCREMENT,
usuario_id int unsigned not null,
nome VARCHAR(100) not null,
descricao text not null,
diasparaemprestar tinyint,
imagem varchar(255),
ativo boolean,
foreign key (usuario_id) REFERENCES usuario(id),
primary key (id)

);

# Crio a tabela de emprestimos
create table if not exists emprestimo(
id BIGINT not null AUTO_INCREMENT,
id_coisa int unsigned not null,
id_proprietario int unsigned not null,
id_locador int unsigned not null,
data_emprestimo datetime not null,
data_devolucao datetime not null,
foreign key (id_coisa) REFERENCES coisa(id),
foreign key (id_proprietario) REFERENCES usuario(id),
foreign key (id_locador) REFERENCES usuario(id),
primary key (id)
);

use coisasemprestadas;
 
 select * from usuario;
 


INSERT INTO usuario (nome, cpf, logradouro, cidade, uf, telefone, email, senha, foto, tipo_usuario) values 
('ALEXNDRE DOS SANTOS MENDES', '00011133322', 'RUA DAS FLORES, 123', 'CURITIBA', 'PR', '41984072247', 'admin@admin.com.br', '$2y$10$enRUMCvib5M9A58vOp2vvuiCM2NprwzbewN5ZxO1DJEKQt5ob8Sky', 'null', '1') ,

('LARISSA','12212212212','RUA DA LARISSA, 123', 'SAO PAULO', 'SP', '4185238523','larissa@uol.com.br','$2y$10$enRUMCvib5M9A58vOp2vvuiCM2NprwzbewN5ZxO1DJEKQt5ob8Sky', 'null', '2');


insert into coisasemprestadas.coisa( usuario_id, nome, descricao, diasparaemprestar, imagem, ativo ) value
	(1, 'Pente Quebrado', 'Pente para quem é careca', 30, 'pente.jpg', 1),
    (2, 'Cortador de grama', 'Cortador de grama elétrico 110v da marca ZZ1', 1, 'cortador.jpg', 1),
    (1, 'Aspirador de pó', 'Aspirador de pó a bateria da marca ZA', 1, 'aspirador.jpg', 1),
    (2, 'Kit pintura', 'Pincel, rolo, balde, e bandeja para pintura', 10, 'pintura.jpg', 1),
    (1, 'Esteira Sushi','Esteira e kit para fazer sushi',2,'esteira.jpg',1),
    (1, 'Karaoke', 'Karaoke velho ', 20, 'karaoke.jpg', 1);

