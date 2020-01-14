#!/bin/bash

for FILE in $(find . -type f -name "*.php" | sort)
do
    TEST=${FILE##*/}
    SNIFF=$(basename ${FILE%/*})
    EXPECT=${FILE/.php/.expect}
    ACTUAL="./actual"
    ../vendor/bin/phpcs -s -q --no-colors --standard=../Ork/ruleset.xml --sniffs=${SNIFF} ${FILE} | tail -n +3 | head -n -3 > ${ACTUAL}
    if [ -s ${EXPECT} ]
    then
        if  cmp -s ${EXPECT} ${ACTUAL}
        then
            echo "PASS: ${SNIFF} ${TEST}"
        else
            echo -e "FAIL: ${SNIFF} ${TEST}\n"
            diff -u ${EXPECT} ${ACTUAL}
            echo
            exit
        fi
    else
        if [ -s ${ACTUAL} ]
        then
            echo -e "FAIL: ${SNIFF} ${TEST}\n"
            cat ${ACTUAL}
            echo
        else
            echo "PASS: ${SNIFF} ${TEST}"
        fi
    fi
done

rm ${ACTUAL}
