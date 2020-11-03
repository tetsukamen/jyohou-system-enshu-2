#include <iostream>
#include <assert.h>

class stack
{
private:
    int sp;
    int max;
    int *data;

public:
    stack(int sz = 100) : sp(0), max(sz)
    {
        data = new int[max];
    }
    stack(const stack &);
    ~stack() { delete[] data; }
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
    void dump(std::ostream &);
    stack &operator=(const stack &);
    stack plus1(stack, stack);
};

class stack_ac : public stack
{
private:
    int push_count;
    int pop_count;

public:
    stack_ac() {}
    stack_ac(int sz = 100) : stack(sz)
    {
        push_count = 0;
        pop_count = 0;
    }
    ~stack_ac() {}
    int n_push() { return push_count; }
    int n_pop() { return pop_count; }
    void push(int d)
    {
        stack::push(d);
        push_count++;
    }
    void pop()
    {
        stack::pop();
        pop_count++;
    }
};

int main()
{
    stack_ac s(5);

    std::cout << "n_push:" << s.n_push() << std::endl;
    std::cout << "n_pop:" << s.n_pop() << std::endl;
    s.push(1);
    s.push(3);
    s.push(5);
    std::cout << "n_push:" << s.n_push() << std::endl;
    std::cout << "n_pop:" << s.n_pop() << std::endl;
    s.pop();
    s.pop();
    s.pop();
    std::cout << "n_push:" << s.n_push() << std::endl;
    std::cout << "n_pop:" << s.n_pop() << std::endl;

    return 0;
}