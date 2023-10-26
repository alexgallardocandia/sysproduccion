CREATE OR REPLACE VIEW v_personas AS 
 SELECT p.id,
    CONCAT(p.nombres,' ', p.apellidos) as fullname,
    p.ci,
    p.direccion,
    p.telefono,
    p.email,
    p.fecha_nacimiento,
    ec.descripcion as estado_civil,
    ca.descripcion as cargo,
    s.descripcion as sucursal,
    ciu.descripcion as ciudad,
    p.created_at,
    p.updated_at
   FROM personas p 
     JOIN estado_civiles ec  ON p.civil_id = ec.id
     JOIN cargos ca ON p.cargo_id = ca.id
     JOIN sucursales s ON p.sucursal_id = s.id
     JOIN ciudades ciu ON p.ciudad_id = ciu.id