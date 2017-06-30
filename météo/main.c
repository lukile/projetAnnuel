#include "readInfo.h"
#include "writeInfo.h"
#include "parseJSON.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(void)
{

    char buffer[BUFFER_SIZE];
    memset(buffer, '\0', BUFFER_SIZE);

    if(readInfo(buffer) == -1)
        return EXIT_FAILURE;

    if(writeInfo(buffer) == -1)
        return EXIT_FAILURE;

    parseJSON();

    return EXIT_SUCCESS;
}
