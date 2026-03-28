-- =========================
-- INSERTION DES USERS
-- =========================
INSERT INTO users (name, email, password, role, created_at) VALUES
('Reza Khosravi', 'reza.khosravi@news.ir', 'hash_password_123', 'admin', CURRENT_TIMESTAMP),
('Fatima Tehrani', 'fatima.tehrani@news.ir', 'hash_password_456', 'editor', CURRENT_TIMESTAMP),
('Mohammad Abadi', 'mohammad.abadi@news.ir', 'hash_password_789', 'editor', CURRENT_TIMESTAMP),
('Leila Esfahan', 'leila.esfahan@news.ir', 'hash_password_101', 'editor', CURRENT_TIMESTAMP);

-- =========================
-- INSERTION DES CATEGORIES
-- =========================
INSERT INTO categories (name, created_at) VALUES
('Actualités Iran', CURRENT_TIMESTAMP),
('Politique Internationale', CURRENT_TIMESTAMP),
('Conflits Régionaux', CURRENT_TIMESTAMP),
('Économie et Sanctions', CURRENT_TIMESTAMP),
('Perspectives Géopolitiques', CURRENT_TIMESTAMP);

-- =========================
-- INSERTION DES POSTS
-- =========================
INSERT INTO posts (title, slug, content, image, status, author_id, created_at, updated_at) VALUES
('Situation Géopolitique en Iran : Enjeux et Implications', 'situation-geopolitique-iran-2026', 
 'Analyse approfondie des tensions croissantes en Iran et leur impact sur la région du Moyen-Orient. Découvrez les acteurs clés, les intérêts stratégiques et les perspectives pour la stabilité régionale.', 
 'https://example.com/images/iran-geopolitique.jpg', 'published', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Sanctions Économiques : Impact sur l''Économie Iranienne', 'sanctions-economiques-iran', 
 'Examen détaillé des sanctions internationales imposées à l''Iran et leurs conséquences sur l''économie locale, le commerce extérieur et la vie quotidienne des citoyens iraniens.', 
 'https://example.com/images/sanctions-iran.jpg', 'published', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Les Tensions Régionales : Facteurs de Déstabilisation', 'tensions-regionales-moyen-orient', 
 'Étude des conflits régionaux impliquant l''Iran, ses voisins et les puissances extérieures. Analyse des causes, des acteurs et des conséquences humanitaires.', 
 'https://example.com/images/tensions-region.jpg', 'published', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Droits Humains en Iran : Préoccupations Internationales', 'droits-humains-iran-2026', 
 'Rapport sur la situation des droits humains en Iran, incluant la liberté d''expression, les libertés civiles et les préoccupations de la communauté internationale.', 
 'https://example.com/images/droits-humains.jpg', 'draft', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

('Perspectives Diplomatiques : Négociations et Accords', 'perspectives-diplomatiques-iran', 
 'Analyse des efforts diplomatiques, des pourparlers internationaux et des possibilités de résolution des conflits. État des négociations et accords potentiels.', 
 'https://example.com/images/diplomatie.jpg', 'published', 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- =========================
-- INSERTION DES RELATIONS POST_CATEGORY (N-N)
-- =========================
INSERT INTO post_category (post_id, category_id) VALUES
(1, 2),  -- Situation géopolitique dans Politique Internationale
(1, 5),  -- Situation géopolitique dans Perspectives Géopolitiques
(2, 4),  -- Sanctions dans Économie et Sanctions
(2, 1),  -- Sanctions dans Actualités Iran
(3, 3),  -- Tensions régionales dans Conflits Régionaux
(3, 5),  -- Tensions régionales dans Perspectives Géopolitiques
(4, 1),  -- Droits humains dans Actualités Iran
(5, 2),  -- Diplomatie dans Politique Internationale
(5, 5);  -- Diplomatie dans Perspectives Géopolitiques

-- =========================
-- INSERTION DES TAGS
-- =========================
INSERT INTO tags (name) VALUES
('Iran'),
('Moyen-Orient'),
('Géopolitique'),
('Sanctions'),
('Diplomatie'),
('Conflit'),
('Économie'),
('Droits Humains'),
('Analyse');

-- =========================
-- INSERTION DES RELATIONS POST_TAGS (N-N)
-- =========================
INSERT INTO post_tags (post_id, tag_id) VALUES
(1, 1),  -- Post 1 : Tag Iran
(1, 2),  -- Post 1 : Tag Moyen-Orient
(1, 3),  -- Post 1 : Tag Géopolitique
(2, 1),  -- Post 2 : Tag Iran
(2, 4),  -- Post 2 : Tag Sanctions
(2, 7),  -- Post 2 : Tag Économie
(3, 1),  -- Post 3 : Tag Iran
(3, 2),  -- Post 3 : Tag Moyen-Orient
(3, 6),  -- Post 3 : Tag Conflit
(4, 1),  -- Post 4 : Tag Iran
(4, 8),  -- Post 4 : Tag Droits Humains
(5, 1),  -- Post 5 : Tag Iran
(5, 5),  -- Post 5 : Tag Diplomatie
(5, 3);  -- Post 5 : Tag Géopolitique

-- =========================
-- INSERTION DES COMMENTS
-- =========================
INSERT INTO comments (post_id, name, message, created_at) VALUES
(1, 'Hasan Rohani', 'Analyse très complète de la situation. Merci pour les explications claires sur les enjeux régionaux.', CURRENT_TIMESTAMP),
(1, 'Sophia Azadi', 'Les perspectives géopolitiques présentées sont bien documentées. Article de grande qualité.', CURRENT_TIMESTAMP),
(2, 'Kaveh Madani', 'Les impacts économiques des sanctions sont bien expliqués. Faut-il envisager d''autres mesures ?', CURRENT_TIMESTAMP),
(3, 'Yasmin Behrouz', 'Excellente analyse des tensions régionales. Contexte historique pertinent.', CURRENT_TIMESTAMP),
(3, 'Darius Kashi', 'Pourriez-vous approfondir sur le rôle de la Russie et de la Chine dans ces tensions ?', CURRENT_TIMESTAMP),
(5, 'Nassim Taleb', 'Les efforts diplomatiques sont importants pour la paix. Article inspirant et informatif.', CURRENT_TIMESTAMP);

