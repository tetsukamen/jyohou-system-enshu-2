#include <iostream>

int main()
{
    int *a = 0;
    a = new int;
    *a = 100;
    std::cout << *a << std::endl;
    delete a;
    return 0;
}