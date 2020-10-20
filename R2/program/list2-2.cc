#include <iostream>
#include <string>

int main()
{
    std::string a = "Osaka ";
    std::string b = "Prefectural ";
    std::string c = "Uniersity";
    std::string p, q, r;
    p = a + c;
    q = a + b + c;
    r = a;
    r += c;
    std::cout << "p=" << p << std::endl;
    std::cout << "q=" << q << std::endl;
    std::cout << "r=" << r << std::endl;
    if (p == q)
        std::cout << "p==q" << std::endl;
    else if (p < q)
        std::cout << "p<q" << std::endl;
    else
        std::cout << "p>q" << std::endl;
    if (p == r)
        std::cout << "p==r" << std::endl;
    else if (p < r)
        std::cout << "p<r" << std::endl;
    else
        std::cout << "p>r" << std::endl;
    return 0;
}