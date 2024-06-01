USE SDAIC 2;

# INSERT ROLES
INSERT INTO `tbl_roles` (`role_id`, `role_name`) VALUES (NULL, 'user'), (NULL, 'admin');


# INSERT USERS
INSERT INTO `tbl_users`
(`user_id`,
`username`,
`password`,
`first_name`,
`middle_name`,
`last_name`,
`contact`,
`email`,
`address`,
`birthday`,
`medical_history`,
`history_id`,
`userAppointmentHistory`)

VALUES

(NULL,
'user1',
'pass1',
'firstname1',
'middlename1',
'lastname1',
'contact1',
'email1',
'address1',
'2018-05-23',
'medicalhistory1',
NULL,
NULL),

(NULL,
'user2',
'pass2',
'firstname2',
'middlename2',
'lastname2',
'contact2',
'email2',
'address2',
'2019-05-22',
'history2',
NULL,
NULL),

(NULL,
'user3',
'pass3',
'firstname3',
'middlename3',
'lastname3',
'contact3',
'email3',
'address3',
'2024-05-06',
'history3',
NULL,
NULL),

(NULL,
'user4',
'pass4',
'firstname4',
'middlename4
''lastname4',
'contact4',
'email4',
'address4',
'2024-05-18',
'history4',
NULL,
NULL),

(NULL,
'user5',
'pass5',
'firstname5',
'middlename5',
'lastname5',
'contact5',
'email5',
'address5',
'2024-05-01',
'history5',
NULL,
NULL);

# INSERT DOCTORS
INSERT INTO `tbl_doctors`
(`doctor_id`,
`doctor_name`,
`avail_date`,
`avail_time`,
`contact`,
`email`,
`address`)

VALUES

(NULL,
'dr. strange',
'monday',
'11:00AM - 12:00PM',
'contact1',
'email1',
'address1'),

(NULL,
'dr. stranger',
'tuesday',
'2:00PM - 7:00PM',
'contact2',
'email2',
'address2'),

(NULL,
'dr. strangest',
'wednesday',
'8:00AM - 11:00AM',
'contact3',
'email3',
'address3');

# INSERT SERVICES
INSERT INTO `tbl_services`
(`service_id`,
`service_name`,
`description`,
`duration`,
`cost`,
`doctor_id`)

VALUES

(NULL,
'OB-GYNE',
'description1',
'2',
'1300',
'1'),

(NULL,
'CT-SCAN',
'description2',
'4',
'3400',
'2'),

(NULL,
'ECG',
'description3',
'6',
'5000',
'3'),

(NULL,
'ULTRASOUND',
'description4',
'3',
'1800',
'2');
