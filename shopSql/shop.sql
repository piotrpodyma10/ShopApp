-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Cze 2018, 15:57
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cartitems`
--

CREATE TABLE `cartitems` (
  `Id` int(12) NOT NULL,
  `CartId` int(12) NOT NULL,
  `ProductId` int(12) NOT NULL,
  `Quantity` int(5) DEFAULT NULL,
  `Unitprice` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `carts`
--

CREATE TABLE `carts` (
  `Id` int(12) NOT NULL,
  `UserId` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `carts`
--

INSERT INTO `carts` (`Id`, `UserId`) VALUES
(2, 1),
(3, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logins`
--

CREATE TABLE `logins` (
  `Id` int(12) NOT NULL,
  `Login` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `Password` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `UserId` int(12) DEFAULT NULL,
  `Role` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `logins`
--

INSERT INTO `logins` (`Id`, `Login`, `Password`, `UserId`, `Role`) VALUES
(1, 'user', '$2y$10$jMXRUKKyaVecl52fMA9tWeKcXnABUKC8DCMgPYYd9mq/qxSBiNKr6', 1, 'user'),
(2, 'login', '$2y$10$0C/6lvh/inCF6KiMsl3o..neGg8AfsKiGzEwFofmB2O0EDJqTEeGu', 2, 'user'),
(3, 'account', '$2y$10$y//WzqvEGtZRZgkGsZobrO1KmnaMOi7zZS8.0uYjx..h7pLQybezW', 3, 'user'),
(4, 'Salesman', '$2y$10$Gx1qN63CcqXTVzA7OobXvedGckO9Jtdt5RqWkeEISkZqJe4krhhmq', 4, 'salesman'),
(5, 'admin', '$2y$10$cJot5iIcHmWFZffG.QXeCuaA65mGAFkkAyA4D.LwWz//TCT1j.N8C', 5, 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderdetails`
--

CREATE TABLE `orderdetails` (
  `Id` int(12) NOT NULL,
  `OrderId` int(12) NOT NULL,
  `FirstName` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `LastName` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `PhoneNumber` varchar(15) COLLATE utf8_polish_ci DEFAULT NULL,
  `Email` varchar(64) COLLATE utf8_polish_ci DEFAULT NULL,
  `Street` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `HouseNumber` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `FlatNumber` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `City` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `PostalCode` varchar(10) COLLATE utf8_polish_ci DEFAULT NULL,
  `State` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `Country` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `Notes` varchar(512) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orderdetails`
--

INSERT INTO `orderdetails` (`Id`, `OrderId`, `FirstName`, `LastName`, `PhoneNumber`, `Email`, `Street`, `HouseNumber`, `FlatNumber`, `City`, `PostalCode`, `State`, `Country`, `Notes`) VALUES
(14, 14, 'User', 'Password', '123456789', 'user@password.pl', 'Agrestowa', '1', '', 'Wroc?aw', '53-006', 'dolno?l?skie', 'Polska', NULL),
(15, 15, 'admin', 'admin', '123456789', 'admin@admin.com', 'Admin St.', '1', '2', 'Admin City', '12-345', 'Admino', 'Admin Land', NULL);

--
-- Wyzwalacze `orderdetails`
--
DELIMITER $$
CREATE TRIGGER `onAfterOrderDetailsInsertUpdateOrder` AFTER INSERT ON `orderdetails` FOR EACH ROW UPDATE Orders SET OrderDetailsId = NEW.Id WHERE Id = NEW.OrderId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderitems`
--

CREATE TABLE `orderitems` (
  `Id` int(12) NOT NULL,
  `OrderId` int(12) NOT NULL,
  `ProductId` int(12) NOT NULL,
  `Quantity` int(5) DEFAULT NULL,
  `Unitprice` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orderitems`
--

INSERT INTO `orderitems` (`Id`, `OrderId`, `ProductId`, `Quantity`, `Unitprice`) VALUES
(10, 14, 2, 2, 11000),
(11, 15, 2, 3, 11000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `Id` int(12) NOT NULL,
  `UserId` int(12) NOT NULL,
  `OrderDetailsId` int(12) DEFAULT NULL,
  `Total` int(32) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `Status` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`Id`, `UserId`, `OrderDetailsId`, `Total`, `CreatedDate`, `Status`) VALUES
(14, 1, 14, 22000, '2018-06-24 12:24:46', 'DELIVERED'),
(15, 5, 15, 33000, '2018-06-24 15:44:30', 'ACCEPTED');

--
-- Wyzwalacze `orders`
--
DELIMITER $$
CREATE TRIGGER `SetCreatedDate` BEFORE INSERT ON `orders` FOR EACH ROW SET NEW.CreatedDate = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `Id` int(12) NOT NULL,
  `Name` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  `Unitprice` int(32) DEFAULT NULL,
  `ImageUrl` varchar(2000) COLLATE utf8_polish_ci DEFAULT NULL,
  `Description` mediumtext COLLATE utf8_polish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`Id`, `Name`, `IsActive`, `Unitprice`, `ImageUrl`, `Description`) VALUES
(1, 'Smartfon', b'1', 1500, 'https://placeimg.com/640/480/tech?t=1527855424197', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis erat efficitur lectus suscipit, malesuada mollis felis elementum. Aliquam et lacinia augue, sed ultricies sapien. Nullam pulvinar felis elit. Sed non orci condimentum, posuere felis nec, iaculis nisi. Quisque felis augue, malesuada et odio ornare, pulvinar pellentesque magna. Quisque varius nec turpis ut porta. Etiam ultricies metus tortor, facilisis luctus nisl condimentum ut. In in blandit mi, in vulputate ipsum. Aliquam id tellus eu nunc ornare semper nec ut nisl. Etiam et gravida lectus, ut imperdiet ipsum.'),
(2, 'Laptop', b'0', 11000, 'https://placeimg.com/640/480/tech?t=1527855482518', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis erat efficitur lectus suscipit, malesuada mollis felis elementum. Aliquam et lacinia augue, sed ultricies sapien. Nullam pulvinar felis elit. Sed non orci condimentum, posuere felis nec, iaculis nisi. Quisque felis augue, malesuada et odio ornare, pulvinar pellentesque magna. Quisque varius nec turpis ut porta. Etiam ultricies metus tortor, facilisis luctus nisl condimentum ut. In in blandit mi, in vulputate ipsum. Aliquam id tellus eu nunc ornare semper nec ut nisl. Etiam et gravida lectus, ut imperdiet ipsum.'),
(3, 'Aparat', b'0', 2500, 'https://placeimg.com/640/480/tech?t=1527855597149', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lobortis erat efficitur lectus suscipit, malesuada mollis felis elementum. Aliquam et lacinia augue, sed ultricies sapien. Nullam pulvinar felis elit. Sed non orci condimentum, posuere felis nec, iaculis nisi. Quisque felis augue, malesuada et odio ornare, pulvinar pellentesque magna. Quisque varius nec turpis ut porta. Etiam ultricies metus tortor, facilisis luctus nisl condimentum ut. In in blandit mi, in vulputate ipsum. Aliquam id tellus eu nunc ornare semper nec ut nisl. Etiam et gravida lectus, ut imperdiet ipsum.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `Id` int(12) NOT NULL,
  `FirstName` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `LastName` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `Country` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `PostalCode` varchar(10) COLLATE utf8_polish_ci DEFAULT NULL,
  `City` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `State` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `Street` varchar(128) COLLATE utf8_polish_ci DEFAULT NULL,
  `HouseNumber` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `FlatNumber` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `PhoneNumber` varchar(15) COLLATE utf8_polish_ci DEFAULT NULL,
  `Email` varchar(64) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`Id`, `FirstName`, `LastName`, `Country`, `PostalCode`, `City`, `State`, `Street`, `HouseNumber`, `FlatNumber`, `PhoneNumber`, `Email`) VALUES
(1, 'User', 'Password', 'Polska', '53-006', 'Wrocław', 'dolnośląskie', 'Agrestowa', '1', NULL, '123456789', 'user@password.pl'),
(2, 'Login', 'Password', 'Polska', '52-215', 'Wrocław', 'dolnośląskie', 'Ametystowa', '1', '1', '987654321', 'login@password.pl'),
(3, 'Account', 'Password1', 'Polska', '52-241', 'Wrocław', 'dolnośląskie', 'Andrzeja Małkowskiego', '1', 'b', '112358132', 'account@password1.pl'),
(4, 'salesman', 'salesman', 'SaleLand', '98-765', 'SalesCity', 'Saleso', 'Sales St.', '1', '2', '123456789', 'Salesman@Salesman.com'),
(5, 'Admin', 'Admin', 'AdminLand', '12-345', 'AdminCity', 'Admino', 'Admin St.', '2', '1', '987654321', 'admin@admin.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CartId` (`CartId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indeksy dla tabeli `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indeksy dla tabeli `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indeksy dla tabeli `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indeksy dla tabeli `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrderId` (`OrderId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `fk_OrderDetails_id` (`OrderDetailsId`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `carts`
--
ALTER TABLE `carts`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `logins`
--
ALTER TABLE `logins`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`CartId`) REFERENCES `carts` (`Id`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Ograniczenia dla tabeli `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Ograniczenia dla tabeli `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Ograniczenia dla tabeli `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`Id`);

--
-- Ograniczenia dla tabeli `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`Id`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_OrderDetails_id` FOREIGN KEY (`OrderDetailsId`) REFERENCES `orderdetails` (`Id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
