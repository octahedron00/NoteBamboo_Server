# NoteBamboo_Server

대나무노트 앱 서버 시스템. (현재 사용 중지됨)

LAMP(MariaDB) 기반으로 이루어져있었으며, 다음과 같은 구조를 가진다.

app.php 를 통해 POST 데이터를 주고받음, *그 외의 php는 첫 출시 당시, 기능 별로 만든 것.*

1.0.0(21.08.12 출시)

## DB architecture

DB 구조는 다음과 같다.

```
MariaDB [notebamboo]> show tables;
+----------------------+
| Tables_in_notebamboo |
+----------------------+
| base                 |
| list                 |
| note                 |
| share                |
| user                 |
| version              |
+----------------------+


MariaDB [notebamboo]> desc base;
+-------+--------------+------+-----+---------------------+----------------+
| Field | Type         | Null | Key | Default             | Extra          |
+-------+--------------+------+-----+---------------------+----------------+
| no    | int(11)      | NO   | PRI | NULL                | auto_increment |
| name  | varchar(256) | NO   |     | NULL                |                |
| time  | datetime     | YES  |     | current_timestamp() |                |
+-------+--------------+------+-----+---------------------+----------------+


MariaDB [notebamboo]> desc list;
+---------+---------------+------+-----+---------------------+----------------+
| Field   | Type          | Null | Key | Default             | Extra          |
+---------+---------------+------+-----+---------------------+----------------+
| no      | int(11)       | NO   | PRI | NULL                | auto_increment |
| name    | varchar(256)  | NO   |     | NULL                |                |
| user    | int(11)       | NO   |     | NULL                |                |
| level   | int(11)       | NO   |     | NULL                |                |
| AES_key | varchar(1024) | NO   |     | NULL                |                |
| visible | int(11)       | YES  |     | 1                   |                |
| list    | int(11)       | NO   |     | NULL                |                |
| time    | datetime      | YES  |     | current_timestamp() |                |
| owner   | int(11)       | NO   |     | NULL                |                |
| pos     | int(11)       | YES  |     | 0                   |                |
+---------+---------------+------+-----+---------------------+----------------+


MariaDB [notebamboo]> desc note;
+---------+--------------+------+-----+---------------------+----------------+
| Field   | Type         | Null | Key | Default             | Extra          |
+---------+--------------+------+-----+---------------------+----------------+
| no      | int(11)      | NO   | PRI | NULL                | auto_increment |
| list    | int(11)      | NO   |     | NULL                |                |
| title   | varchar(256) | NO   |     | NULL                |                |
| visible | int(11)      | YES  |     | 1                   |                |
| time    | datetime     | YES  |     | current_timestamp() |                |
| pos     | int(11)      | YES  |     | 0                   |                |
| length  | int(11)      | YES  |     | 0                   |                |
+---------+--------------+------+-----+---------------------+----------------+
7 rows in set (0.001 sec)


MariaDB [notebamboo]> desc share;
+-----------+---------------+------+-----+---------------------+----------------+
| Field     | Type          | Null | Key | Default             | Extra          |
+-----------+---------------+------+-----+---------------------+----------------+
| no        | int(11)       | NO   | PRI | NULL                | auto_increment |
| user_to   | int(11)       | NO   |     | NULL                |                |
| user_from | varchar(64)   | NO   |     | NULL                |                |
| level     | int(11)       | NO   |     | NULL                |                |
| AES_key   | varchar(1024) | NO   |     | NULL                |                |
| name      | varchar(256)  | NO   |     | NULL                |                |
| owner     | varchar(64)   | NO   |     | NULL                |                |
| list      | int(11)       | NO   |     | NULL                |                |
| time      | datetime      | YES  |     | current_timestamp() |                |
+-----------+---------------+------+-----+---------------------+----------------+


MariaDB [notebamboo]> desc user;
+-------------+---------------+------+-----+---------------------+----------------+
| Field       | Type          | Null | Key | Default             | Extra          |
+-------------+---------------+------+-----+---------------------+----------------+
| no          | int(11)       | NO   | PRI | NULL                | auto_increment |
| id          | varchar(64)   | NO   |     | NULL                |                |
| pw          | varchar(64)   | NO   |     | NULL                |                |
| nickname    | varchar(64)   | NO   |     | NULL                |                |
| email       | varchar(64)   | YES  |     | NULL                |                |
| RSA_public  | varchar(2048) | NO   |     | NULL                |                |
| RSA_private | varchar(2048) | NO   |     | NULL                |                |
| time        | datetime      | YES  |     | current_timestamp() |                |
+-------------+---------------+------+-----+---------------------+----------------+


MariaDB [notebamboo]> desc version;
+--------+--------------+------+-----+---------------------+----------------+
| Field  | Type         | Null | Key | Default             | Extra          |
+--------+--------------+------+-----+---------------------+----------------+
| no     | int(11)      | NO   | PRI | NULL                | auto_increment |
| note   | int(11)      | NO   |     | NULL                |                |
| title  | varchar(256) | NO   |     | NULL                |                |
| text   | text         | YES  |     | NULL                |                |
| user   | int(11)      | YES  |     | NULL                |                |
| time   | datetime     | YES  |     | current_timestamp() |                |
| parent | int(11)      | NO   |     | 0                   |                |
| child  | int(11)      | NO   |     | 0                   |                |
| length | int(11)      | NO   |     | 0                   |                |
+--------+--------------+------+-----+---------------------+----------------+
```

