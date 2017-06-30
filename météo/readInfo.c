#include "readInfo.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#if defined(_WIN32) || defined(WIN32)
const char* inet_ntop(int af, const void* src, char* dst, int cnt){

    struct sockaddr_in srcaddr;

    memset(&srcaddr, 0, sizeof(struct sockaddr_in));
    memcpy(&(srcaddr.sin_addr), src, sizeof(srcaddr.sin_addr));

    srcaddr.sin_family = af;
    if (WSAAddressToString((struct sockaddr*) &srcaddr, sizeof(struct sockaddr_in), 0, dst, (LPDWORD) &cnt) != 0) {
        DWORD rv = WSAGetLastError();
        printf("WSAAddressToString() : %d\n",rv);
        return NULL;
    }
    return dst;
}
#endif
int findip(char *ip, int iplen, char *host)
{
    struct hostent *server;

    server = gethostbyname(host); // r�cup�re l'addresse IP en utilisant le nom de domaine

    if (server == NULL)
    {
        fprintf(stderr,"ERROR, no such host");
        return -1;
    }

    inet_ntop(AF_INET,(void *)server->h_addr_list[0], ip, iplen); // conversion de server en cha�ne de caract�re
    return 0;
}

int readInfo(char *buffer)
{
    #if defined(_WIN32) || defined(WIN32)
        WSADATA WSAData;
        WSAStartup(MAKEWORD(2,2), &WSAData);
    #endif

    SOCKET sock;
    SOCKADDR_IN sin;
    //FILE* log = NULL; // fichier pour enregistrer les donn�es re�ues.
    char *host = "api.openweathermap.org";
    char *api = "GET /data/2.5/weather?id=3019265&APPID=7ebcbda2434ee5db9e25c2b1ae8e6d99 HTTP/1.0\r\n\r\n";
    int iplen = 15; //XXX.XXX.XXX.XXX
    char *ip = NULL;

    ip = malloc(sizeof(char) * (iplen+1));
    if (ip == NULL)
    {
        fprintf(stderr,"ERROR, cannot create ip string");
        return -1;
    }
    memset(ip, 0, iplen+1);

    if( findip(ip, iplen, host) != 0)
        return -1;

    sock = socket(AF_INET, SOCK_STREAM, 0); //cr�ation du socket
    if(sock == SOCKET_ERROR)
    {
        fprintf(stderr,"ERROR, cannot create socket");
        return -1;
    }
    sin.sin_addr.s_addr = inet_addr(ip);
    sin.sin_family = AF_INET;
    sin.sin_port = htons(80); // port HTTP.

    if(connect(sock, (SOCKADDR*)&sin, sizeof(sin)) != SOCKET_ERROR)
        printf("Connexion to %s on port %d\n", inet_ntoa(sin.sin_addr), htons(sin.sin_port));
    else
        fprintf(stderr,"ERROR, Unable to connect");

    send(sock, api, strlen(api), 0); // on envoie la requ�te HTTP.

    //test
    /*log = fopen("test.txt","w");
    if(log == NULL)
    {
        fprintf(stderr,"ERROR, cannot create the log file");
        return -1;
    }*/

    if (recv(sock, buffer, BUFFER_SIZE, 0) != 0) // si le buffer re�oit des donn�es.
    {
        printf("%s",buffer);
	printf("\nout of buffer\n");
        //fwrite(buffer, 1, BUFFER_SIZE, log); // enregistrement des donn�es dans le fichier.
        MYSQL sql;
        mysql_init(&sql);
	printf("\ninit\n");
        mysql_options(&sql,MYSQL_READ_DEFAULT_GROUP,"option");
	printf("\noption\n");
        if(mysql_real_connect(&sql,"127.0.0.1","root","","aen",0,NULL,0))
        {
            mysql_query(&sql,"SELECT * FROM meteo ORDER BY iDMeteo DESC");
            MYSQL_RES *monid = NULL, *resultat = NULL;
            MYSQL_ROW row;
            monid = mysql_store_result(&sql);
            row = mysql_fetch_row(monid);
            printf("\nInformation meteo\n\n iDBdd : %s\n iD Weather : %s\n Temperature actuelle : %s\n Pression : %s\n Humidite : %s\n Temperature minimum : %s\n Temperature maximal : %s\n Visibilite : %s\n Vitesse du vent : %s\n Temperature du vent : %s\n Heure de levee du soleil : %s\n Heure du couchee du soleil : %s\n ",
                   row[0],row[1],row[2],row[3],row[4],row[5],row[6],row[7],row[8],row[9],row[10],row[11]);
            mysql_free_result(monid);
            mysql_close(&sql);
        }
        else
        {
            printf("Une erreur � eu lieu lors de la connection sur la base de donn�e.");
        }
    }
    else
        printf("ERROR, cannot read the buffer");

    //fclose(log);
    free(ip);
    ip = NULL;
    closesocket(sock); // on ferme le socket.

    #if defined(_WIN32) || defined(WIN32)
        WSACleanup();
    #endif

    return 0;
}
