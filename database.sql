-- База данных для интернет-магазина
CREATE DATABASE IF NOT EXISTS web_rk2_course2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE web_rk2_course2;

-- Таблица пользователей
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Таблица категорий продуктов
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Таблица продуктов
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    category_id INT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    short_description TEXT,
    full_description TEXT,
    stock_quantity INT DEFAULT 0,
    characteristics JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Таблица корзины/списка покупок
CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_cart_item (user_id, product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Таблица обратной связи
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Вставка категорий
INSERT INTO categories (name, description) VALUES
('Смартфоны', 'Современные смартфоны различных производителей'),
('Ноутбуки', 'Ноутбуки для работы и игр'),
('Наушники', 'Беспроводные и проводные наушники'),
('Аксессуары', 'Различные аксессуары для техники');

-- Вставка тестовых продуктов
INSERT INTO products (name, category_id, price, image, short_description, full_description, stock_quantity, characteristics) VALUES
('iPhone 15 Pro', 1, 89990.00, 'https://via.placeholder.com/800x600/2563eb/ffffff?text=iPhone+15+Pro', 'Новейший смартфон от Apple с процессором A17 Pro', 'iPhone 15 Pro - это флагманский смартфон с титановым корпусом, процессором A17 Pro, камерой 48 МП и дисплеем Super Retina XDR 6.1 дюйма. Поддержка 5G, Face ID, беспроводная зарядка.', 15, '{"Экран": "6.1 дюйма Super Retina XDR", "Процессор": "A17 Pro", "Память": "256 ГБ", "Камера": "48 МП + 12 МП + 12 МП", "Батарея": "3274 мАч", "ОС": "iOS 17"}'),
('Samsung Galaxy S24 Ultra', 1, 99990.00, 'https://via.placeholder.com/800x600/1e40af/ffffff?text=Galaxy+S24+Ultra', 'Флагман Samsung с S Pen и камерой 200 МП', 'Galaxy S24 Ultra оснащен дисплеем 6.8 дюйма Dynamic AMOLED 2X, процессором Snapdragon 8 Gen 3, камерой 200 МП, S Pen и батареей 5000 мАч. Поддержка 5G и беспроводной зарядки.', 12, '{"Экран": "6.8 дюйма Dynamic AMOLED 2X", "Процессор": "Snapdragon 8 Gen 3", "Память": "512 ГБ", "Камера": "200 МП + 50 МП + 12 МП + 10 МП", "Батарея": "5000 мАч", "ОС": "Android 14"}'),
('MacBook Pro 16"', 2, 249990.00, 'https://via.placeholder.com/800x600/3b82f6/ffffff?text=MacBook+Pro+16', 'Мощный ноутбук для профессионалов с чипом M3 Max', 'MacBook Pro 16 дюймов с чипом M3 Max, 36 ГБ памяти, 1 ТБ SSD, дисплеем Liquid Retina XDR и батареей до 22 часов работы. Идеален для профессиональной работы.', 8, '{"Экран": "16.2 дюйма Liquid Retina XDR", "Процессор": "Apple M3 Max", "Память": "36 ГБ", "Хранилище": "1 ТБ SSD", "Графика": "40‑core GPU", "Батарея": "До 22 часов"}'),
('Lenovo ThinkPad X1 Carbon', 2, 149990.00, 'https://via.placeholder.com/800x600/2563eb/ffffff?text=ThinkPad+X1', 'Бизнес-ноутбук премиум класса', 'ThinkPad X1 Carbon Gen 11 с процессором Intel Core i7, 16 ГБ RAM, 512 ГБ SSD, дисплеем 14 дюймов 2.8K и ультралегким корпусом из углеродного волокна.', 10, '{"Экран": "14 дюймов 2.8K OLED", "Процессор": "Intel Core i7-1355U", "Память": "16 ГБ", "Хранилище": "512 ГБ SSD", "Графика": "Intel Iris Xe", "Вес": "1.12 кг"}'),
('AirPods Pro 2', 3, 24990.00, 'https://via.placeholder.com/800x600/10b981/ffffff?text=AirPods+Pro+2', 'Беспроводные наушники с активным шумоподавлением', 'AirPods Pro 2 с чипом H2, улучшенным активным шумоподавлением, пространственным аудио, защитой от воды и пыли IPX4 и зарядкой через MagSafe.', 25, '{"Тип": "Беспроводные", "Шумоподавление": "Активное", "Батарея": "До 6 часов", "Кейс": "С беспроводной зарядкой", "Совместимость": "Apple и Android"}'),
('Sony WH-1000XM5', 3, 32990.00, 'https://via.placeholder.com/800x600/1e40af/ffffff?text=Sony+WH-1000XM5', 'Премиум наушники с лучшим шумоподавлением', 'Sony WH-1000XM5 - флагманские наушники с процессором V1, активным шумоподавлением, батареей до 30 часов и поддержкой LDAC для высококачественного звука.', 18, '{"Тип": "Накладные беспроводные", "Шумоподавление": "Активное V1", "Батарея": "До 30 часов", "Кодек": "LDAC, AAC, SBC", "Вес": "250 г"}'),
('Зарядное устройство MagSafe', 4, 3990.00, 'https://via.placeholder.com/800x600/f59e0b/ffffff?text=MagSafe+Charger', 'Магнитное зарядное устройство 15W', 'Оригинальное зарядное устройство Apple MagSafe мощностью 15W с магнитной фиксацией для iPhone 12 и новее.', 50, '{"Мощность": "15W", "Тип": "Беспроводное", "Совместимость": "iPhone 12 и новее", "Подключение": "Lightning"}'),
('Чехол для MacBook Pro', 4, 4990.00, 'https://via.placeholder.com/800x600/6b7280/ffffff?text=MacBook+Case', 'Защитный чехол из мягкого материала', 'Защитный чехол для MacBook Pro 16 дюймов из высококачественного материала с карманами для аксессуаров.', 30, '{"Материал": "Полиэстер", "Совместимость": "MacBook Pro 16", "Цвет": "Черный", "Защита": "От царапин и ударов"}');

-- Тестовый пользователь будет создан через setup.php
-- Или создайте вручную с помощью: password_hash('admin123', PASSWORD_DEFAULT)

