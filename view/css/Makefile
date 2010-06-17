SOURCES := $(wildcard *.css)

YUM := java -jar ../../../CMS/lib/yuicompressor.jar --line-break 120

all: 
	if [ -f ../../www/css/site.css ]; then  rm ../../www/css/site.css; fi
	for i in `ls *.css | sort`; do $(YUM) $$i >> ../../www/css/site.css; done

