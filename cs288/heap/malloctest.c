#include <stdlib.h>
#include <string.h>
#include <stdio.h>
#include "memlist.h"

char *try(int,char);

#define SIZE 1000
main(){
	char *ret[10], *mem, *cp;
	int i=0;
	
	mem=malloc(SIZE+1);
	for(cp=mem;cp<mem+SIZE;cp++)
		*cp='x';
	*cp='\0';

	myinit(mem,SIZE);
	
	ret[0]=try(100,'a');
	ret[1]=try(200,'b');
	ret[2]=try(600,'c');
	ret[3]=try(200,'d');
	fprintf(stderr,"calling free\n");
	myfree(ret[0]);
	myfree(ret[1]);
	ret[3]=try(300,'e');
	dumpmem(mem);
	fprintf(stderr,"exit\n");
}

char *try(int x,char c){
	char *ret;

	fprintf(stderr,"mymalloc  %d, of %c\n",x, c);
	if(!(ret=mymalloc(x,c)))
		fprintf(stderr,"failed \n");
	else
		fprintf(stderr,"succeeded \n");
	fprintf(stderr,"returning %x\n",ret);
	return(ret);
}

dumpmem(char *cp)
{
	static int i;

	for(i=0;i<SIZE+1;i++,cp++)
		putchar(*cp);
	
	printf("\n");
}
