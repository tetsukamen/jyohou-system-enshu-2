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

int main()
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
        /* *** 大阪の局番4 桁化 *** */
        if (e[i].phone.substr(0, 2) == "06")
        {
            e[i].phone.replace(0, 3, "06-6");
        }
    }
    std::cout << "directory service: ";
    /* *** 文字列を入力し, その電話番号を検索し, 出力 *** */
    std::string s;
    getline(std::cin, s);
    for (int i = 0; i < n; i++)
    {
        if (e[i].name == s || e[i].phone == s)
        {
            std::cout << e[i] << std::endl;
        }
    }
    return 0;
}