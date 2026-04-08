CREATE DATABASE IF NOT EXISTS divabuildcom
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE divabuildcom;

CREATE TABLE IF NOT EXISTS inquiries (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(120) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(150) NOT NULL,
    project_details TEXT NOT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_inquiries_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS jobs (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(120) NOT NULL,
    location VARCHAR(120) NOT NULL,
    experience VARCHAR(80) NOT NULL,
    employment_type VARCHAR(50) NOT NULL,
    summary TEXT DEFAULT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_jobs_active_sort (is_active, sort_order, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS applicants (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    target_position VARCHAR(120) NOT NULL,
    resume_original_name VARCHAR(255) NOT NULL,
    resume_stored_name VARCHAR(255) NOT NULL,
    resume_path VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_applicants_created_at (created_at),
    KEY idx_applicants_position (target_position)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE applicants
    ADD COLUMN IF NOT EXISTS status VARCHAR(30) NOT NULL DEFAULT 'pending' AFTER message,
    ADD COLUMN IF NOT EXISTS admin_notes TEXT DEFAULT NULL AFTER status,
    ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER created_at;

ALTER TABLE applicants
    ADD KEY idx_applicants_status (status);

INSERT INTO jobs (title, location, experience, employment_type, summary, is_active, sort_order)
SELECT 'Site Engineer', 'Suburban Mumbai', '1-3 Years', 'Full-Time', 'Drive site coordination, measurement checks, and execution quality across active Mumbai projects.', 1, 1
WHERE NOT EXISTS (SELECT 1 FROM jobs LIMIT 1);

INSERT INTO jobs (title, location, experience, employment_type, summary, is_active, sort_order)
SELECT 'Project Manager', 'Mumbai', '3-5 Years', 'Full-Time', 'Own project planning, reporting, contractor alignment, and milestone delivery for premium builds.', 1, 2
WHERE (SELECT COUNT(*) FROM jobs) = 1;

INSERT INTO jobs (title, location, experience, employment_type, summary, is_active, sort_order)
SELECT 'Interior Designer', 'Mumbai', '1-3 Years', 'Full-Time', 'Translate client goals into refined interior concepts with practical coordination for site execution.', 1, 3
WHERE (SELECT COUNT(*) FROM jobs) = 2;

INSERT INTO jobs (title, location, experience, employment_type, summary, is_active, sort_order)
SELECT 'Electrical Technician', 'Suburban Mumbai', '1-2 Years', 'Full-Time', 'Support safe and reliable electrical installation work with disciplined on-site execution standards.', 1, 4
WHERE (SELECT COUNT(*) FROM jobs) = 3;
