#include <iostream>
#include <string>

class car
{
public:
    std::string model;
    std::string maker;
    int displacement;
    int ps;
    int weight;
    car() {}
    car(const std::string &md, const std::string &mk, int dp, int p, int w) : model(md), maker(mk), displacement(dp), ps(p), weight(w)
    {
        std::cout << "car_constracter" << std::endl;
    }
    ~car() { std::cout << "car_deconstracter" << std::endl; }
    int no() const
    {
        if (displacement < 2000)
            return 5;
        else
            return 3;
    }
    double pwratio() const { return (double)weight / (double)ps; }
    int tax() const
    {
        if (weight < 1300)
            return 34000;
        else
            return 43000;
    }
};

class hybrid_car : public car
{
public:
    int motor_ps;

public:
    hybrid_car() {}
    hybrid_car(const std::string &md, const std::string &mk, int dp, int p, int w, int mps) : car(md, mk, dp, p, w), motor_ps(mps)
    {
        std::cout << "hybrid_car_constracter" << std::endl;
    }
    ~hybrid_car() { std::cout << "hybrid_car_deconstracter" << std::endl; }

    double pwratio() const { return (double)weight / (double)(ps + motor_ps); }
    int tax() const { return car::tax() - 10000; }
};

int main()
{
    car a = car("Skyline", "Nissan", 2987, 260, 1490);
    car b = car("Accord", "Honda", 1997, 180, 1290);
    hybrid_car h = hybrid_car("Prius", "Toyota", 1498, 60, 1235, 20);

    std::cout << a.model << "  "
              << a.no() << "  "
              << a.pwratio() << "  "
              << a.tax() << std::endl;

    std::cout << b.model << "  "
              << b.no() << "  "
              << b.pwratio() << "  "
              << b.tax() << std::endl;

    std::cout << h.model << " "
              << h.no() << " "
              << h.pwratio() << " "
              << h.tax() << std::endl;

    return 0;
}
