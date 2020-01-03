#!/bin/bash

service mysql status | grep 'active (running)' > /dev/null 2>&1

if [ $? != 0 ]
then
        sudo service mysql restart > /dev/null
fi

service nginx status | grep 'active (running)' > /dev/null 2>&1

if [ $? != 0 ]
then
        sudo service nginx restart > /dev/null
fi

service php7.2-fpm status | grep 'active (running)' > /dev/null 2>&1

if [ $? != 0 ]
then
        sudo service php7.2-fpm restart > /dev/null
fi