CREATE USER IF NOT EXISTS 'panicuser'@'%' IDENTIFIED BY 'panicbully2025!';
GRANT ALL PRIVILEGES ON panicbully.* TO 'panicuser'@'%';
FLUSH PRIVILEGES;
