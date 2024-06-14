-- Insert data into blood_bank table
INSERT INTO blood_donation.blood_bank (id, `group`, amount, phone, location) VALUES
(1, 'O+', '100', '123-456-7890', 'Location A'),
(2, 'A-', '50', '098-765-4321', 'Location B'),
(3, 'B+', '75', '456-789-0123', 'Location C'),
(4, 'AB-', '30', '321-654-9870', 'Location D'),
(5, 'A+', '60', '789-012-3456', 'Location E'),
(6, 'O-', '80', '111-222-3333', 'Location F'),
(7, 'B-', '40', '444-555-6666', 'Location G'),
(8, 'AB+', '25', '777-888-9999', 'Location H'),
(9, 'A-', '55', '123-123-1234', 'Location I'),
(10, 'O+', '95', '987-654-3210', 'Location J');

-- Insert data into donor table
INSERT INTO blood_donation.donor (id, name, `group`, location) VALUES
(1, 'John Doe', 'O+', 'City A'),
(2, 'Jane Smith', 'A-', 'City B'),
(3, 'Emily Davis', 'B+', 'City C'),
(4, 'Michael Brown', 'AB-', 'City D'),
(5, 'Sarah Johnson', 'A+', 'City E'),
(6, 'Chris Lee', 'O-', 'City F'),
(7, 'Patricia Kim', 'B-', 'City G'),
(8, 'Daniel Wang', 'AB+', 'City H'),
(9, 'Nancy Green', 'A-', 'City I'),
(10, 'Mark Taylor', 'O+', 'City J'),
(11, 'Laura White', 'O+', 'City K'),
(12, 'Kevin Green', 'A-', 'City L'),
(13, 'Daniel Black', 'B+', 'City M'),
(14, 'Rebecca Blue', 'AB-', 'City N'),
(15, 'Linda Yellow', 'A+', 'City O');

-- Insert data into hospital table
INSERT INTO blood_donation.hospital (id, phone, location) VALUES
(1, '111-222-3333', 'Hospital A'),
(2, '444-555-6666', 'Hospital B'),
(3, '777-888-9999', 'Hospital C'),
(4, '222-333-4444', 'Hospital D'),
(5, '555-666-7777', 'Hospital E');

-- Insert data into recipient table
INSERT INTO blood_donation.recipient (id, name, `group`, location, hospital_id1) VALUES
(1, 'Laura White', 'O+', 'City F', 1),
(2, 'Kevin Green', 'A-', 'City G', 2),
(3, 'Daniel Black', 'B+', 'City H', 3),
(4, 'Rebecca Blue', 'AB-', 'City I', 1),
(5, 'Linda Yellow', 'A+', 'City J', 2),
(6, 'James Bond', 'O-', 'City K', 3),
(7, 'Mary Jane', 'B-', 'City L', 4),
(8, 'Peter Parker', 'AB+', 'City M', 5),
(9, 'Bruce Wayne', 'A-', 'City N', 4),
(10, 'Clark Kent', 'O+', 'City O', 5);

-- Insert data into donation_event table
INSERT INTO blood_donation.donation_event (donor_id, bloodBank_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5);

-- Insert data into donor_has_recipient table
INSERT INTO blood_donation.donor_has_recipient (donor_id, recipient_id, recipient_hospital_id) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 1),
(5, 5, 2),
(6, 6, 3),
(7, 7, 4),
(8, 8, 5),
(9, 9, 4),
(10, 10, 5),
(11, 1, 1),
(12, 2, 2),
(13, 3, 3),
(14, 4, 1),
(15, 5, 2);

-- Insert data into order table
INSERT INTO blood_donation.`order` (hospital_id, bloodBank_id, id, amount, `date`, `group`) VALUES
(1, 1, 'ORD001', '20', '2023-03-01 10:00:00', 'O+'),
(2, 2, 'ORD002', '10', '2023-03-02 11:00:00', 'A-'),
(3, 3, 'ORD003', '15', '2023-03-03 12:00:00', 'B+'),
(4, 4, 'ORD004', '5', '2023-03-04 13:00:00', 'AB-'),
(5, 5, 'ORD005', '8', '2023-03-05 14:00:00', 'A+'),
(1, 6, 'ORD006', '25', '2023-03-06 15:00:00', 'O-'),
(2, 7, 'ORD007', '30', '2023-03-07 16:00:00', 'B-'),
(3, 8, 'ORD008', '10', '2023-03-08 17:00:00', 'AB+'),
(4, 9, 'ORD009', '20', '2023-03-09 18:00:00', 'A-'),
(5, 10, 'ORD010', '15', '2023-03-10 19:00:00', 'O+');