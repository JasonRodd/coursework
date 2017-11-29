#include "Value.h"
#include <iostream>
using namespace std;

ostream&operator<<(ostream& out, Value& v)
	{
		if(v.getType() == INTEGER){
			out << v.getIvalue() << endl;
		} else {
			out << v.getSvalue() << endl;
		}
	        return out;
	}
