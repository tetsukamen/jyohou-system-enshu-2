#include <iostream>
#include <assert.h>

class stack
{
private:
    int max;
    int *data;
    int sp;

public:
    bool empty() { return sp == 0; }
    void push(int d)
    {
        assert(sp <= max);
        data[sp++] = d;
    }
    int top() { return data[sp - 1]; }
    void pop()
    {
        assert(0 < sp);
        --sp;
    }
    int size() { return sp; }
    stack(int sz = 100)
    {
        sp = 0;
        max = sz;
        data = new int[max];
        std::cout << "max=" << max << std::endl;
    }
    ~stack() { delete[] data; }
};

int main()
{
    stack s(45);
    s.push(5);
    s.push(8);
    s.push(9);
    std::cout << s.top() << std::endl;
    s.pop();
    std::cout << s.top() << std::endl;
    s.pop();
    s.push(3);
    std::cout << s.size() << std::endl;
    while (!s.empty())
    {
        std::cout << s.top() << std::endl;
        s.pop();
    }
    return 0;
}