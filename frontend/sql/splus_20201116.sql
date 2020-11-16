-- 
-- DROP VIEW IF EXISTS `vw_clientes`;
-- CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_clientes` AS SELECT
-- 	cln.id,
-- 	cln.nombre,
-- 	cln.calle,
-- 	cln.num_ext,
-- 	cln.num_int,
-- 	cln.entre_calles,
-- 	cln.colonia,
-- 	cestados.nombre AS estado,
-- 	cmunicipio.nombre AS municipio,
-- 	cln.codigo_postal,
-- 	cln.email,
-- 	cestatus.nombre AS estatus,
-- 	cln.celular,
-- 	cpublicidad.nombre AS publicidad,
-- 	rct.tel,
-- 	rct.cel	
-- 	
-- FROM
-- 	clientes cln
-- 	LEFT JOIN c_publicidad cpublicidad ON cln.publicidad_id = cpublicidad.id
-- 	LEFT JOIN c_estados cestados ON cln.estado_id = cestados.id
-- 	LEFT JOIN cat_municipio cmunicipio ON cln.municipio_id = cmunicipio.id
-- 	LEFT JOIN c_estatus_general cestatus ON cln.estatus_general_id = cestatus.id 
-- 	LEFT JOIN r_cliente_tel rct ON rct.id in (SELECT max(id) as id from r_cliente_tel WHERE cliente_id = cln.id) ;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'MANUEL', 'condesa', '1989', '340', 'mANZA Y DURAZNO', '0', NULL, NULL, 44900, '', NULL, NULL, NULL, '99', '98');
INSERT INTO `usuarios` VALUES (14, 'MANUEL', 'FRESNO', '1989', '340', 'mANZA', '0', NULL, NULL, 44900, '', NULL, NULL, NULL, '100', '101');
INSERT INTO `usuarios` VALUES (15, 'Jose', 'FRESNO', '1989', '340', 'mANZA Y DURAZNO', '0', NULL, NULL, 44900, '', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------


-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Matias', 'gdl', '38-4103-508', '2000-01-04', 'b562fa8651314c23802c37fbb1c3ac88.jpg', 'Administrador', 'Comisión', 1200.00, NULL, 'rikmatt23@gmail.com', 'BAJA CALIFORNIA', '1', NULL, NULL);
INSERT INTO `usuarios` VALUES (5, 'Erick', 'gdl', '', '1993-04-23', '', 'Administrador', NULL, 100.00, NULL, 'rikmatt23@gmail.com', NULL, '1', NULL, NULL);
INSERT INTO `usuarios` VALUES (7, 'Jose', 'Guadalajara', '', '0000-00-00', '', 'Administrador', 'Sueldo Fijo', 0.00, NULL, '', 'AGUASCALIENTES', '1', NULL, NULL);
INSERT INTO `usuarios` VALUES (8, 'Raul', 'GDL', '', '0000-00-00', '80592b9914447a686b0b69f87b0972f2.jpeg', 'Técnico', 'Sueldo Fijo', 500.00, NULL, 'rikmatt23@gmail.com', 'CHIAPAS', '1', 5000.00, 15);
INSERT INTO `usuarios` VALUES (9, 'monica', '', '', '0000-00-00', '77d2f18ac6549e8a9d3c28d31951eb52.jpeg', 'Técnico', NULL, 0.00, NULL, '', NULL, '1', 7000.00, 10);

-- ----------------------------
-- View structure for vw_equipos

-- ----------------------------
-- View structure for vw_horarios
-- ----------------------------


-- ----------------------------
-- View structure for vw_marca
-- ----------------------------

-- ----------------------------
-- View structure for vw_perfiles
-- ----------------------------
DROP VIEW IF EXISTS `vw_perfiles`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_perfiles` AS SELECT
	id,
	nombre,
	CASE 
	WHEN activo = 1 THEN 'Activo'
	ELSE 'Inactivo'
	END as activo
FROM
	c_perfiles ;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Administrador', 'Activo');
INSERT INTO `usuarios` VALUES (2, 'Secretaria', 'Activo');
INSERT INTO `usuarios` VALUES (4, 'Técnico', 'Activo');

-- ----------------------------
-- View structure for vw_polizas
-- ----------------------------
DROP VIEW IF EXISTS `vw_polizas`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_polizas` AS SELECT
	pol.id,
	cln.nombre AS cliente_nom,
	pol.costo,
	pol.fecha_inicio,
	pol.fecha_fin,
	emp.nombre AS emp_nom,
	cestatus.nombre AS statu
FROM
	polizas pol
	LEFT JOIN clientes cln ON pol.cliente_id = cln.id
	LEFT JOIN empleados emp ON pol.empleado_id = emp.id
	LEFT JOIN c_estatus_general cestatus ON pol.estatus_general_id = cestatus.id ;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Jose', 800, '2020-11-01', '2020-11-04', 'Matias', NULL);
INSERT INTO `usuarios` VALUES (2, 'MANUEL', 0, '0000-00-00', '0000-00-00', 'Matias', NULL);

-- ----------------------------
-- View structure for vw_publicidad
-- ----------------------------
DROP VIEW IF EXISTS `vw_publicidad`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_publicidad` AS SELECT
	id,
	nombre,
	CASE 
	WHEN activo = 1 THEN 'Activo'
	ELSE 'Inactivo'
	END as Estatus
FROM
	c_publicidad ;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'new', 'Activo');

-- ----------------------------
-- View structure for vw_sueldos
-- ----------------------------
DROP VIEW IF EXISTS `vw_sueldos`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_sueldos` AS SELECT
	id,
	nombre,
	CASE 
	WHEN activo = 1 THEN 'Activo'
	ELSE 'Inactivo'
	END as Estatus
FROM
	c_sueldos ;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Sueldo Fijo', 'Activo');
INSERT INTO `usuarios` VALUES (2, 'Comisión', 'Activo');

-- ----------------------------
-- View structure for vw_usuarios
-- ----------------------------
DROP VIEW IF EXISTS `vw_usuarios`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_usuarios` AS SELECT
	emp.id,
	emp.nombre,
	emp.direccion,
	emp.tel,
	emp.fecha_nacimiento,
	emp.foto_emp,
	cper.nombre AS perfil,
	csuel.nombre AS tipo_sueldo,
	emp.monto_sueldo,
	cestatus.nombre AS estatus,
	emp.correo,
	cestados.nombre AS estado,
	urs.id AS usuario_id,
	urs.usuario,
	urs.contraseña,
	urs.hora_entrada,
	urs.hora_salida,
	urs.estatus_general_id
  
FROM
	empleados emp
	LEFT JOIN c_perfiles cper ON emp.perfil_id = cper.id
	LEFT JOIN c_sueldos csuel ON emp.tipo_sueldo_id = csuel.id
	LEFT JOIN c_estatus_general cestatus ON emp.estatus_general_id = cestatus.id 
	LEFT JOIN c_estados cestados ON emp.estado_id = cestados.id
  JOIN usuarios urs ON urs.empleado_id = emp.id ;

-- ----------------------------
-- Records of usuarios
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
