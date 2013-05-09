#include <QtCore/QCoreApplication>

#include <iostream>

#include "printer.h"

int main(int argc, char *argv[])
{
    QCoreApplication a(argc, argv);

    Printer *p = new Printer();
    std::cout << "Trying to open port" << std::endl;

    bool res = p->open("/dev/ttyAMA0");
    std::cout << "Status: " << res << std::endl;

    if (!res) {
        std::cerr << "Error opening port, aborting" << std::endl;
        return (0);
    }

    p->init();

   char tmp[256]={0x0};
   while(fgets(tmp, sizeof(tmp), stdin)!=NULL)
   {
       printf("%s", tmp);
   }

    p->write(tmp);
    p->write("\n");
    p->write("\n");
    std::cout << "Closing Device" << std::endl;
    p->close();

    return 1;

    return a.exec();
}
