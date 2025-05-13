<?php
	define("SERVER", "localhost");
	define("USER", "root");
	define("PASSWORD", "");
	define("DBNAME", "message");
	define("DBNAME2", "login");

	class message_port{
		function __construct(){
			$connection = mysqli_connect(SERVER,USER,PASSWORD,DBNAME);
			$this->conn = $connection;
		}

		public function insert_data($name,$email,$message){
			$sql_insert = mysqli_query($this->conn,"INSERT INTO message_portfolio(Name,Email,Message) VALUES('$name','$email','$message')");

			return $sql_insert;
		}
		public function fetch_data(){
			$sql_fetch = mysqli_query($this->conn,"SELECT * FROM message_portfolio");

			return $sql_fetch;
		}

		public function delete_data($id){
			$sql_delete = mysqli_query($this->conn,"DELETE FROM message_portfolio WHERE ID ='$id'");

			return $sql_delete;
		}

		public function update_data($name,$email,$message,$id){
			$sql_update = mysqli_query($this->conn, "UPDATE message_portfolio SET Name = '$name',Email = '$email',Message = '$message',ID = '$id'");

			return $sql_update;
		}


	}
	class login_page{
		function __construct(){
			$connLog = mysqli_connect(SERVER,USER,PASSWORD,DBNAME2);

			if (!$connLog) {
        		die('Connection failed: ' . mysqli_connect_error());
    		}

			$this->conn = $connLog;
		}
		public function insert_data($name,$email,$message){
			$sql_insert = mysqli_query($this->conn,"INSERT INTO message(Fname,Email,message) VALUES('$name','$email','$message')");

			return $sql_insert;
		}

		//Fetch Login
		public function fetch_admin($username){
			$sql_fetch = mysqli_query($this->conn,"SELECT * FROM admin WHERE Username = '$username'");
				if (!$sql_fetch) {
      		 		die('Error in SQL query: ' . mysqli_error($this->conn));
 			  	}
			return $sql_fetch;
		}
		public function fetch_user($username){
			$sql_fetch = mysqli_query($this->conn,"SELECT * FROM user WHERE Username = '$username'");
				if (!$sql_fetch) {
      		 		die('Error in SQL query: ' . mysqli_error($this->conn));
 			  	}
			return $sql_fetch;
		}

		public function fetch_data(){
			$sql_fetch = mysqli_query($this->conn,"SELECT * FROM message");

			return $sql_fetch;
		}
		//Client Registration
		public function insert_register($username,$password,$fname,$lname,$email,$phone,$profile){
			$sql_insertRegister = mysqli_query($this->conn,"INSERT INTO user(Username,Password,Firstname,Lastname,Email,Phone,Profile_pic) VALUES('$username','$password','$fname','$lname','$email','$phone','$profile')");

			return $sql_insertRegister;
		}
		public function fetch_profile($id){
			$sql_fetchprofile = mysqli_query($this->conn,"SELECT * FROM user WHERE Id = '$id'");

			return $sql_fetchprofile;
		}
		public function update_data($fname,$lname,$email,$phone,$id){
			$sql_update = mysqli_query($this->conn, "UPDATE user SET Firstname = '$fname',Lastname = '$lname',Email = '$email',Phone = '$phone' WHERE Id = '$id'");

			return $sql_update;
		}
		public function update_pic($picture,$id){
			$sql_update = mysqli_query($this->conn, "UPDATE user SET Profile_pic = '$picture' WHERE Id = '$id'");

			return $sql_update;
		}
		public function fetch_info(){
			$sql_fetch = mysqli_query($this->conn,"SELECT * FROM user ");

			return $sql_fetch;
		}
		public function fetch_product(){
			$sql_fetchprofile = mysqli_query($this->conn,"SELECT * FROM products ORDER BY product_name");

			return $sql_fetchprofile;
		}
		public function delete_data($id){
			$sql_delete = mysqli_query($this->conn,"DELETE FROM products WHERE Id ='$id'");

			return $sql_delete;
		}
		public function insert_product($name,$picture,$messages,$price){
			$sql_insertRegister = mysqli_query($this->conn,"INSERT INTO products(product_name,product_pic,description,price) VALUES('$name','$picture','$messages','$price')");

			return $sql_insertRegister;
		}
		public function fetch_order(){
			$fetch_order = mysqli_query($this->conn,"SELECT * FROM orders_product ORDER BY product_name");

			return $fetch_order;
		}
		public function insert_order($fname,$lname,$items,$price,$pro_name,$pro_img){
			$insert_order = mysqli_query($this->conn,"INSERT INTO orders_product(Fname,Lname,Items,price,product_name,product_img) VALUES('$fname','$lname','$items','$price','$pro_name','$pro_img')");

			return $insert_order;
		}
		public function fetch_specific_order($id){
			$sql_fetch = mysqli_query($this->conn,"SELECT * FROM products WHERE Id = $id");

			return $sql_fetch;
		}
		public function delete_order($id){
			$sql_delete = mysqli_query($this->conn,"DELETE FROM orders_product WHERE Id ='$id'");

			return $sql_delete;
		}
		public function update_order($items,$id){
			$update_order = mysqli_query($this->conn, "UPDATE orders_product SET Items = '$items'WHERE Id ='$id'");

			return $update_order;
		}
		public function change_specific_order($id){
			$sql_fetch = mysqli_query($this->conn,"SELECT * FROM orders_product WHERE Id = $id");

			return $sql_fetch;
		}
		public function change_order($name,$message,$price,$id){
			$update_order = mysqli_query($this->conn, "UPDATE products SET product_name='$name',description='$message',price='$price'WHERE Id ='$id'");

			return $update_order;
		}




		public function order($id,$items,$price,$pro_name,$pro_img){
			$order = mysqli_query($this->conn,"INSERT INTO orders_product(product_id,Items,price,product_name,product_img) VALUES('$id','$items','$price','$pro_name','$pro_img')");

			return $order;
		}
		public function delete($id){
			$sql_delete = mysqli_query($this->conn,"DELETE FROM orders_product WHERE Id ='$id'");

			return $sql_delete;
		}

		// transfers the orders to a different table and the deletes the current one
		public function processOrders() {
		    $insertQuery = mysqli_query($this->conn, "INSERT INTO process_order (Id, product_name, price, items) SELECT product_id, product_name, price, items FROM orders_product");

		    $deleteQuery = mysqli_query($this->conn, "DELETE FROM orders_product");
		}

		public function order_fetch(){
			$order_fetch = mysqli_query($this->conn,"SELECT * FROM process_order ORDER BY product_name");

			return $order_fetch;
		}
		public function pdf_fetch(){
			$fetch = mysqli_query($this->conn, "SELECT * FROM process_order");

			return $fetch;
		}
		public function completedOrders() {
			$insertQuery = mysqli_query($this->conn, "INSERT INTO completed_order (Id, product_name, price, items) SELECT Id,product_name, price, items FROM process_order");

			if ($insertQuery) {
					$deleteQuery = mysqli_query($this->conn, "DELETE FROM process_order");
					return $deleteQuery;
			}
	}
		public function delete_process_order($id){
			$deleteQuery = mysqli_query($this->conn, "DELETE FROM process_order WHERE Id = '$id'");
			return $deleteQuery;
		}
		
		public function fetch_records(){
			$fetch = mysqli_query($this->conn, "SELECT * FROM completed_order");

			return $fetch;
		}
		public function delete_complete_order($id){
			$deleteQuery = mysqli_query($this->conn, "DELETE FROM completed_order WHERE Id = '$id'");
			return $deleteQuery;
		}
		public function delete_message($id){
			$deleteQuery = mysqli_query($this->conn, "DELETE FROM message WHERE Id = '$id'");
			return $deleteQuery;
		}
		public function delete_all_records(){
			$deleteQuery = mysqli_query($this->conn, "DELETE FROM completed_order");
			return $deleteQuery;
		}
		public function fetch_all_records(){
			$fetchRecord = mysqli_query($this->conn, "SELECT * FROM completed_order ORDER BY product_name");
			return $fetchRecord;
		}
		public function get_product_info_by_id($id){
			$fetchRecord = mysqli_query($this->conn, "SELECT * FROM completed_order WHERE Id = '$id'");
			return $fetchRecord;
		}

	}
?>