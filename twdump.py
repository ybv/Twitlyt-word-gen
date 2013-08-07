import numpy as np
import sys
import decimal
import matplotlib.pyplot as plt
import pylab
import random
from twitter import *

def main():
	
	#t = Twitter(auth=OAuth(TwitlytApp,mongodb,l8xLeJn1qFKX2g5v2bRbA,3Htb9jsBnVdBrt1iymC2ABKeaJfljcn4L06L5hlxKs))

	t = Twitter(
            auth=OAuth("75498346-3KjmHnDgVmVeMT123n09WjmiI7xfZyJNx3kLDdo3Y","0okqBrKMvV2qEv1cmZLN0MvwZFXwkGCwKHB3wzclQ",
                       "l8xLeJn1qFKX2g5v2bRbA","3Htb9jsBnVdBrt1iymC2ABKeaJfljcn4L06L5hlxKs")
           )
	x =t.search.tweets(q="#pycon")

	print x

if __name__ == '__main__':
    main()