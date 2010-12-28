-- MySQL dump 10.13  Distrib 5.1.50, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: ppi_issue_manager
-- ------------------------------------------------------
-- Server version	5.1.50

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assigned_user_id` int(11) NOT NULL,
  `created` bigint(20) NOT NULL,
  `ticket_type` enum('feature_request','bug','enhancement') NOT NULL,
  `severity` enum('minor','major','critical') NOT NULL,
  `status` enum('open','assigned','closed') NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (11,'Ticket View',3,3,1283725315,'feature_request','minor','open','Find out this mad wrapping problem for the Created field.'),(20,'sendMail()',3,3,1284555495,'feature_request','minor','open','Fix the syntax errors in PPI_Model_Helper::sendMail();\r\n\r\nRevise where to put it. maybe PPI_Mail ?\r\n\r\n-----\r\nFixed and moved. Updated the helper to alias the new location PPI_Mail::sendMail();'),(27,'Email sending',3,0,1291668236,'enhancement','minor','open','<p>Look into \"subscribe\" functionality and the ability to unsubscribe.</p>\r\n<p>If you create a ticket, you\'re automatically subscribed.</p>\r\n<p>Something like this:</p>\r\n<p>\r\n<pre><code class=\"php\">// override\r\nfunction insert($data) {\r\n    $iTicketID = parent::insert($data);\r\n    // Subscribe code here. Need to make a new DB table for subscriptions.\r\n    return $iTicketID;\r\n}</code></pre>\r\n</p>\r\n<p>&nbsp;</p>'),(26,'Implementation of Disk based cache aka PPI_Cache_Disk',7,0,1291667857,'feature_request','minor','open','<p>There\'s already an implementation for APC and Memcached but APC fails under fcgi or fcgid and Memcached is a central cache system which is not used on small scale apps.</p>\r\n<p>I think a file based cache with excellent performance would really really be helpful!</p>'),(23,'Add PPI_Controller->set()',3,5,1291420443,'enhancement','minor','open','<p>Add PPI_Controller-&gt;set()  This will let users append to the current view variables, then you can just do $this-&gt;load()  --- Update --- This has been implemented, tested but not applied to a live environment for full testing. -&gt;set() can take array or scalar values as the key.</p>'),(24,'Permalinks for comments',3,8,1291645722,'enhancement','minor','open','<p>Create a permalink HREF that people can copy the url <a href=\"#comment45\">Permalink</a></p>\r\n<p>Hook in the hidden <a name=\"2comment45\"></a></p>\r\n<p>&nbsp;</p>'),(25,'Attach files to tickets',3,8,1291646299,'enhancement','minor','open','<p>Ability to attach a file to the ticket upon creation, post-creation.</p>\r\n<p>Ability to attach a file to a comment.</p>'),(28,'Check view file existance.',3,0,1291725218,'enhancement','minor','open','<div>\r\n<pre><span style=\"font-family: monospace;\">Add a file_exists() check to the view renderer before it tries to include it</span></pre>\r\n</div>'),(29,'Add syntax highlighter',3,3,1291762077,'enhancement','minor','assigned','<p>Update the admin create ticket page to put in the syntax highlighter.</p>\r\n<p>Remove the HTML icon from the WYSIWYG</p>'),(30,'Wrap view output in output buffering',3,0,1291762354,'feature_request','minor','open','<p>Wrap view output in output buffering so that we can do a try{} catch{} and display the general exception page on its own and not half-way into a view output.</p>'),(31,'Admin User Addedit - Validate unique data.',3,0,1291825640,'enhancement','minor','open','<p>Validate the users email address _and_ their \"usernameField\" value.</p>\r\n<p>This means&nbsp;whether&nbsp;they have the <strong>$config-&gt;system-&gt;usernameField </strong>is set to \'username\' or \'email\' it will make sure that it\'s unique.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>'),(32,'Admin User Addedit - Escalate Privileges',3,0,1291825925,'bug','minor','open','<p>Check that the role_id of the user that\'s being created/updated is not higher than the current user\'s ID.</p>\r\n<p>Something like this:</p>\r\n<p>\r\n<pre><code class=\"php\">if($this-&gt;getAuthData(false)-&gt;role_id &lt; $formInfo[\'role_id\'])) {\r\n    throw new PPI_Exception(\'Permission error: You cannot modify user privileges higher than your own\');\r\n}</code></pre>\r\n</p>'),(33,'PPI Admin - User Delete',3,3,1291923371,'bug','minor','closed','<p><strong>Make it restrictive for users to delete themselves.</strong></p>'),(34,'PPI User Add/Edit Password Validation',3,0,1291923823,'enhancement','minor','open','<p>Make sure the <strong>usernameField</strong> does not match the password.</p>');
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_comment`
--

DROP TABLE IF EXISTS `ticket_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` bigint(20) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_comment`
--

LOCK TABLES `ticket_comment` WRITE;
/*!40000 ALTER TABLE `ticket_comment` DISABLE KEYS */;
INSERT INTO `ticket_comment` VALUES (1,3,'<p>Test</p>',1291494811,23),(2,5,'<p>Will there be a magic function like __set to manipulate the data or take action?</p>',1291494883,23),(3,3,'<p>$this-&gt;set(\'key\', $val);</p>\r\n<p>or</p>\r\n<p>$this-&gt;set(array(\'key\' =&gt; $val, \'foo\' =&gt; $bar));</p>\r\n<p>which is the equiv of..</p>\r\n<p>$key = \'val\';</p>\r\n<p>$foo = \'bar\';</p>\r\n<p>$this-&gt;set(compact(\'key\', \'foo\'));</p>',1291494982,23),(4,6,'<p><strong>Little test comment.</strong></p>',1291496095,23),(5,3,'<p>Testing the new syntax highlighter.</p>\r\n<p>\r\n<pre><code class=\"php\">$this-&gt;set(\'key\', $val);\r\n\r\n// or\r\n$this-&gt;set(array(\'key\' =&gt; $val, \'foo\' =&gt; $bar));\r\n\r\n// or\r\n$key = \'val\';\r\n$foo = \'bar\';\r\n$this-&gt;set(compact(\'key\', \'foo\'));</code></pre>\r\n</p>',1291502086,23),(6,5,'<p>\r\n<pre><code class=\"php\">&lt;?php echo \'I\\\'m the modaeffing greatest\'; ?&gt;</code></pre>\r\n</p>',1291643970,23);
/*!40000 ALTER TABLE `ticket_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `created` int(25) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `activation_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,4,1283013351,'Paul','Dragoonis','paul@dragoonis.com','1a8e9f5c880ace89adf4925b47e77db462fbe2e067acda1379c2',1,'MTI4MzAxMzM1MQ=='),(5,2,1291494772,'Sean','Koole','sean@seankoole.com','afcfb756b69d9690ee89b72bae116e999192a48dddf579202245',1,'MTI5MTQ5NDc3Mg=='),(6,2,1291495585,'Keith','M','aoeex@yahoo.com','14aa76f27eb3b686d97a88af2fc33de8b14cb55e6a11b0785550',1,'MTI5MTQ5NTU4NQ=='),(7,2,1291667627,'Dayson','Pais','dayson@epicwhale.org','a5f7c0f6aeafb0e0ae90fdc83b52360c1858f48c467e4d3fe221',1,'MTI5MTY2NzYyNw=='),(8,2,1291987930,'Ross','Moroney','code_ph0y@googlemail.com','f5173285c259fab5cd70678715138b8a003ff4c66b95c82b65d8',1,'MTI5MTk4NzkzMA==');
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

-- Dump completed on 2010-12-10 13:36:36
