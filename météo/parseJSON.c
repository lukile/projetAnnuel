#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "parseJSON.h"

int parseJSON(){


    FILE* WeatherJSON = fopen("weather.json", "r");
    int jump = 0;
    if(WeatherJSON == NULL)
    {
        fprintf(stderr,"\nERROR, \ncannot open the weather file");
        return -1;
    }
    char weather[4] = "", temp_now[7] = "", pressure[5] = "", humidity[3] = "", temp_min[7] = "", temp_max[7] = "",
        visibility[6] = "", wind_speed[4] = "", wind_degree[4] = "", sun_sunrise[11] = "", sun_sunset[11] = "", lecture[100];

    fseek(WeatherJSON, 0, SEEK_SET);

    fseek(WeatherJSON, 51, SEEK_CUR);
    fread(weather, 3, 1, WeatherJSON);
    char actual_char = "";

    while(jump < 5){
        actual_char = fgetc(WeatherJSON);
        if(actual_char == ','){
            jump++;
        }
    }
    jump = 0;
    while(jump < 2){
        actual_char = fgetc(WeatherJSON);
         if(actual_char == ':'){
            jump++;
        }
    }

    int i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != ',')
    {
        temp_now[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    while(actual_char != ':'){
        actual_char = fgetc((WeatherJSON));
    }

    i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != ',')
    {
        pressure[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    while(actual_char != ':'){
        actual_char = fgetc((WeatherJSON));
    }
     i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != ',')
    {
        humidity[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

     while(actual_char != ':'){
        actual_char = fgetc((WeatherJSON));
    }
     i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != ',')
    {
        temp_min[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    while(actual_char != ':'){
        actual_char = fgetc((WeatherJSON));
    }
     i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != '}')
    {
        temp_max[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    while(actual_char != ':'){
        actual_char = fgetc((WeatherJSON));
    }
    i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != ',')
    {
        visibility[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    jump = 0;
    while(jump < 2){
        actual_char = fgetc(WeatherJSON);
         if(actual_char == ':'){
            jump++;
        }
    }
    i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != ',')
    {
        wind_speed[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    while(actual_char != ':'){
        actual_char = fgetc((WeatherJSON));
    }
    i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != '}')
    {
        wind_degree[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

     jump = 0;
    while(jump < 9){
        actual_char = fgetc(WeatherJSON);
         if(actual_char == ':'){
            jump++;
        }
    }
    i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != ',')
    {
        sun_sunrise[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    while(actual_char != ':'){
        actual_char = fgetc((WeatherJSON));
    }
    i = 0;
    actual_char = fgetc(WeatherJSON);
    while(actual_char != '}')
    {
        sun_sunset[i] = actual_char;
        actual_char = fgetc(WeatherJSON);
        i++;
    }

    fclose(WeatherJSON);

    MYSQL sql;
    mysql_init(&sql);
    mysql_options(&sql,MYSQL_READ_DEFAULT_GROUP,"option");
    if(mysql_real_connect(&sql,"127.0.0.1","root","","aen",0,NULL,0))
    {
          char marequete[600] = "";
          //On stock la requete dans notre tableau de char
          sprintf(marequete, "UPDATE meteo SET weather = '%s', tempnow = '%s', pressure = '%s', humidity ='%s', tempsmin = '%s', tempsmax = '%s', visibility = '%s', windspeed = '%s', winddegree = '%s', sunrise = '%s', sunset= '%s' WHERE iDMeteo = 1;"
                  ,weather,temp_now,pressure,humidity,temp_min,temp_max,visibility,wind_speed,wind_degree,sun_sunrise,sun_sunset);
          printf("\nSuccessful update of weather");
          //On execute la requete
          mysql_query(&sql, marequete);
          mysql_close(&sql);
    }
    else
    {
        printf("\nError, \ncannot connect to the database.");
    }
}
