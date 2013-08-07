import numpy as np
import sys
import decimal
import matplotlib.pyplot as plt
import pylab
import random

def main():
	words=[]
	filer=open('500.txt')
	for line in filer:
		a=str(line)
		temp=[]
		temp.append(a.split("="))
		words.append(temp[0][0])
	#print words
	filew = open('dump.txt', 'r+b')
	for w in words:
		filew.write(str(w))
		filew.write(str(","))

if __name__ == '__main__':
    main()

