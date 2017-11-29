#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define MAX 100
#define SIZE 5

typedef struct {
        int fill;
		char name[8];
}frame;

typedef struct {
	int top;
	frame *stackPointer;
}Stack;

int grabLine(char L[]);
void Parse(char L[], char C[], char F[]);
Stack StackInit();
void ReverseStack(Stack *s);
void Push(Stack *s,int v);
frame * Pop(
Stack *s);


int main( ) {
	char line[MAX];
	char command[5];
	char fill[10];
	int len;
	
	Stack *mainStack;
	*mainStack = StackInit();
	
	
	while((len = grabLine(line)) > 0){
		Parse(line, command, fill);
		int v = atoi(fill);
		if(!strcmp(command,"PUSH")){
			Push(mainStack,v);
		} else {
			Pop(mainStack);
		}
	}
  
	ReverseStack(mainStack);

   return 0;
}

int grabLine(char L[]){
	int c = 0;
	int i = 0;
	
	for(i=0; i<MAX-1 && (c=getchar()) != EOF && c != '\n'; i++){
		L[i] = c;
	}
	L[i] = '\0';
	return i;
}

void Parse(char L[], char C[], char F[]){
	
	int i = 0;
	int j = 0;
	
	while(L[i] != '\t' &&  (i < 4)){
		C[i] = L[i];
		i++;
	}
	
	C[i] = '\0';
	i++;
	
	
	while(L[i] != '\0'){
		F[j] = L[i];
		i++;
		j++;
	}
	
	F[j] = '\0';
	
}

Stack StackInit(){
	Stack s;
	s.top = 0;
	s.stackPointer=(frame *)malloc(SIZE*sizeof(frame));
	return s;
}

void ReverseStack(Stack *s){
	Stack *reversed;
	*reversed = StackInit();
	
	while(s->top > 0){
		frame *f;
		f = Pop(s);
		Push(reversed,f->fill);
	}
	
	while(reversed->top > 0){
		frame *f;
		f = Pop(reversed);
		printf("%d\n", f->fill);
	}
	
}

void Push(Stack *s,int v){
	if(s->top < SIZE){
		s->stackPointer->fill = v;
		s->stackPointer++;
		s->top++;
	} else {
		printf("Stack is full, maybe one day this program will allocate more memory.. probably not though.");
	}
}

frame * Pop(Stack *s){
	if(s->top > 0){
		s->stackPointer--;
		s->top--;
		return s->stackPointer;
	} else {
		printf("Cant pop off the Bottom");
		return s->stackPointer;
	}
}


