DROP TRIGGER IF EXISTS AuthorCounting;
DROP TABLE IF EXISTS Authours_Books;
DROP TABLE IF EXISTS Books;
DROP TABLE IF EXISTS Authors;


CREATE TABLE Books
(
  BookID      BIGINT NOT NULL AUTO_INCREMENT,
  Name         VARCHAR(500),
  AuthorsAmount INT,
  PRIMARY KEY (BookID)
);

CREATE TABLE Authors
(
  AuthourID BIGINT NOT NULL AUTO_INCREMENT,
  LastName  VARCHAR(255) NOT NULL,
  FirstName   VARCHAR(255),
  PRIMARY KEY (AuthourID)
);
CREATE TABLE Authours_Books
(
  AuthourID BIGINT NOT NULL,
  BookID BIGINT NOT NULL,
  PRIMARY KEY (AuthourID,BookID),
  FOREIGN KEY (BookID) REFERENCES Books(BookID) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (AuthourID) REFERENCES Authors(AuthourID) ON DELETE CASCADE ON UPDATE CASCADE
);


delimiter |

CREATE TRIGGER AuthorCounting AFTER INSERT ON Authours_Books
  FOR EACH ROW
  BEGIN
    UPDATE Books SET AuthorsAmount = (SELECT count(Authours_Books.AuthourID) from Authours_Books where Authours_Books.BookID=NEW.BookID ) WHERE Books.BookID = NEW.BookID;
  END;
|

delimiter ;

Insert into `Books`(BookID,Name) values
  (1,'Капитанская  дочка'),
  (2,'Вий'),
  (3,'Война и мир'),
  (4,'Вечера инженера Гарина'),
  (5,'Вий и Гарин под Полтавой'),
  (6,'Петр 1 и Тарас Бульба против Наполеона');

Insert into `Authors` values
  (1,'Пушкин','Александр'),
  (2,'Гогол','Николай'),
  (3,'Толстой','Лев'),
  (4,'Толстой','Алесей');

Insert into `Authours_Books` values
  (1,1),(1,5),(1,6),
  (2,2),(2,4),(2,5),(2,6),
  (3,3),(3,6),
  (4,4),(4,5);


########################### get data ###############

select *,(select count(*)
from Authours_Books where Authours_Books.BookID=Books.BookId) as AuthorsCount
from Books
having AuthorsCount = 3  ;

SELECT count(Authours_Books.AuthourID) from Authours_Books where Authours_Books.BookID=6;