-- MySQL dump 10.13  Distrib 8.0.12, for macos10.13 (x86_64)
--
-- Host: localhost    Database: grocery_store
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8 ;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userFirstName` varchar(30) NOT NULL,
  `userLastName` varchar(30) NOT NULL,
  `userEmailId` varchar(50) NOT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userActiveSince` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userShopName` varchar(145) NOT NULL,
  `userShopAddress` varchar(245) NOT NULL,
  `userShopPincode` int(11) NOT NULL,
  `userShopState` varchar(45) NOT NULL,
  KEY `userId` (`userId`),
  KEY `userId_2` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ajay','Pandita','ajaypandita73@gmail.com','codeample','2018-10-11 13:03:13','','',0,''),(2,'Ajay','Pandita','root@demo.com','codeample','2018-10-11 13:07:12','','',0,''),(3,'Ajay','Pandita','root1@demo.com','codeample','2018-10-11 13:08:32','','',0,''),(4,'Ajay','Pandita','root12@demo.com','codeample','2018-10-11 13:09:02','','',0,''),(5,'Ajay','Pandita','root123@demo.com','codeample','2018-10-11 13:10:42','','',0,''),(6,'Ajay','Pandita','root32@demo.com','codeample','2018-10-11 13:11:01','','',0,''),(7,'Ajay','Pandita','root4@demo.com','codeample','2018-10-11 13:12:02','','',0,''),(8,'Ajay','Pandita','root@demo.com3','codeample','2018-10-11 13:12:47','','',0,''),(9,'Ajay','Pandita','root@demo.com34','codeample','2018-10-11 13:13:10','','',0,''),(10,'Demo','Account','demo@demo.com','demodemo','2018-10-11 15:58:30','','',0,''),(11,'Ajay','Pandita','ajaypandita731@gmail.com','codeample','2018-10-29 15:09:12','Codeample','jammu',181205,'Jammu'),(12,'Ajay','Pandita','ajaypandita11@gmail.com','codeample','2018-11-22 13:55:53','Codeample','jammu',144411,'Jammu');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-22 20:34:40
