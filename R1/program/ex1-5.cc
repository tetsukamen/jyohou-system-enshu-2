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
    friend bool equal(const stack &, const stack &);
    stack(int sz = 100)
    {
        sp = 0;
        max = sz;
        data = new int[max];
    }
    ~stack() { delete[] data; }
};

bool equal(const stack &s1, const stack &s2)
{
    bool eq = true;
    if (s1.sp != s2.sp)
        eq = false;
    else
    {
        for (int j = 0; j < s1.sp && eq; j++)
        {
            if (s1.data[j] != s2.data[j])
                eq = false;
        }
    }
    return eq;
}

int main()
{
    stack s1, s2;
    s1.push(5);
    s1.push(8);
    s1.push(9);
    s2.push(5);
    s2.push(8);
    s2.push(9);
    s2.push(10);
    std::cout << equal(s1, s2) << std::endl;
    s2.pop();
    std::cout << equal(s1, s2) << std::endl;
    return 0;
}