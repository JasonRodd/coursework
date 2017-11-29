#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#define MAIN 1
#include "tree.h"
void printtree();
tree *root=NULL;

main(int argc, char **argv)
{
	tree *node;
	char buf[MAXWORD];
	extern tree *root;
	tree *p;

	while((scanf("%s",buf))>0)
		Insert(buf);
	while(argc-->1)
		Delete(argv[argc]);

	
	printf("Print binary tree in order\n");
	printtree(root);
}

void printtree(tree *root){

	if(root->b4!=NULL)
		printtree(root->b4);
	printf("Node is %s \n",root->word);
	if (root->after!=NULL)
		printtree(root->after);
}
		
