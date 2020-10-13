#include <iostream>

inline int max(int a, int b) { return a > b ? a : b; }

int main()
{
    int x = 2, y = 3, z;
    z = max(x + 2, y) + 3;
    std::cout << "z=" << z << std::endl;
    return 0;
}