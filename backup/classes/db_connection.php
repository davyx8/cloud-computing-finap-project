<?php

	/**
	 * Base connection class, to handle queries
	 */
	class DBConnection
	{
		/**
		 * Server name
		 * @var string
		 */
		private static $_HOST = "localhost";
		
		/**
		 * User name used to login the server with
		 * @var string
		 */
		private static $_USERNAME = "huji";
		
		/**
		 * Password used to login the server with
		 * @var string
		 */
		private static $_PASSWORD = "";
		
		/**
		 * Database name to select
		 * @var string
		 */
		private static $_DATABASE_NAME = "freespot";
		
		/**
		 * Connection object
		 * @var resource
		 */
		private static $_connection = null;
	
		/**
		 * Connects to the databse.
		 * If some error occured, raises up an exception
		 * 
		 * @param resource $db_link If null, connects to the database using this class.
		 * 		Otherwise, uses this connection
		 * @throws Exception Code 1 if could not connect the server
		 * @throws Exception Code 2 if could not connect select the asked data base
		 * @return boolean Returns true if new connection was established, returns false if there is already
		 * 		an opened connection, and throws an exception otherwise 
		 */
		public static function Connect($db_link = null)
		{
			if (self::$_connection != null)
			{
				return (false);
			}
			
			if ($db_link == null)
			{
				self::$_connection = mysql_connect(self::$_HOST, self::$_USERNAME, self::$_PASSWORD)
					or self::_ThrowException("Coult not connect to database " . self::$_DATABASE_NAME . ", as user " . self::$_USERNAME . " at " . self::$_HOST, 1);
				
				mysql_select_db(self::$_DATABASE_NAME)
					or self::_ThrowException("Could not select database " . self::$_DATABASE_NAME, 2);
					

				mysql_query("SET NAMES utf8", self::$_connection)
					or self::_ThrowException("Could not set encoding", 3);
			}
			else
			{
				self::$_connection = $db_link;
			}

			return (true);
		}
	
		/**
		 * Closes the opened connection
		 * 
		 * @throws Exception Code 1 if the connection is already closed
		 * @throws Exception Code 2 if could not close the connection
		 * @return boolean If operation completed successfully
		 */
		public static function Close()
		{
			if (self::$_connection == null)
			{
				throw new Exception("The connection is already closed", 1);
			}
			
			$done = mysql_close(self::$_connection);
			if ($done == false)
			{
				throw new Exception("Could not close the database connection", 2);
			}
			self::$_connection = null;
			
			return (true);
		}

		/**
		 * Executes a sql statement, and returns the results in ResultsSet object
		 * 
		 * @param string $sql The sql statement to execute
		 * @throws Exception Code 1 if no connection is opened
		 * @throws Exception Code 2 if could not execute the query
		 * 
		 * @return Array The results
		 */
		public static function ExecuteSelectQuery($sql)
		{
			if (self::$_connection == null)
			{
				throw new Exception("No connection is opened", 1);
			}
			
			$raw_results = mysql_query($sql, self::$_connection)
				or self::_ThrowException("Could not execute query: " . mysql_error(self::$_connection), 2);
			
			$results = array();
			while ($line = mysql_fetch_array($raw_results, MYSQL_ASSOC))
			{
				$results[] = $line;
			}
			mysql_free_result($raw_results);
			return ($results);
		}
		
		/**
		 * Executes a sql statement.
		 * No results are returned
		 * 
		 * @param string $sql The sql statement to execute
		 * @throws Exception Code 1 if no connection is opened
		 * @throws Exception Code 2 if could not execute the query
		 * 
		 * @return boolean Returns true if the operation completed successfully
		 */
		public static function ExecuteUpdateQuery($sql)
		{
			if (self::$_connection == null)
			{
				throw new Exception("No connection is opened", 1);
			}
			
			$done = mysql_query($sql, self::$_connection)
				or self::_ThrowException("Could not execute query: " . mysql_error(self::$_connection));
			
			return ($done);
		}
		
		/**
		 * Helper function to throw up exceptions when function call is required
		 * 
		 * @param string $message The exception message
		 * @param string $code The exception code
		 * @param string $file The filename where the exception was created 
		 * @param string $line The line where the exception was created
		 * @throws Exception The asked exception
		 */
		//private static function _ThrowException($message, $code = null, $file = null, $line = null)
		private static function _ThrowException($message, $code = null, $previous = null)
		{
			throw new Exception($message, $code, $previous);
		}
	}
		
?>
