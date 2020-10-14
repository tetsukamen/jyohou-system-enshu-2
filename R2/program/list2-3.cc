#include <iostream>
#include <string>

class Entry
{
public:
    std::string name;
    std::string phone;
    Entry(const std::string &nm = "", const std::string &ph = "")
    {
        name = nm;
        phone = ph;
    }
};

std::ostream &operator<<(std::ostream &os, const Entry &e)
{
    os << e.name << ": " << e.phone;
    return os;
}

int main(int ac, char **av)
{
    Entry e[10];
    int n = 0;
    e[n++] = Entry("university of tokyo", "03-3812-2111");
    e[n++] = Entry("osaka university", "06-879-7806");
    e[n++] = Entry("kinki university", "06-721-2332");
    e[n++] = Entry("osaka prefectural university", "0722-52-1161");
    e[n++] = Entry("kyoto university", "075-753-7531");
    for (int i = 0; i < n; i++)
    {
        //
        // 络哄の渡戎の 4 峰步
        //
    }
    std::cout << "directory service: ";
    //
    // 矢机误を掐蜗し, その排厦戎规を浮瑚し, 叫蜗
    //
    return 0;
}
