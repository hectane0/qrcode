#!/bin/bash

text=$1
fill=$2
background=$3

args=" -t $text -f $fill -b $background"

if [[ $# -eq 4 ]] ; then
    args="$args -i $4"
fi

app="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )/../"
pythonEnv="${app}env/python/"
source ${pythonEnv}"bin/activate"
${pythonEnv}bin/python ${app}scripts/qr-generate.py ${args}