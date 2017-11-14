create database cheapbooks;


create table Author (
   ssn varchar(10) primary key,
   name varchar(32),
   address varchar(100),
   phone varchar(20)
);

create table Book (
   ISBN varchar(10) primary key,
   title varchar(32),
   year varchar(10),
   price varchar(20),
   publisher varchar(40)
);

create table WrittenBy (
    ssn varchar(10) references Author (ssn),
    ISBN varchar(10) references Book (ISBN),
    primary key(ssn,ISBN)
);

create table Warehouse (
    warehouseCode varchar(10) primary key,
    name varchar(32),
    address varchar(100),
    phone varchar(20)
);

create table Stocks (
    ISBN varchar(10) references Book (ISBN),
    warehouseCode varchar(10) references Warehouse (warehouseCode),
    number int(10),
    primary key(ISBN, warehouseCode)
);

create table Customers (
    username varchar(10) primary key,
    password varchar(32),
    address varchar(100),
    phone varchar(20),
    email varchar(45)
);

create table ShoppingBasket (
    basketId varchar(50) primary key,
    username varchar(10) references Customers (username)

);

create table Contains (
    ISBN varchar(10) references Book (ISBN),
    basketID varchar(50) references ShoppingBasket (basketID),
    number int(10),
    primary key(ISBN, basketID)
);

create table ShippingOrder (
    ISBN varchar(10) references Book (ISBN),
    warehouseCode varchar(10) references Warehouse (warehouseCode),
    username varchar(10) references Customers (username),
    number varchar(10),
    primary key(ISBN,warehouseCode,username)
);


insert into Author values("0123456987","J K Rowling","703 Benge Drive, Arlington","4698527852");
insert into Author values("0963528741","Mark Twain","500 S Cooper Street, Arlington","4691025896");
insert into Author values("0325698743","Anne Bronte","800 S Freeway, Austin","4693019701");
insert into Author values("0589741028","Jane Austen","720 Withfeild, Irving","4698520137");
insert into Author values("1289412563","Levis Bronte","652 N Cooper Street, Aarlington","4695647896");


insert into Book values("8975684512","The Casual Vacancy","2001","150.00","Random House Inc.");
insert into Book values("3259876470","The Innocents Abroad","2008","100.00","Simon & Schuster");
insert into Book values("2315401236","Agnes Grey","2003","220.00","Llewellyn Worldwide, Ltd.");
insert into Book values("2015069045","Glass Town","1998","230.00","Melville House Publishing");
insert into Book values("8010806034","Persuasion","2009","300.00","W.W. Norton and Company");
insert into Book values("8010806089","Glass Mark","2005","356.00","PK and Company");


insert into WrittenBy values("0123456987","8975684512");
insert into WrittenBy values("0963528741","3259876470");
insert into WrittenBy values("0589741028","2315401236");
insert into WrittenBy values("0325698743","2015069045");
insert into WrittenBy values("0589741028","8010806034");
insert into WrittenBy values("1289412563","8010806089");


insert into Warehouse values("789203","Irving Warehouse","600 Withfeild, Irving","4698521023");
insert into Warehouse values("789204","Austin Warehouse","850 N Freeway, Austin","4698503127");
insert into Warehouse values("789205","Arlington Warehouse","700 Benge Drive, Arlington","4698521289");


insert into Stocks values("8975684512","789203",2000);
insert into Stocks values("3259876470","789204",500);
insert into Stocks values("2315401236","789205",4900);
insert into Stocks values("8975684512","789205",850);
insert into Stocks values("2015069045","789203",7000);
insert into Stocks values("2315401236","789204",4000);
insert into Stocks values("3259876470","789203",9000);
insert into Stocks values("2015069045","789204",6500);
insert into Stocks values("3259876470","789205",5890);
insert into Stocks values("2015069045","789205",4890);
insert into Stocks values("8010806089","789205",7890);

