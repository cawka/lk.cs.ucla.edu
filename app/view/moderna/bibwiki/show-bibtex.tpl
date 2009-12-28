{if !isset($smarty.request.ajax)}
<html>
<title>[bibtex] {$this->myData.title} by {$this->myData.author}</title>
{/if}
<pre>
{$this->myData.entry|replace:"{id,":"{`$this->myData.id`,"}
</pre>
{if !isset($smarty.request.ajax)}
</html>
{/if}

