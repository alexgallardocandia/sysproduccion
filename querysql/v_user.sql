CREATE OR REPLACE VIEW v_user AS 
 SELECT u.id,
    u.name,
    u.email,
    CONCAT(p.nombres, ' ', p.apellidos) AS persona,
    u.status
   FROM users u
     JOIN personas p ON u.persona_id = p.id;