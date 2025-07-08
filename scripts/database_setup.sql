-- Create database
CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

-- Create contacts table for form submissions
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255),
    technologies JSON,
    live_url VARCHAR(255),
    github_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample projects
INSERT INTO projects (title, description, image_url, technologies, live_url, github_url) VALUES
('E-Commerce Platform', 'A full-stack e-commerce solution built with PHP, featuring user authentication, payment integration, and admin dashboard.', 'assets/images/project1.jpg', '["PHP", "MySQL", "JavaScript", "Bootstrap"]', '#', '#'),
('Task Management App', 'A collaborative task management application with real-time updates, drag-and-drop functionality, and team collaboration features.', 'assets/images/project2.jpg', '["PHP", "MySQL", "jQuery", "AJAX"]', '#', '#'),
('Weather Dashboard', 'A responsive weather dashboard that provides detailed weather information with beautiful visualizations and forecasts.', 'assets/images/project3.jpg', '["JavaScript", "PHP", "Weather API", "Chart.js"]', '#', '#');

-- Create skills table
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL
);

-- Insert skills
INSERT INTO skills (name, category) VALUES
('PHP', 'Backend'),
('MySQL', 'Database'),
('JavaScript', 'Frontend'),
('HTML5', 'Frontend'),
('CSS3', 'Frontend'),
('Bootstrap', 'Frontend'),
('jQuery', 'Frontend'),
('AJAX', 'Frontend'),
('Git', 'Tools'),
('Apache', 'Server'),
('Photoshop', 'Design'),
('Responsive Design', 'Frontend');
