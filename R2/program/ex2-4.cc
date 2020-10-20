#include <iostream>
#include <map>

int main()
{
    std::map<double, int> fmap;
    fmap[80.00] = 21;
    fmap[82.50] = 33;
    fmap[86.66] = 44;

    std::cout << fmap[80.00] << std::endl;
    std::cout << fmap[82.50] << std::endl;
    std::cout << fmap[86.66] << std::endl;
    std::cout << fmap[92.13] << std::endl;
    // 未定義の要素に対しては, データのデフォルト値(int 型の場合は0) が返される

    std::map<double, int>::iterator p;
    for (p = fmap.begin(); p != fmap.end(); p++)
    {
        std::cout << p->first << ": " << p->second << std::endl;
    }

    double f;
    std::cin >> f;
    if ((p = fmap.find(f)) == fmap.end())
        std::cout << "not found" << std::endl;
    else
    {
        std::cout << p->first << ": " << p->second << std::endl;
        fmap.erase(p);
    }
    return 0;
}