#include <iostream>

int add(int a, int b) { return a + b; }
int add(int a, int b, int c) { return a + b + c; }
double add(double a, double b) { return a + b; }

int main()
{
    int x = 3, y = 4, z = 5;
    double p = 3.14, q = 2.44;
    std::cout << add(x, y) << std::endl;
    std::cout << add(x, y, z) << std::endl;
    std::cout << add(p, q) << std::endl;
}