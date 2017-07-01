package com.esgi.service;

import com.esgi.database.User;
import com.esgi.database.UserRepository;

import java.time.LocalDate;
import java.time.Month;
import java.time.temporal.ChronoField;
import java.time.temporal.ChronoUnit;
import java.util.List;
import java.util.TimerTask;

public class ExportManager {

    private final String POSTFIX_FILENAME = "_compta.csv";
    private final CsvExporter csvExporter;
    private final UserRepository userRepository;

    public ExportManager(CsvExporter csvExporter,
                         UserRepository userRepository) {
        this.csvExporter = csvExporter;
        this.userRepository = userRepository;
    }

    public void export() {
        String year = getYearOfLastMonth();
        String month = getLastMonth();

        List<User> users = userRepository.findUsers(year, month);

        //users.forEach(System.out::println);

        String filename = year + "-" + month + POSTFIX_FILENAME;
        csvExporter.export(users, filename);
    }

    private String getYearOfLastMonth() {
        LocalDate lastMonthDate = getLastMonthDate();

        return String.valueOf(lastMonthDate.get(ChronoField.YEAR));
    }

    /**
     * month.getValue() is "zero based", january is 0, february is 1 ...
     * it explains the "month.getValue() + 1" to match human readable month
     */
    private String getLastMonth() {
        LocalDate lastMonthDate = getLastMonthDate();
        Month month = lastMonthDate.getMonth();

        return String.valueOf( month.getValue() + 1 );
    }

    private LocalDate getLastMonthDate() {

        return LocalDate.now().minus(1, ChronoUnit.MONTHS);
    }

}
