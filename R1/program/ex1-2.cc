#include <iostream>

void swap(int &x, int &y)
{
    int tmp = x;
    x = y;
    y = tmp;
}

int main()
{
    int a = 5;
    int b = 6;
    swap(a, b);
    std::cout << "a=" << a << std::endl;
    std::cout << "b=" << b << std::endl;
    return 0;
}