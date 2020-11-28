-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: delicious_book
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,1,'The Royal Easter','Marshella Goodsworth',14.99,'royal_ester.png',0),(2,1,'Easter Throughout Europe','Nancy Silverman',10.28,'easter_throughout_europe.png',0),(3,1,'Southern Living: Our Best Christmas','Jean Wickstrom Liles',0.99,'southern_living.png',1),(4,1,'Thanksgiving Recipes','Hannie P Scott',2.92,'thanksgiving_recipes.png',1),(5,2,'DIY Cannabis-Infused Desserts','Jackie Sanders',9.38,'diy_cannabis_infused.png',0),(6,2,'Keto Sweet Tooth Cookbook','Aaron Day',8.64,'keto_sweet_tooth.png',1),(7,2,'Modern Art Desserts','Caitlin Freeman',3.43,'modern_art_desserts.png',0),(8,2,'Bakin\' Without Eggs','Rosemarie Emro',2.49,'bakin_without_eggs.png',1),(9,3,'Whole Food Cooking Every Day','Amy Chaplin',22,'whole_food_cooking.png',1),(10,3,'Meatless','Martha Stewart Living',2.56,'meatless.png',0),(11,3,'Bowl: Vegetarian Recipes for Ramen','Lukas Volger',11.74,'bowl_vegetarian.png',0),(12,3,'The Winter Vegetarian','Darra Goldstein',1.33,'winter_vegetarian.png',1),(13,4,'North Korean Recipes','Anthony Boundy',7.91,'north_korean_recipes.png',0),(14,4,'The Best Mexican Recipes','America\'s Test Kitchen',17.11,'the_best_mexican.png',1),(15,4,'Old World Italian','Mimi Thorisson',27.26,'old_world_italian.png',1),(16,4,'The Best Authentic Australian','Angel Burns',10.26,'authentic_australian.png',1),(17,1,'Giving Thanks','Kathleen Curtin',1.45,'giving_thanks.png',0),(18,1,'New York Christmas','Lisa Nieschlag',2.91,'new_york_christmas.png',0),(19,2,'Easy Desserts for Beginners','Maud Jackson',7.91,'easy_desserts.png',1),(20,2,'Chocolate: A Love Story','Max Brenner',1.45,'chocolate_love.png',0),(21,3,'The Heart of the Plate','Mollie Katzen',2.06,'heart_of_the_plate.png',1),(22,3,'Bazzar: Vegetables','Sabrina Ghayour',18.97,'bazzar.png',0),(23,4,'The Gaijin Cookbook','Ivan Orkin',15.21,'gaijin.png',0),(24,4,'The Secret French','Samantha Vrant',11.13,'secret_french.png',1);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Holiday'),(2,'Dessert'),(3,'Vegetarian'),(4,'Cultural Cuisine');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-22 16:06:44
