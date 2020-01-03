#!/bin/bash
if [ -n $1 ]
then
	rm -rvf $1 > /dev/null 2>&1
fi