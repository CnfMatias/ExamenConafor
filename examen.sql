/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : examen

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 27/01/2021 13:55:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for c_estado_empleado
-- ----------------------------
DROP TABLE IF EXISTS `c_estado_empleado`;
CREATE TABLE `c_estado_empleado`  (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `activo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_estado_empleado
-- ----------------------------
INSERT INTO `c_estado_empleado` VALUES (1, 'Todo', '1');
INSERT INTO `c_estado_empleado` VALUES (2, 'Renovado', '1');
INSERT INTO `c_estado_empleado` VALUES (3, 'Temporal', '1');

-- ----------------------------
-- Table structure for c_sub_unidad
-- ----------------------------
DROP TABLE IF EXISTS `c_sub_unidad`;
CREATE TABLE `c_sub_unidad`  (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `activo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_sub_unidad
-- ----------------------------
INSERT INTO `c_sub_unidad` VALUES (1, 'Todo', '1');
INSERT INTO `c_sub_unidad` VALUES (2, 'Desarrollo', '1');
INSERT INTO `c_sub_unidad` VALUES (3, 'Administrativo', '1');

-- ----------------------------
-- Table structure for c_titulo_trabajo
-- ----------------------------
DROP TABLE IF EXISTS `c_titulo_trabajo`;
CREATE TABLE `c_titulo_trabajo`  (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `activo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of c_titulo_trabajo
-- ----------------------------
INSERT INTO `c_titulo_trabajo` VALUES (1, 'Todo', '1');
INSERT INTO `c_titulo_trabajo` VALUES (2, 'Ingeniero', '1');
INSERT INTO `c_titulo_trabajo` VALUES (3, 'Licenciado', '1');

-- ----------------------------
-- Table structure for empleados
-- ----------------------------
DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `apellido` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado_empleo_id` int(20) NULL DEFAULT NULL,
  `nombre_supervisor` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `titulo_trabajo_id` int(20) NULL DEFAULT NULL,
  `sub_unidad_id` int(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empleados
-- ----------------------------
INSERT INTO `empleados` VALUES (1, 'Ricardo', 'Alvarado Montemayor', 2, 'Raul', 2, 2);
INSERT INTO `empleados` VALUES (2, 'Matias', 'Montemayor', 1, 'e', 1, 1);
INSERT INTO `empleados` VALUES (4, 'Cristian', 'Aceves', 2, 'Jose', 1, 1);
INSERT INTO `empleados` VALUES (5, 'Victor', 'Robles Rodriguez', 2, 'Lorenza de la cruz', 3, 2);

-- ----------------------------
-- View structure for vw_empleados
-- ----------------------------
DROP VIEW IF EXISTS `vw_empleados`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_empleados` AS SELECT
	`emp`.`id` AS `id`,
	`emp`.`nombre` AS `nombre`,
	`emp`.`apellido` AS `apellido`,
	 emp.nombre_supervisor AS nombre_supervisor,
	`cemp`.`nombre` AS `estado_empleo_id`,
	`ctitulo`.`nombre` AS `titulo_trabajo_id`,
	`csub`.`nombre` AS `sub_unidad_id`

FROM
					empleados emp
					LEFT JOIN c_estado_empleado cemp ON emp.estado_empleo_id = cemp.id
				LEFT JOIN c_titulo_trabajo ctitulo ON emp.titulo_trabajo_id = ctitulo.id
			LEFT JOIN c_sub_unidad csub ON  emp.sub_unidad_id = csub.id 
ORDER BY
	`emp`.`id` ;

-- ----------------------------
-- Records of empleados
-- ----------------------------
INSERT INTO `empleados` VALUES (1, 'Ricardo', 'Alvarado Montemayor', 'Raul', 'Renovado', 'Ingeniero', 'Desarrollo');
INSERT INTO `empleados` VALUES (2, 'Matias', 'Montemayor', 'e', 'Todo', 'Todo', 'Todo');
INSERT INTO `empleados` VALUES (4, 'Cristian', 'Aceves', 'Jose', 'Renovado', 'Todo', 'Todo');
INSERT INTO `empleados` VALUES (5, 'Victor', 'Robles Rodriguez', 'Lorenza de la cruz', 'Renovado', 'Licenciado', 'Desarrollo');

-- ----------------------------
-- View structure for vw_estado_empleado
-- ----------------------------
DROP VIEW IF EXISTS `vw_estado_empleado`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_estado_empleado` AS SELECT
	`c_estado_empleado`.`id` AS `id`,
	`c_estado_empleado`.`nombre` AS `nombre`,
CASE
		
		WHEN `c_estado_empleado`.`activo` = 1 THEN
		'Activo' ELSE 'Inactivo' 
	END AS `activo` 
FROM
	`c_estado_empleado` ;

-- ----------------------------
-- Records of empleados
-- ----------------------------
INSERT INTO `empleados` VALUES (1, 'Todo', 'Activo');
INSERT INTO `empleados` VALUES (2, 'Renovado', 'Activo');
INSERT INTO `empleados` VALUES (3, 'Temporal', 'Activo');

-- ----------------------------
-- View structure for vw_sub_unidad
-- ----------------------------
DROP VIEW IF EXISTS `vw_sub_unidad`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_sub_unidad` AS SELECT
	`c_sub_unidad`.`id` AS `id`,
	`c_sub_unidad`.`nombre` AS `nombre`,
CASE
		
		WHEN `c_sub_unidad`.`activo` = 1 THEN
		'Activo' ELSE 'Inactivo' 
	END AS `activo` 
FROM
	`c_sub_unidad` ;

-- ----------------------------
-- Records of empleados
-- ----------------------------
INSERT INTO `empleados` VALUES (1, 'Todo', 'Activo');
INSERT INTO `empleados` VALUES (2, 'Desarrollo', 'Activo');
INSERT INTO `empleados` VALUES (3, 'Administrativo', 'Activo');

-- ----------------------------
-- View structure for vw_titulo_trabajo
-- ----------------------------
DROP VIEW IF EXISTS `vw_titulo_trabajo`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_titulo_trabajo` AS SELECT
	`c_titulo_trabajo`.`id` AS `id`,
	`c_titulo_trabajo`.`nombre` AS `nombre`,
CASE
		
		WHEN `c_titulo_trabajo`.`activo` = 1 THEN
		'Activo' ELSE 'Inactivo' 
	END AS `activo` 
FROM
	`c_titulo_trabajo` ;

-- ----------------------------
-- Records of empleados
-- ----------------------------
INSERT INTO `empleados` VALUES (1, 'Todo', 'Activo');
INSERT INTO `empleados` VALUES (2, 'Ingeniero', 'Activo');
INSERT INTO `empleados` VALUES (3, 'Licenciado', 'Activo');

SET FOREIGN_KEY_CHECKS = 1;
