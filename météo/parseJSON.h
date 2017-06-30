#if defined(_WIN32) || defined(WIN32)

    #include <winsock2.h>
    #include <Ws2tcpip.h>
    #include <winsock.h>
    #include <MYSQL/mysql.h>
    typedef int socklen_t;

#elif defined (__linux) || defined (linux)

    #include <sys/types.h>
    #include <sys/socket.h>
    #include <netinet/in.h>
    #include <arpa/inet.h>
    #include <unistd.h>
    #include <netdb.h>
    #include <my_global.h>
    #include <mysql.h>

    #define INVALID_SOCKET -1
    #define SOCKET_ERROR -1
    #define closesocket(param) close(param)

    typedef int SOCKET;
    typedef struct sockaddr_in SOCKADDR_IN;
    typedef struct sockaddr SOCKADDR;

#endif
#include <time.h>

int parseJSON();
