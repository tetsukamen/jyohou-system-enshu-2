#include <iostream>
#include <string>
#include <list>

class Record
{
public:
    int id;
    std::string name;
    int score;
    Record() {}
    Record(int i, const std::string &nm, int s)
    {
        id = i;
        name = nm;
        score = s;
    }
};

std::ostream &operator<<(std::ostream &os, const Record &r)
{
    os << "[" << r.id << "] " << r.name << " : " << r.score;
    return os;
}

class Seiseki
{
public:
    std::list<Record> data;
    void insert(int, const std::string &, int);
    void lookup(int);
    void erase_worst();
};

std::ostream &operator<<(std::ostream &os, const Seiseki &s)
{
    os << "*** Seiseki ***\n";
    for (std::list<Record>::const_iterator p = s.data.begin(); p != s.data.end(); p++)
    {
        os << *p << "\n";
    }
    return os;
}

void Seiseki::insert(int id, const std::string &nm, int s)
{
    data.push_back(Record(id, nm, s));
}

void Seiseki::lookup(int id)
{
    int flag = 0;
    Record find;
    std::list<Record>::iterator p;
    for (p = data.begin(); p != data.end(); p++)
    {
        if ((*p).id == id)
        {
            find = *p;
            flag = 1;
        }
    }
    if (flag == 1)
    {
        std::cout << find << std::endl;
    }
    else
    {
        std::cout << "not found" << std::endl;
    }
}

void Seiseki::erase_worst()
{
    int worstScore = 200;
    int worstId;
    std::list<Record>::iterator p;
    for (p = data.begin(); p != data.end(); p++)
    {
        if (p->score < worstScore)
        {
            worstScore = p->score;
            worstId = p->id;
        }
    }
    for (p = data.begin(); p != data.end(); p++)
    {
        if (p->id == worstId)
        {
            data.erase(p);
        }
    }
}

int main(int ac, char **av)
{
    Seiseki s;
    s.insert(7001, "aaaa", 89);
    s.insert(7123, "bbbb", 70);
    s.insert(7013, "cccc", 55);
    s.insert(7200, "dddd", 99);
    s.insert(7087, "eeee", 83);

    std::cout << s;

    int id;
    std::cout << "> ";
    std::cin >> id;
    while (id != 0)
    {
        s.lookup(id);
        std::cout << "> ";
        std::cin >> id;
    }

    s.erase_worst();
    std::cout << s;

    return 0;
}
