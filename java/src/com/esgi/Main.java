package com.esgi;

import com.esgi.database.DatabaseManager;
import com.esgi.database.UserRepository;
import com.esgi.service.CsvExporter;
import com.esgi.service.ExportManager;
import com.esgi.service.TimerService;

import java.sql.SQLException;
import java.util.TimerTask;

public class Main {

    public static void main(String[] args) throws SQLException {
        DatabaseManager databaseManager = new DatabaseManager();
        UserRepository userRepository = new UserRepository(databaseManager);

        CsvExporter csvExporter = new CsvExporter();
        ExportManager exportManager = new ExportManager(csvExporter, userRepository);

        TimerTask task = new TimerTask() {
            @Override
            public void run() {
                exportManager.export();
            }
        };
        TimerService.schedule(task);
    }
}
