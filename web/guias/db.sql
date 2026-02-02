/* Cracion de tablas*/
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(3) NOT NULL DEFAULT 10 COMMENT '0=Inactivo, 1=Activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `telefono` (`telefono`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `dato` (
  `iddato` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` int(100) NOT NULL,
  `idtipo` int(11) NOT NULL,
  PRIMARY KEY (`iddato`),
  UNIQUE KEY `uc_descripcion_idtipo` (`descripcion`,`idtipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `dato_tipo` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `constante` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtipo`),
  UNIQUE KEY `uc_descripcion` (`constante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE user_rol (
    idrol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(150) NULL,
    activo TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_usuario_rol (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idusuario INT NOT NULL,
    idrol INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY uk_usuario_rol (idusuario, idrol),

    CONSTRAINT fk_urol_usuario
        FOREIGN KEY (idusuario) REFERENCES user(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_urol_rol
        FOREIGN KEY (idrol) REFERENCES user_rol(idrol)
        ON DELETE CASCADE
);
