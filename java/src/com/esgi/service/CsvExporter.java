package com.esgi.service;

import com.esgi.database.Order;
import com.esgi.database.User;

import java.io.FileWriter;
import java.io.IOException;
import java.io.Writer;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class CsvExporter {

    private final List<String> HEADERS = Arrays.asList(
            "Order id",
            "Order invoice amount",
            "Order start date",
            "Order end date",
            "User Firstname",
            "User Lastname",
            "User Email"
    );

    public void export(List<User> users, String filename) {
        FileWriter fileWriter = null;
        try {
            fileWriter = new FileWriter(filename);
            writeLine(fileWriter, HEADERS);
            writeUsers(users, fileWriter);

        } catch (IOException e) {
            System.out.println("Problem with opening writer for file " + filename);
            e.printStackTrace();
        } finally {
            if (fileWriter != null) {
                try {
                    fileWriter.close();
                } catch (IOException e) {
                    System.out.println("Erreur à la fermeture du fichier");
                }
            }
        }
    }

    private void writeLine(Writer writer, List<String> values) throws IOException {
        char separator = ',';
        boolean first = true;

        StringBuilder builder = new StringBuilder();
        for (String value : values) {
            if (!first) {
                builder.append(separator);
            }

            builder.append(value);
            first = false;
        }
        builder.append("\n");

        writer.append(builder.toString());
    }

    private void writeUsers(List<User> users, FileWriter fileWriter) throws IOException {
        List<String> userLineValues = new ArrayList<>();

        for (User user : users) {
            Order order = user.getOrder();

            userLineValues.add( String.valueOf(order.getId()) );
            userLineValues.add( String.valueOf(order.getInvoice()) );
            userLineValues.add( order.getStartDate() );
            userLineValues.add( order.getEndDate() );
            userLineValues.add( user.getFirstname() );
            userLineValues.add( user.getLastname() );
            userLineValues.add( user.getMail() );

            writeLine(fileWriter, userLineValues);

            userLineValues.clear();
        }
    }
}