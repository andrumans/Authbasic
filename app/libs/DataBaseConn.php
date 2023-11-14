<?php

class DataBaseConn {
    private $host;
    private $user;
    private $pass;
    private $database;
    private $conn;  // Połączenie z bazą danych

    // Konstruktor
    public function __construct($host, $user, $pass, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;

        // Nawiązanie połączenia z bazą danych
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database);

        // Sprawdzenie czy połączenie się udało
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Metoda do dodawania rekordów do tabeli
    public function put($table, $columns, $values) {
        $columnString = implode(", ", $columns);
        $valueString = implode("', '", $values);

        $sql = "INSERT INTO $table ($columnString) VALUES ('$valueString')";

        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    // Metoda do pobierania danych z tabeli
    public function get($table, $columns, $options) {
        $columnString = implode(", ", $columns);

        $condition = isset($options['condition']) ? "WHERE " . $options['condition'] : "";

        $sql = "SELECT $columnString FROM $table $condition";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                print_r($row);
            }
        } else {
            echo "0 results";
        }
    }

    // Metoda do usuwania danych z tabeli
    public function delete($table, $options) {
        $condition = isset($options['condition']) ? "WHERE " . $options['condition'] : "";

        $sql = "DELETE FROM $table $condition";

        if ($this->conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->conn->error;
        }
    }

    // Metoda do zamykania połączenia z bazą danych
    public function closeConnection() {
        $this->conn->close();
    }
}
?>
