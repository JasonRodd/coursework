//Jason Rodd cs435 6631 mp

#include <iostream>
#include <fstream>
#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <bitset>

using namespace std;

typedef unsigned char byte;


struct data {
	int phi;
	byte b;
};

struct TreeNode {
	data d;
	TreeNode *left;
	TreeNode *right;
};

struct ByteFrequency {
	data d;
	bool end;
	ByteFrequency *left;
	ByteFrequency *right;
};

struct PreFixes {
	string s;
	byte b;
};


long fileSize(ifstream *input);
char* setBuffer(long size, ifstream *input);

void BuildMinHeap(ByteFrequency *frequencies, int heapSize);
void HeapifyDown(ByteFrequency *frequencies, int i, int heapSize);
ByteFrequency ExtractMin(ByteFrequency *frequencies, int &heapSize);
ByteFrequency Insert(ByteFrequency newFreq, ByteFrequency *frequencies, int &heapSize);
ByteFrequency BuildPreFixTree(ByteFrequency *frequencies,int &heapSize);
void WriteFile(string binString, ByteFrequency root, string name);

int main(int argc, char *argv[]) {
	if(argc == 1){
		cout << argv[0] << endl;
	} else if (argc == 2){
		ByteFrequency *frequencies;
		ifstream *infile;
		char *buffer;
		long size;
		int heapSize = 256;
		frequencies = new ByteFrequency[256];
		
		
		fstream bin_in(argv[1],std::ios_base::binary|std::ios_base::in);	
		for(int i = 0; i < 256; i++){		
			int value;
			bin_in.read((char*)&value,sizeof(int));
			data d = {value, (byte) i};
			frequencies[i].d = d;
			frequencies[i].end = true;
			frequencies[i].left = NULL;
			frequencies[i].right = NULL;
			//cout << i << " : " << (char) i << " : " << value << endl;
		}
		bin_in.close();
		
		ifstream input(argv[1], ios::in|ios::binary|ios::ate);	
		infile = &input;
		
		size = fileSize(infile);
		buffer = setBuffer(size, infile);
		
		BuildMinHeap(frequencies,heapSize);
		ByteFrequency root = BuildPreFixTree(frequencies, heapSize);
		
		
		string binString = "";
		for(int i = 0; i < size; i++){
			bitset<8> bin (buffer[i]);
			binString += bin.to_string();
		}
		
		
		while(binString.length() % 8 != 0){
			binString += '0';
		}
		
		binString = binString.substr(8192,binString.length() - 8192);
		//cout << binString.length() / 8 << endl;
		
		WriteFile(binString,root,argv[1]);
		
		delete[] buffer;
	} else{
		cout << "to many arguments" << endl;
	}
	
	return 0;
}

void WriteFile(string binString, ByteFrequency root, string name){
	int divider = 0;
	for(int i = name.length() - 1; i >= 0; i--){
		string c = name.substr(i,1);
		if(c == "."){
			divider = i;
			break;
		}
	}
	
	string FormatedName = name.substr(0,divider);
	
	ofstream OutFile;
	OutFile.open(FormatedName.c_str(), ios::out | ios::binary);
	ByteFrequency at = root;
	//cout << endl << "----" << endl;
	string s = "";
	for(int i = 0; i < binString.length() - 1; i++){
			//cout << binString.substr(i,1)<< " : ";
			if(binString.substr(i,1) == "0"){
				at = *at.left;
				//cout << "left" << " : ";
				if(at.end){
					//printf("   -   %x \n", at.d.b);
					s += (char) at.d.b;
					OutFile.write((char*)&at.d.b, sizeof(at.d.b));
					at = root;
				}
			} else{
				at = *at.right;
				//cout << "right" << " : ";
				if(at.end){
					//printf("   -   %x \n", at.d.b);
					s += (char) at.d.b;
					OutFile.write((char*)&at.d.b, sizeof(at.d.b));
					at = root;
				}
			}
		
	}
	OutFile.close();
	remove(name.c_str());
}

char* setBuffer(long size, ifstream *input){
	char * buffer;
	buffer = new char[size];
	input->read (buffer, size);
	input->close();
	return buffer;
}


long fileSize(ifstream *input){
	long size;
	size = input->tellg();
	input->seekg (0, ios::beg);
	return size;
}

void BuildMinHeap(ByteFrequency *frequencies, int heapSize){
	int c = 1;
	for(int i = ((heapSize/2)-1); i >= 0; i--){
		//cout << c << " : " << i << endl;
		c++;
		HeapifyDown(frequencies, i, heapSize);
	}
	
}

void HeapifyDown(ByteFrequency *frequencies, int i, int heapSize){
	int left = (2*i)+1;
	int right = (2*i)+2;
	int smallest = i;
	
	if (left < heapSize && frequencies[left].d.phi < frequencies[i].d.phi){
		smallest = left;
	}
	if(right < heapSize && frequencies[right].d.phi < frequencies[smallest].d.phi){
		smallest = right;
	}
	if(smallest != i){
		ByteFrequency temp = frequencies[i];
		frequencies[i] = frequencies[smallest];
		frequencies[smallest] = temp;
		HeapifyDown(frequencies, smallest, heapSize);
	}
	

}


ByteFrequency ExtractMin(ByteFrequency *frequencies, int &heapSize){
	ByteFrequency f = frequencies[0];
	frequencies[0] = frequencies[heapSize-1];
	HeapifyDown(frequencies, 0, heapSize);
	heapSize--;
	return f;
}

ByteFrequency Insert(ByteFrequency newFreq, ByteFrequency *frequencies, int &heapSize){
	heapSize++;
	frequencies[heapSize-1] = newFreq;
	//printf("--%d--\n", frequencies[heapSize-1].d.phi);
	
	int i = heapSize - 1;
	while(frequencies[(int)floor(i/2)].d.phi > frequencies[i].d.phi){
		//printf("%d is less then %d\n", frequencies[i].d.phi, frequencies[(int)floor(i/2)].d.phi);
		ByteFrequency temp = frequencies[(int)floor(i/2)];
		frequencies[(int)floor(i/2)] = frequencies[i] ;
		frequencies[i] = temp;
		i = (int)floor(i/2);
	}

}

ByteFrequency BuildPreFixTree(ByteFrequency *frequencies,int &heapSize){
	
	while(heapSize > 1){
		ByteFrequency smallest = ExtractMin(frequencies, heapSize);
		ByteFrequency secondSmallest = ExtractMin(frequencies, heapSize);
		
		ByteFrequency combined;
		combined.d.phi = smallest.d.phi + secondSmallest.d.phi;
		combined.d.b = 0;
		combined.end = false;
		
		ByteFrequency *L = new ByteFrequency;
		ByteFrequency *R = new ByteFrequency;
		
		*L = smallest;
		*R = secondSmallest;
		
		combined.left = L;
		combined.right = R;
		
		//printf("%x %d %d  -- %x %d %d  -- %x %d %d \n",smallest.d.b, smallest.d.phi, smallest.end, secondSmallest.d.b, secondSmallest.d.phi, secondSmallest.end,  combined.d.b, combined.d.phi, combined.end);
		
		Insert(combined,frequencies,heapSize);
		
	}

	
	ByteFrequency last = ExtractMin(frequencies, heapSize);
	
	
	return last;
	
}


