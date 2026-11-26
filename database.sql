CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT IGNORE INTO courses (name) VALUES
    ('BS in Information Systems'),
    ('BS in Education'),
    ('BS in Business Administration');

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_number VARCHAR(10) NOT NULL UNIQUE,
    firstname VARCHAR(100) NOT NULL,
    middle_initial VARCHAR(5) NULL DEFAULT '',
    lastname VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    course_id INT NOT NULL,
    year_level VARCHAR(20) NOT NULL,
    id_status VARCHAR(20) NOT NULL DEFAULT 'Unclaimed',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_students_course
        FOREIGN KEY (course_id) REFERENCES courses(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;