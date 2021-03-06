#include "writeInfo.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int findcntlght(char *buffer)
{
    char * a= "Content-Length: ";
    char * b= "Connection: ";
    char *pst_1 = NULL;
    char *pst_2 = NULL;
    char *strcntlght = NULL;
    int i;
    int cntlght = 0;
    int contentstringlen = 0;

    pst_1 = strstr(buffer, a);
    if( pst_1 == NULL )
    {
        fprintf(stderr,"\nERROR, \ncan't find the string a");
        return -1;
    }

    pst_2 = strstr(buffer, b);
    if( pst_2 == NULL )
    {
        fprintf(stderr,"\nERROR, \ncan't find the string b");
        return -1;
    }

    contentstringlen = pst_2 - (pst_1 + strlen(a) + 2);

    strcntlght = malloc(sizeof(char) * (contentstringlen + 1));
    if( strcntlght == NULL )
    {
        fprintf(stderr,"\nERROR, \ncan't create the string content length");
        return -1;
    }

    for (i = 0; i < contentstringlen; i++)
        strcntlght[i] =  *(pst_1 + strlen(a) + i);

    strcntlght[contentstringlen] = '\0';
    cntlght = atoi(strcntlght);
    free(strcntlght);

    return cntlght;
}

int filterinf(char *buffer, char *filteredInf)
{
    int i=0;
    int j = 0;
    int start_writing = FALSE;
    int cntlght = 0;

    cntlght = findcntlght( buffer );
    if( cntlght == -1)
        return -1;

    while(j < cntlght)
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

    if(filteredInf[cntlght - 1] != '}')
    {
        fprintf(stderr,"\nERROR, in the data");
        return -1;
    }
    filteredInf[cntlght] = '\0';

    return 0;
}

int writeInfo(char *buffer)
{
    char filteredInf[API_SIZE];
    FILE * weather = NULL;

    if(filterinf(buffer, filteredInf) == -1)
        return -1;

    weather = fopen("weather.json", "w");
    if(weather == NULL)
    {
        fprintf(stderr,"\nERROR, \ncannot create the weather file");
        return -1;
    }
    if(fwrite(filteredInf, 1, strlen(filteredInf), weather) < strlen(filteredInf))
    {
        fprintf(stderr,"\nERROR, \nthe weather file wasn't write properly");
        return -1;
    }
    fclose(weather);
    fprintf(stdout,"\nThe weather.json was created properly");
    return 0;
}
