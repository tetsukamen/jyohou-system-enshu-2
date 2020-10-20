#include <iostream>
#include <string>
#include <vector>
#include <algorithm>

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

class by_name
{
public:
    bool operator()(const Entry &e1, const Entry &e2) const
    {
        return e1.name < e2.name;
    }
};

class by_phone
{
public:
    bool operator()(const Entry &e1, const Entry &e2) const
    {
        return e1.phone < e2.phone;
    }
};

int main()
{
    std::vector<Entry> e(10);
    e.push_back(Entry("university of tokyo", "03-3812-2111"));
    e.push_back(Entry("osaka university", "06-879-7806"));
    e.push_back(Entry("kinki university", "06-721-2332"));
    e.push_back(Entry("osaka prefectural university", "0722-52-1161"));
    e.push_back(Entry("kyoto university", "075-753-7531"));
    for (int i = 0; i < e.size(); i++)
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
    for (int i = 0; i < e.size(); i++)
    {
        if (e[i].name == s || e[i].phone == s)
        {
            std::cout << e[i] << std::endl;
        }
    }
    sort(e.begin(), e.end(), by_name());
    for (int i = 0; i < e.size(); i++)
    {
        std::cout << e[i] << std::endl;
    }
    sort(e.begin(), e.end(), by_phone());
    for (int i = 0; i < e.size(); i++)
    {
        std::cout << e[i] << std::endl;
    }
    return 0;
}