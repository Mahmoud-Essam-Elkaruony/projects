-- This project for practice
-- This project work with ORACLE not the mySQL 
-- Because of that some command line will not work on the mySQL engine
-- Notice: There is course it is [PL_SQL]

-- depart1 = Name of foreign key  
CREATE TABLE `depart_cost`
(
    `cost_numbers` int(5) NOT NULL,
    `depart_name` varchar(5) NOT NULL,
    `doctor` varchar(20) NOT NULL,
    `cost` int(5) NOT NULL
    CONSTRAINT depart1 PRIMARY KEY(depart_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `student_depart`
(
    `depart_student` varchar(20) NOT NULL,
    `id` int(5) NOT NULL,
    `name` varchar(20) NOT NULL,
    `age` int(5) NOT NULL,
    `per` int(5) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add constraint on the column `id`
ALTER TABLE `student_depart` ADD CONSTRAINT depart2 PRIMARY KEY(id);

-- Make references with tables 
ALTER TABLE `student_depart` ADD CONSTRAINT depart3 FOREIGN KEY(depart)
REFERENCES `depart_cost`(depart_name)

-- If you write the name of table wrong write the code
ALTER TABLE `student_de` RENAME TO `student_depart`;

-- If you write the of column wrong write this code 
ALTER TABLE `student_depart` RENAME COLUMN `name` TO `name_students`;

-- Add column 
ALTER TABLE `student_depart` ADD COLUMN `last_name`;

-- Update value 
UPDATE `student_depart` SET `per`=65 WHERE `id`=5;

-- Select all or solumn 
SELECT * FROM `student_depart`;
SELECT * FROM `depart_cost` ORDER BY `cost_numbers`;
-- You can also add method like sum() to the select
SELECT sum(cost) FROM `depart_cost`;

-- Join with to table 
SELECT * FROM `depart_cost` JOIN `student_depart` ON `depart`=`depart_name`;