#include <iostream>
#include <math.h>

int main()
{
    double h;
    double w;
    std::cout << "身長(cm)：";
    std::cin >> h;
    std::cout << "体重(kg)：";
    std::cin >> w;
    double bmi = w / pow((h / 100), 2);
    std::cout << "BMI：" << bmi << std::endl;
    return 0;
}