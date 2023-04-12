USE database; 

CREATE TABLE user (
  id INT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  creation_date DATE NOT NULL,
  permission_type VARCHAR(10) NOT NULL
);

CREATE TABLE animal (
  id INT PRIMARY KEY,
  number_1 INT NOT NULL,
  number_2 INT NOT NULL,
  number_3 INT NOT NULL,
  number_4 INT NOT NULL
);

CREATE TABLE contest (
  id INT PRIMARY KEY,
  start_date DATE NOT NULL,
  end_date DATE,
  modifier DECIMAL(5,2) NOT NULL,
  status VARCHAR(10) NOT NULL
);

CREATE TABLE bet (
  id INT PRIMARY KEY,	
  user_id INT NOT NULL,
  animal_id INT NOT NULL,
  contest_id INT NOT NULL,
  value DECIMAL(10,2) NOT NULL,
  bet_date DATE NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (animal_id) REFERENCES animal(id),
  FOREIGN KEY (contest_id) REFERENCES contest(id)
);

CREATE TABLE result (
  id INT PRIMARY KEY,
  contest_id INT NOT NULL,
  animal_id INT NOT NULL,
  result_date DATE NOT NULL,
  FOREIGN KEY (contest_id) REFERENCES contest(id),
  FOREIGN KEY (animal_id) REFERENCES animal(id)
);