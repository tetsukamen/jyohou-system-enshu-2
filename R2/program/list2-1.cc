#include <iostream>
#include <string>

int main()
{
    std::string message;
    std::string s;
    message = "Enter strings";
    std::cout << message << ": ";
    std::cin >> s;
    std::cout << "word 1 = " << s << std::endl;
    std::cin >> s;
    std::cout << "word 2 = " << s << std::endl;
    getline(std::cin, s);
    std::cout << "line = "
              << " ’ " << s << " ’ " << std::endl;
    getline(std::cin, s);
    std::cout << "line = "
              << " ’ " << s << " ’ " << std::endl;
    return 0;
}