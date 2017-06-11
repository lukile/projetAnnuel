package com.esgi.database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DatabaseManager {

    private final String URL = "jdbc:mysql://localhost:3306/aen";
    private final String USER = "root";
    private final String PASSWORD = "";

    private Connection connection;

    public Connection getConnection() {
        try {
            if (connection == null || connection.isClosed()) {
                connection = DriverManager.getConnection(URL, USER, PASSWORD);
            }
            return connection;
        } catch (SQLException e) {
            e.printStackTrace();
            return null;
        }
    }
}
