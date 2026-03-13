CREATE TABLE IF NOT EXISTS site_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_name VARCHAR(100) NOT NULL,
    content_key VARCHAR(150) NOT NULL,
    content_value TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_page_key (page_name, content_key)
);

INSERT INTO site_content (page_name, content_key, content_value) VALUES
('index', 'meta_title', 'BENDECIDO'),
('index', 'logo_image', 'assets/media/logo.png'),
('index', 'hero_subtitle', 'Nuestra Boda'),
('index', 'hero_title', '"Dios,\n Tú y Yo,\nPor Siempre"'),
('index', 'hero_description', 'Con la bendición de Dios y nuestras familias.'),
('index', 'hero_date_label', 'El día esperado'),
('index', 'hero_date_value', 'Dic 14, 2024'),
('index', 'about_groom_image', 'assets/media/about/grrom.png'),
('index', 'about_bride_image', 'assets/media/about/bride.png'),
('index', 'groom_name', 'Iván Dario'),
('index', 'groom_description', 'Nació en Bogotá el 28/09/1983, con un corazón cariñoso con sus seres amados'),
('index', 'bride_name', 'Diana Milena'),
('index', 'bride_description', 'Nació en Bogotá el 10/11/1990, alegre y siempre dispuesta a ayudar a los demás'),
('index', 'rsvp_heading', '¿Asistirás?'),
('index', 'rsvp_description', 'Por favor confirmar antes del 05 de noviembre de 2024'),
('index', 'gallery_total_images', '0'),
('index', 'story_items', '[{"date":"Mayo, 2013","title":"¿Cómo nos conocimos?","description":"Nuestros caminos se cruzaron al trabajar juntos en el hospital de Gachetá.","image":"assets/media/story/s-1.png"},{"date":"Nov, 2017","title":"¡No era el momento!","description":"Dios nos puso a prueba y moldeó nuestro corazón por separado.","image":"assets/media/story/s-2.png"}]'),
('index', 'events_items', '[{"title":"Ceremonia","date":"Sábado 14 de dic, 2024","time":"11:00 AM","place":"Finca Villa Isa, Chinauta","address":"km 65 vía a melgar"}]'),
('index', 'footer_text', 'Thank You'),

('invitation', 'meta_title', 'Invitación de boda'),
('invitation', 'couple_names', 'Iván y Diana'),
('invitation', 'line_1', 'Tenemos el placer de invitarle(s)'),
('invitation', 'line_2', 'A la celebración de nuestra Boda'),
('invitation', 'event_date', 'Dic, 14 de 2024'),
('invitation', 'event_address', 'Finca Villa Isa, Chinauta, km 65 vía a melgar'),

('regalos', 'meta_title', 'Regalos'),
('regalos', 'title', 'Selección de obsequios'),
('regalos', 'delivery_address', 'Dirección de entrega: AK 50 # 39A - 38 SUR'),
('regalos', 'gift_items', '[{"id":"1","name":"Licuadora"},{"id":"2","name":"Juego de vajilla"}]')
ON DUPLICATE KEY UPDATE content_value = VALUES(content_value);
