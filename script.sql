-- Create Sacco table first
CREATE TABLE Sacco (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(255) NOT NULL
);

-- Create User table with foreign key reference to Sacco
CREATE TABLE User (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      first_name VARCHAR(255) NOT NULL,
                      last_name VARCHAR(255) NOT NULL,
                      email VARCHAR(120) UNIQUE NOT NULL,
                      password VARCHAR(60) NOT NULL,
                      role VARCHAR(20) NOT NULL,
                      date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
                      token VARCHAR(100) UNIQUE,
                      is_verified BOOLEAN DEFAULT FALSE,
                      driver_license VARCHAR(20),
                      sacco_role VARCHAR(20),
                      sacco_id INT,
                      FOREIGN KEY (sacco_id) REFERENCES Sacco(id)
);

-- Continue creating other tables
CREATE TABLE Vehicle (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         make VARCHAR(50) NOT NULL,
                         model VARCHAR(50) NOT NULL,
                         registration_plate VARCHAR(20) UNIQUE NOT NULL,
                         capacity INT NOT NULL,
                         sacco_id INT NOT NULL,
                         driver_id INT,
                         FOREIGN KEY (sacco_id) REFERENCES Sacco(id),
                         FOREIGN KEY (driver_id) REFERENCES User(id)
);

CREATE TABLE TravelSchedule (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                departure_location VARCHAR(255) NOT NULL,
                                destination VARCHAR(255) NOT NULL,
                                departure_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                price FLOAT NOT NULL,
                                vehicle_id INT NOT NULL,
                                FOREIGN KEY (vehicle_id) REFERENCES Vehicle(id)
);

CREATE TABLE Ticket (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        ticket_number VARCHAR(20) UNIQUE NOT NULL,
                        user_id INT NOT NULL,
                        travel_schedule_id INT NOT NULL,
                        booking_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        seat_number VARCHAR(20),
                        price FLOAT,
                        FOREIGN KEY (user_id) REFERENCES User(id),
                        FOREIGN KEY (travel_schedule_id) REFERENCES TravelSchedule(id)
);
