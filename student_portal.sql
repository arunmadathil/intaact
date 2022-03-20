CREATE TABLE students(
	id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	dob DATE NULL,
	contact_no INT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;

CREATE TABLE courses(
	id INT AUTO_INCREMENT PRIMARY KEY,
	course_name VARCHAR(255) NOT NULL,
	course_details TEXT NULL,	
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;

CREATE TABLE course_subscribe(
	student_id INT NOT NULL,
	course_id INT NOT NULL	
) ENGINE=INNODB;


ALTER TABLE course_subscribe
ADD CONSTRAINT FK_course_student_subscriptions
FOREIGN KEY (course_id) REFERENCES courses(id);

ALTER TABLE course_subscribe
ADD CONSTRAINT FK_student_course_subscriptions
FOREIGN KEY (student_id) REFERENCES students(id);