{include file="common/head.tpl" title=$this->myTitle onload="document.form1.login.focus();"}

<div class="contentinside">
<h3>Login</h3>
<center>

{form_ctrl name="form1" action="login" id="form1" model=$this data=$this->myData method="post" validate="true"}
<table width="500px" border="0" cellpadding="0" cellspacing="0">
{if isset($error)}
<tr>
	<td colspan="2">
	<p class="r_error">{$error}</p>
	</td>
</tr>
{/if}

{foreach from=$this->myColumns item=col}
{if $col->myIsVisible}
<tr>
	<td class="r_td r_td_left">{$col->myDescription}</td>
	<td class="r_td">{$col->getInput($this->myData)}</td>
</tr>
{else}
	{eval var=$col->getInput($this->myData)}
{/if}
{/foreach}

<tr>
	<td align="center"colspan="2">
		<input name="action" type="hidden" id="send" value="login" />
		<input name="Submit" type="submit" class="button" value="Login" />
	</td>
</tr>
</table>
</form>
</center>
</div>

{include file="common/foot.tpl"}
