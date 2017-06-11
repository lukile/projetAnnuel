package com.esgi.database;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class UserRepository {

    private final DatabaseManager databaseManager;

    public UserRepository(DatabaseManager databaseManager) {
        this.databaseManager = databaseManager;
    }

    public List<User> findUsers(String year, String month) {
        final PreparedStatement statement;
        Connection connection = databaseManager.getConnection();
        String startDateLike = "%-%" + month + '-' + year;

        final String sql = "select u.firstname, u.lastname, u.mail, " +
                " of.id, of.invoice, " +
                " ofs.booking_start_date, ofs.booking_start_hour, ofs.booking_end_date, ofs.booking_end_hour" +
                " from aen.user u " +
                " inner join aen.order_form of on of.user_id = u.id " +
                " inner join aen.order_form_service ofs on ofs.order_form_id = of.id" +
                " where ofs.booking_start_date like ?";

        try {
            statement = connection.prepareStatement(sql);
            statement.setString(1, startDateLike);

            ResultSet resultSet = statement.executeQuery();

            List<User> users = new ArrayList<>();
            while(resultSet.next()) {
                String firstname = resultSet.getString(1);
                String lastname = resultSet.getString(2);
                String mail = resultSet.getString(3);
                Long orderId = resultSet.getLong(4);
                Double invoice = resultSet.getDouble(5);
                String startDate = resultSet.getString(6);
                String startTime = resultSet.getString(7);
                String endDate = resultSet.getString(8);
                String endTime = resultSet.getString(9);


                Order order = new Order(orderId, invoice, startDate + "  " + startTime, endDate + " " + endTime);

                users.add( new User(firstname, lastname, mail, order) );
            }
            return users;
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }
}

