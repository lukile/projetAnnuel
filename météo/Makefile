all: weather

weather: writeInfo.o readInfo.o parseJSON.o main.o
	gcc -I/usr/include/mysql -L/usr/include/mysql/ -lmysqlclient -o weather writeInfo.o readInfo.o parseJSON.o main.o

parseJSON.o: parseJSON.c parseJSON.h
	gcc -I/usr/include/mysql -L/usr/include/mysql/ -lmysqlclient -o parseJSON.o -c parseJSON.c -W -Wall

writeInfo.o: writeInfo.c writeInfo.h
	gcc -o writeInfo.o -c writeInfo.c -W -Wall

readInfo.o: readInfo.c readInfo.h
	gcc -I/usr/include/mysql -L/usr/include/mysql/ -lmysqlclient -o readInfo.o -c readInfo.c -W -Wall

main.o: main.c readInfo.h writeInfo.h
	gcc -I/usr/include/mysql -L/usr/include/mysql/ -lmysqlclient -o main.o -c main.c -W -Wall
clean:
	-rm -f *.o
