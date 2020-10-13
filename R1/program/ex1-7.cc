#include <iostream>

class Complex
{
private:
    double real;
    double imag;

public:
    Complex()
    {
        real = 0.0;
        imag = 0.0;
    }
    Complex(double r)
    {
        real = r;
        imag = 0.0;
    }
    Complex(double r, double i)
    {
        real = r;
        imag = i;
    }
    ~Complex() {}
    double re() { return real; }
    double im() { return imag; }
    void set_re(double r) { real = r; }
    void set_im(double i) { imag = i; }
    void print(std::ostream &os) { os << real << "+" << imag << "i"; }
};

Complex operator+(Complex a, Complex b)
{
    double r = a.re() + b.re();
    double i = a.im() + b.im();
    return Complex(r, i);
}

Complex operator-(Complex a, Complex b)
{
    double r = a.re() - b.re();
    double i = a.im() - b.im();
    return Complex(r, i);
}

Complex operator*(Complex a, Complex b)
{
    double r = a.re() * b.re() + a.im() * b.im();
    double i = a.re() * b.im() + a.im() * b.re();
    return Complex(r, i);
}

int main()
{
    Complex a(1.11, 2.22);
    Complex b(3.33, 4.44);
    Complex c;
    c = a + b;

    std::cout << "a+b=";
    c.print(std::cout);
    std::cout << std::endl;

    c = b - a;
    std::cout << "b-a=";
    c.print(std::cout);
    std::cout << std::endl;

    c = a * b;
    std::cout << "a*b=";
    c.print(std::cout);
    std::cout << std::endl;

    return 0;
}