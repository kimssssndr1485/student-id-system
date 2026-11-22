CREATE TABLE courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO courses (name) VALUES
('BS in Information Systems'), ('BS in Education'), ('BS in Business Administration');

ALTER TABLE students ADD course_id INT NULL AFTER date_of_birth;
UPDATE students s JOIN courses c ON c.name = s.course SET s.course_id = c.id;
ALTER TABLE students MODIFY course_id INT NOT NULL;

ALTER TABLE students
  ADD CONSTRAINT fk_students_course FOREIGN KEY (course_id)
  REFERENCES courses(id) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE students DROP COLUMN course;