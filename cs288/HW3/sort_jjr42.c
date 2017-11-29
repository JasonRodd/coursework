#include <stdio.h>

int main( int argc, char *argv[] )  {


int i = 0;
int j = 0;
int number = 0;
int last = -999999;

for(i=1; i < argc; i++){
	int lowest = 999999;
	
	for(j=1; j < argc; j++){
		number = atoi(argv[j]);
		if(number < lowest && number > last){
			lowest = number;
		}
	}
	last = lowest;
	printf("%d ", lowest);
}


printf("\n");
printf("done");

return 0;
}
