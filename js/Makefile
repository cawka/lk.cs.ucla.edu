JS := $(wildcard *.js)
JSC := $(JS:.js=.js-c)

YUM := java -jar ../../CMS/lib/yuicompressor.jar --line-break 120
#YUM := cat

all: $(JSC)
	if [ -f ../www/js/site.js ]; then  rm ../www/js/site.js; fi
	for i in `ls *.js-c | sort`; do cat $$i >> ../www/js/site.js; done

%.js-c: %.js
	$(YUM) $< > $@

clean:
	rm *.js-c
