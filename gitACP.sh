#!/bin/bash

: '
if [ $# -ne 1 ] || [[ ! " "$1" " == *" "'$1'" "* ]]
    then
        echo ERROR, need comment
        exit 1
    else
'
        git add .

        # git commit -m $1

        # git push origin master
        
        echo "FILE(s) PUSHED"
