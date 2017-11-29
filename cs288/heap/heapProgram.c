#include <stdlib.h>
#include <string.h>
#include <stdio.h>
#include "memlist.h"

int SIZE;
char *MEMORY;

list *root;

char *start, *finish;

void myinit(char *mem, int size){
	SIZE = size;
	MEMORY = mem;
	root=(list *)malloc(sizeof(list));
	root->addr = NULL;
}

char *mymalloc(int size, char fill){
	int i;
	int bestPosition=0;
	int bestPositionSize=SIZE;
	int currentAvail = 0;
	char *m, *B, *BestSpot;
	m = MEMORY;
	B = BestSpot = m;
	
	i = 0;
	while(*m != 'x'){
		m++;
		i++;
		B = BestSpot = m;
		bestPositionSize--;
	}
	
	
	if(bestPositionSize < size){
		return NULL;
	}
	
	for(i=i;i < SIZE; i++){
		if(*m == 'x'){
			currentAvail++;
		} else {
			if(currentAvail >= size){
				if(currentAvail < bestPositionSize){
					B = (m-currentAvail);
					BestSpot = B;
					bestPositionSize = currentAvail;
					bestPosition = (i-currentAvail);
				}
				currentAvail = 0;
			}
		}
		m++;
	}
	if(currentAvail >= size){
		if(currentAvail < bestPositionSize){
			B = (m-currentAvail);
			BestSpot = B;
			bestPositionSize = currentAvail;
			bestPosition = (i-currentAvail);
		}
	}
	currentAvail = 0;

	
	for(i=0; i < size; i++){
		*B = (char) fill;
		B++;
	}
	
	
	list *L;
	L=(list *)malloc(sizeof(list));
	L->addr = BestSpot;
	L->sizeOf = size;
	append(root, L);
	
	return BestSpot;

}

void myfree(char *ptr){

	
	list *Q;
	Q = (list *)malloc(sizeof(list));
	Q = delete(root, ptr);
	
	int i;
	for(i=0; i < Q->sizeOf; i++){
		*ptr = 'x';
		ptr++;
	}

	
}

list *find(list *lp, char *addr){
	
	while(lp->ptr!=NULL){
		if(lp->addr == addr){
			return lp;
		}
		lp=lp->ptr;
	}
	return NULL;
}


list *append(list *lp, list *newp){

	while(lp->ptr!=NULL){
		lp=lp->ptr;
	}
	lp->ptr=newp;
}

list *delete(list *lp, char *addr){
	list *last;

	while(lp->ptr != NULL){
		last=lp;
		lp=lp->ptr;
		
		if(lp->addr == addr){
			last->ptr = lp->ptr;
			return lp;
		}
		
	}

}

