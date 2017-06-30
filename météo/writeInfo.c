#include "writeInfo.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int findcontentlen(char *buffer)
{
    char * a= "Content-Length: ";
    char * b= "Connection: ";
    char *position1 = NULL;
    char *position2 = NULL;
    char *stringcontentlen = NULL;
    int i;
    int contentlen = 0;
    int contentstringlen = 0;

    position1 = strstr(buffer, a);
    if( position1 == NULL )
    {
        fprintf(stderr,"\nERROR, can't find the string a");
        return -1;
    }

    position2 = strstr(buffer, b);
    if( position2 == NULL )
    {
        fprintf(stderr,"\nERROR, can't find the string b");
        return -1;
    }

    contentstringlen = position2 - (position1 + strlen(a) + 2);

    stringcontentlen = malloc(sizeof(char) * (contentstringlen + 1));
    if( stringcontentlen == NULL )
    {
        fprintf(stderr,"\nERROR, can't create the string content length");
        return -1;
    }

    for (i = 0; i < contentstringlen; i++)
        stringcontentlen[i] =  *(position1 + strlen(a) + i);

    stringcontentlen[contentstringlen] = '\0';
    contentlen = atoi(stringcontentlen);
    free(stringcontentlen);

    return contentlen;
}

int filterinf(char *buffer, char *filteredInf)
{
    int i=0;
    int j = 0;
    int start_writing = FALSE;
    int contentlen = 0;

    contentlen = findcontentlen( buffer );
    if( contentlen == -1)
        return -1;

    while(j < contentlen)
    {
        if(buffer[i] == '{')
            start_writing = TRUE;

        if(start_writing == TRUE)
        {
            filteredInf[j] = buffer[i];
            j++;
        }
        i++;
    }

    if(filteredInf[contentlen - 1] != '}')
    {
        fprintf(stderr,"\nERROR, in the data");
        return -1;
    }
    filteredInf[contentlen] = '\0';

    return 0;
}

int writeInfo(char *buffer)
{
    char filteredInf[API_SIZE];
    FILE * weather = NULL;

    if(filterinf(buffer, filteredInf) == -1)
        return -1;

    //printf("\n\n%s",filteredInf);
    weather = fopen("weather.json", "w");
    if(weather == NULL)
    {
        fprintf(stderr,"\nERROR, cannot create the weather file");
        return -1;
    }
    if(fwrite(filteredInf, 1, strlen(filteredInf), weather) < strlen(filteredInf))
    {
        fprintf(stderr,"\nERROR, the weather file wasn't write properly");
        return -1;
    }
    fclose(weather);
    fprintf(stdout,"\nThe weather.json was created properly");
    return 0;
}
