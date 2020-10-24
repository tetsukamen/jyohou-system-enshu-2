#include <iostream>
#include <string>

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
    Complex &operator=(const Complex &);
    Complex &operator+=(const Complex &);
};

Complex &Complex::operator=(const Complex &c)
{
    real = c.real;
    imag = c.imag;
    return *this;
}

Complex &Complex::operator+=(const Complex &c)
{
    real += c.real;
    imag += c.imag;
    return *this;
}

int main()
{
    Complex a = Complex(2, 3);
    Complex b;
    b = a;
    b.print(std::cout);
    std::cout << std::endl;
    b += b;
    b.print(std::cout);
    std::cout << std::endl;
    return 0;
}