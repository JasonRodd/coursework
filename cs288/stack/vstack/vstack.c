#include <stdlib.h>
#include <stdio.h>
#include <string.h>

#define SIZE 10

typedef struct {
        char fill;
		int size;
		char name[8];
}frame;

main()
{
	frame *p;
	frame 	*q;
	int ch;
	int length;
	char cmd[10];

	p = (frame *)malloc(SIZE*sizeof(frame));
	q = p;
	
	if(p==NULL){
		fprintf(stderr,"cannot allocate any more memory\n");
		exit(-1);
	}
	
	while(scanf("%s", cmd)!=EOF) /* doesn't check for cmd too big */
		if(!strcmp(cmd,"POP")){
			p--;
			if(p<q){
				fprintf(stderr,"underflow\n");
				exit(-2);
			}
			
			int L = p->size;
			int i;
			for(i=1; i < L; i++){
				p--;
				if(p<q){
					fprintf(stderr,"underflow\n");
					exit(-2);
				}
			}
			

		} else {
			scanf("%d",&length);
			scanf("%s",&ch);	

			
			int i;
			for(i=0; i < length; i++){
				p->fill=ch;
				p->size=length;
				
				if(p-q>SIZE-1){
					fprintf(stderr,"overflow\n");
					exit(-3);
				}
				
				p++;
				
			}

		}
	while(q<p){
		printf("%c\n",q->fill);
		*q++;
	}
}