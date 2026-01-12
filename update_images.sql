-- Скрипт для обновления изображений на placeholder URL
-- Выполните этот SQL после импорта основной базы данных

UPDATE products SET image = 'https://via.placeholder.com/800x600/2563eb/ffffff?text=iPhone+15+Pro' WHERE name = 'iPhone 15 Pro';
UPDATE products SET image = 'https://via.placeholder.com/800x600/1e40af/ffffff?text=Galaxy+S24+Ultra' WHERE name = 'Samsung Galaxy S24 Ultra';
UPDATE products SET image = 'https://via.placeholder.com/800x600/3b82f6/ffffff?text=MacBook+Pro+16' WHERE name = 'MacBook Pro 16"';
UPDATE products SET image = 'https://via.placeholder.com/800x600/2563eb/ffffff?text=ThinkPad+X1' WHERE name = 'Lenovo ThinkPad X1 Carbon';
UPDATE products SET image = 'https://via.placeholder.com/800x600/10b981/ffffff?text=AirPods+Pro+2' WHERE name = 'AirPods Pro 2';
UPDATE products SET image = 'https://via.placeholder.com/800x600/1e40af/ffffff?text=Sony+WH-1000XM5' WHERE name = 'Sony WH-1000XM5';
UPDATE products SET image = 'https://via.placeholder.com/800x600/f59e0b/ffffff?text=MagSafe+Charger' WHERE name = 'Зарядное устройство MagSafe';
UPDATE products SET image = 'https://via.placeholder.com/800x600/6b7280/ffffff?text=MacBook+Case' WHERE name = 'Чехол для MacBook Pro';

