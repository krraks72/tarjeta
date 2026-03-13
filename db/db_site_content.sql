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
('index', 'hero_subtitle', 'Nos Casamos'),
('index', 'hero_title', 'Diana & Iván'),
('index', 'hero_description', 'Con la bendición de Dios y nuestras familias.'),
('index', 'hero_image', 'assets/media/banner/banner-img.png'),
('index', 'about_heading_small', 'NOSOTROS'),
('index', 'about_heading_large', 'NUESTRA HISTORIA'),
('index', 'couple_names', 'Diana & Iván'),
('index', 'about_description', 'Somos una historia escrita por Dios.'),
('index', 'story_heading_small', 'NUESTRA'),
('index', 'story_heading_large', 'HISTORIA'),
('index', 'rsvp_heading', '¿Asistirás?'),
('index', 'rsvp_description', 'Por favor confirmar antes del 05 de noviembre de 2024'),
('index', 'events_heading_small', 'Nuestra Boda'),
('index', 'events_heading_large', 'Cuándo y Dónde'),
('index', 'maps_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39035.51970363855!2d-74.4371786885208!3d4.292208867802529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f1cf13b251dbf%3A0x5f6988aec97595c8!2sVilla%20Isa!5e0!3m2!1ses-419!2sco!4v1725992051620!5m2!1ses-419!2sco'),
('index', 'gallery_total_images', '32'),
('index', 'gallery_image_pattern', 'assets/media/gallery/fotos/{n}.jpeg'),
('index', 'footer_text', 'Thank You')
ON DUPLICATE KEY UPDATE content_value = VALUES(content_value);
