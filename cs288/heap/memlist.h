typedef struct list list;

struct list{
	list *ptr;
	char *addr;
	int sizeOf;
};

char *mymalloc(int size, char fill);
void myfree(char *ptr);
void myinit(char *mem, int size);
list *append(list *lp, list *newp);
list *delete(list *lp, char *addr);