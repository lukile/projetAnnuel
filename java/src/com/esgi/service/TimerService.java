package com.esgi.service;

import java.util.Timer;
import java.util.TimerTask;

public class TimerService {

    public static void schedule(TimerTask task) {
        int waitFiveSeconds = 5 * 1000;
        int eachMinute = 60 * 1000;

        Timer timer = new Timer();
        timer.schedule(task, waitFiveSeconds, eachMinute);
    }
}
