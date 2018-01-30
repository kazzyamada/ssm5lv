#!/bin/sh

cat < /dev/null > tests/result.log
./vendor/bin/phpunit | grep -v ^Time >> tests/result.log

diff tests/result.req tests/result.log
RC=$?
if [ $RC = 0 ]; then
    echo === ALL OF TEST SUCCEED. ===
else
    echo === TEST failed see tests/result.log. ===
fi
