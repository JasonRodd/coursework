#include "tree.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

tree *findParent(tree *, char *);
tree *findNode(tree *, char *);
tree *findSmallest(tree *);

void Insert(char *P){
	
	tree *newNode;
	newNode = (tree *)malloc(sizeof(tree));
	strcpy(newNode->word, P);
	
	if(root == NULL){
		root = newNode;
	} else {
		tree *Parent = findParent(root, P);
		if(Parent != NULL){
			//printf("Parent = %s\n", Parent->word);
			if(strcmp(P, Parent->word) < 0){
				Parent->b4 = newNode;
			} else if(strcmp(P, Parent->word) > 0){
				Parent->after = newNode;
			}
		} else {
			//duplicate
		}
		
	}
	
	
}

tree *findParent(tree *node, char *P){
	if(strcmp(P, node->word) < 0){
		// P < word
		//printf("%s is less then %s\n", P, node->word);
		if(node->b4 == NULL){
			return node;
		} else {
			return findParent(node->b4, P);
		}
		
	} else if(strcmp(P, node->word) > 0) {
		// P > word
		//printf("%s is More then %s\n", P, node->word);
		if(node->after == NULL){
			return node;
		} else {
			return findParent(node->after, P);
		}
		
	} else {
		// Duplicate
		return NULL;
	}
}


void Delete(char *P){
	tree *node = root;
	tree *last;
	int v;
	int whichChild = 0; // 2 == left child   :    3 == right child   default is 0 for case of deleting root
	
	tree* nodeInTree = findNode(root,P); // check if in tree
	if(nodeInTree != NULL){
		
		while( (v = strcmp(P, node->word)) != 0){
			last = node;
			if(v < 0){
				node = node->b4;
				whichChild = 2;
			} else if(v > 0){
				node = node->after;
				whichChild = 3;
			}
		}
		

		
		if(node->b4 == NULL && node->after == NULL){
			// no children
			//printf("no children\n");
			if(whichChild == 2){
				last->b4 = NULL;
			} else if(whichChild == 3){
				last->after = NULL;
			}
			
		} else if( (node->b4 == NULL && node->after != NULL) || (node->b4 != NULL && node->after == NULL) ){
			// one child
			//printf("one child\n");
			if(node->b4 != NULL){
				if(whichChild == 2){
					last->b4 = node->b4;
				} else if(whichChild == 3){
					last->after = node->b4;
				}
			} else {
				if(whichChild == 2){
					last->b4 = node->after;
				} else if(whichChild == 3){
					last->after = node->after;
				}			
			}
			
		} else if( node->b4 != NULL && node->after != NULL ){
			// two child
			//printf("two children\n");
			tree *smallest = findSmallest(node->after);
			
			Delete(smallest->word);
			
			if(whichChild == 2){
				last->b4 = smallest;
				smallest->b4 = node->b4;
				smallest->after = node->after;	
			} else if(whichChild == 3){
				last->after = smallest;
				smallest->b4 = node->b4;
				smallest->after = node->after;	
			} else {
				tree *temp = root->b4;
				root = smallest;
				root->b4 = temp;
				root->after = node->after;
			}
			
		}

	}
	
}

tree *findSmallest(tree *node){
	tree *small;
	small = node;
	
	if(node->b4!=NULL)
		small = findSmallest(node->b4);
	
	
	return small;
}

tree *findNode(tree *node, char *P){
	if(strcmp(P, node->word) < 0){
		if(node->b4 == NULL){
			// Not in Tree
			return NULL;
		} else {
			return findNode(node->b4, P);
		}
	} else if(strcmp(P, node->word) > 0){
		if(node->after == NULL){
			// Not in Tree
			return NULL;
		} else {
			return findNode(node->after, P);
		}
	} else {
		return node;
	}
	
}