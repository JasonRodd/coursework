typedef struct tree tree;

#define MAXWORD 26

struct tree{
	struct tree *b4;
	struct tree *after;
	char word[MAXWORD];
};

void Insert(char *);
void Delete(char *);

#ifndef MAIN
extern tree *root;
#endif
