{*<form action="/index.php" method="get" id="mw-history-searchform">
<fieldset id="mw-history-search">
<legend>Browse history</legend>
<input name="title" type="hidden" value="Main_Page" />
<input name="action" type="hidden" value="history" />
<label for="year">From year (and earlier):</label> <input name="year" size="4" value="" id="year" maxlength="4" /> <label for="month">From month (and earlier):</label> <select id="month" name="month" class="mw-month-selector"><option value="-1">all</option>

<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>

<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option></select>&nbsp;<input type="submit" value="Go" />
</fieldset></form>
*}

{*(Latest | Earliest) View (newer 50) (older 50) (<a href="/index.php?title=Main_Page&amp;limit=20&amp;action=history" title="Main Page" class="mw-numlink">20</a> | <a href="/index.php?title=Main_Page&amp;limit=50&amp;action=history" title="Main Page" class="mw-numlink">50</a> | <a href="/index.php?title=Main_Page&amp;limit=100&amp;action=history" title="Main Page" class="mw-numlink">100</a> | <a href="/index.php?title=Main_Page&amp;limit=250&amp;action=history" title="Main Page" class="mw-numlink">250</a> | <a href="/index.php?title=Main_Page&amp;limit=500&amp;action=history" title="Main Page" class="mw-numlink">500</a>)*}
{if $this->getPageOffsetCtrl()!=""}<h3><span class="pagesblockinside">{$this->getPageOffsetCtrl()}</span></h3>{/if}

<p>Diff selection: mark the radio boxes of the versions to compare and hit enter or the button at the bottom.<br />

Legend: (cur) = difference with current version,
(last) = difference with preceding version{*, M = minor edit*}.
</p>

<form action="/index.php" id="mw-history-compare">
<input name="title" type="hidden" value="Main_Page" />
<input type="submit" value="Compare selected versions" class="historysubmit" accesskey="v" title="See the differences between the two selected versions of this page." />

<ul id="pagehistory">
<li>(cur) 
{*(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=154" title="Main Page">last</a>) *}
<input type="radio" value="167" style="visibility:hidden" name="oldid" /><input type="radio" value="167" checked="checked" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=167" title="Main Page">22:10, 12 January 2009</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(469 bytes)</span> (<span class="mw-rollback-link"><a href="/index.php?title=Main_Page&amp;action=rollback&amp;from=Cawka&amp;token=534e239c976234e6f1ef8ae4fbc2f44d%2B%5C" title="&quot;Rollback&quot; reverts edit(s) to this page of the last contributor in one click.">rollback</a></span> | <span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=154&amp;undo=167" title="&quot;Undo&quot; reverts this edit and opens the edit form in preview mode.&#10;Allows adding a reason in the summary.">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=154" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=154&amp;oldid=144" title="Main Page">last</a>) <input type="radio" value="154" checked="checked" name="oldid" /><input type="radio" value="154" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=154" title="Main Page">01:38, 7 January 2009</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(422 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=144&amp;undo=154" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=144" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=144&amp;oldid=143" title="Main Page">last</a>) <input type="radio" value="144" name="oldid" /><input type="radio" value="144" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=144" title="Main Page">01:34, 6 January 2009</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(389 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=143&amp;undo=144" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=143" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=143&amp;oldid=123" title="Main Page">last</a>) <input type="radio" value="143" name="oldid" /><input type="radio" value="143" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=143" title="Main Page">01:34, 6 January 2009</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(403 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=123&amp;undo=143" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=123" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=123&amp;oldid=121" title="Main Page">last</a>) <input type="radio" value="123" name="oldid" /><input type="radio" value="123" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=123" title="Main Page">22:41, 5 January 2009</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(389 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=121&amp;undo=123" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=121" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=121&amp;oldid=120" title="Main Page">last</a>) <input type="radio" value="121" name="oldid" /><input type="radio" value="121" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=121" title="Main Page">22:14, 5 January 2009</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(343 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=120&amp;undo=121" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=120" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=120&amp;oldid=85" title="Main Page">last</a>) <input type="radio" value="120" name="oldid" /><input type="radio" value="120" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=120" title="Main Page">22:13, 5 January 2009</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(344 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=85&amp;undo=120" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=85" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=85&amp;oldid=78" title="Main Page">last</a>) <input type="radio" value="85" name="oldid" /><input type="radio" value="85" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=85" title="Main Page">00:25, 20 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(243 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=78&amp;undo=85" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=78" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=78&amp;oldid=76" title="Main Page">last</a>) <input type="radio" value="78" name="oldid" /><input type="radio" value="78" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=78" title="Main Page">20:58, 19 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Cawka&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Cawka (not yet written)">Cawka</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Cawka&amp;action=edit&amp;redlink=1" class="new" title="User talk:Cawka (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Cawka" title="Special:Contributions/Cawka">contribs</a> | <a href="/index.php/Special:Block/Cawka" title="Special:Block/Cawka">block</a>)</span></span> <span class="history-size">(345 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=76&amp;undo=78" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=76" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=76&amp;oldid=74" title="Main Page">last</a>) <input type="radio" value="76" name="oldid" /><input type="radio" value="76" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=76" title="Main Page">09:24, 19 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(319 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=74&amp;undo=76" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=74" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=74&amp;oldid=72" title="Main Page">last</a>) <input type="radio" value="74" name="oldid" /><input type="radio" value="74" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=74" title="Main Page">09:22, 19 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(199 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=72&amp;undo=74" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=72" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=72&amp;oldid=53" title="Main Page">last</a>) <input type="radio" value="72" name="oldid" /><input type="radio" value="72" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=72" title="Main Page">09:19, 19 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(16 bytes)</span> <span class="comment">(Replacing page with &#39;<a href="/index.php/TCP_Variants" title="TCP Variants">TCP Variants</a>&#39;)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=53&amp;undo=72" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=53" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=53&amp;oldid=52" title="Main Page">last</a>) <input type="radio" value="53" name="oldid" /><input type="radio" value="53" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=53" title="Main Page">01:26, 18 December 2008</a> <span class='history-user'><a href="/index.php/Special:Contributions/131.179.33.63" title="Special:Contributions/131.179.33.63" class="mw-userlink">131.179.33.63</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:131.179.33.63&amp;action=edit&amp;redlink=1" class="new" title="User talk:131.179.33.63 (not yet written)">Talk</a> | <a href="/index.php/Special:Block/131.179.33.63" title="Special:Block/131.179.33.63">block</a>)</span></span> <span class="history-size">(792 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=52&amp;undo=53" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=52" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=52&amp;oldid=28" title="Main Page">last</a>) <input type="radio" value="52" name="oldid" /><input type="radio" value="52" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=52" title="Main Page">01:26, 18 December 2008</a> <span class='history-user'><a href="/index.php/Special:Contributions/131.179.33.63" title="Special:Contributions/131.179.33.63" class="mw-userlink">131.179.33.63</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:131.179.33.63&amp;action=edit&amp;redlink=1" class="new" title="User talk:131.179.33.63 (not yet written)">Talk</a> | <a href="/index.php/Special:Block/131.179.33.63" title="Special:Block/131.179.33.63">block</a>)</span></span> <span class="history-size">(789 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=28&amp;undo=52" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=28" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=28&amp;oldid=27" title="Main Page">last</a>) <input type="radio" value="28" name="oldid" /><input type="radio" value="28" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=28" title="Main Page">01:43, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(733 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=27&amp;undo=28" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=27" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=27&amp;oldid=26" title="Main Page">last</a>) <input type="radio" value="27" name="oldid" /><input type="radio" value="27" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=27" title="Main Page">01:43, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(705 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=26&amp;undo=27" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=26" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=26&amp;oldid=25" title="Main Page">last</a>) <input type="radio" value="26" name="oldid" /><input type="radio" value="26" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=26" title="Main Page">01:43, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(703 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=25&amp;undo=26" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=25" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=25&amp;oldid=15" title="Main Page">last</a>) <input type="radio" value="25" name="oldid" /><input type="radio" value="25" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=25" title="Main Page">01:36, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(701 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=15&amp;undo=25" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=15" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=15&amp;oldid=14" title="Main Page">last</a>) <input type="radio" value="15" name="oldid" /><input type="radio" value="15" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=15" title="Main Page">00:34, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(58 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=14&amp;undo=15" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=14" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=14&amp;oldid=13" title="Main Page">last</a>) <input type="radio" value="14" name="oldid" /><input type="radio" value="14" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=14" title="Main Page">00:03, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(72 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=13&amp;undo=14" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=13" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=13&amp;oldid=12" title="Main Page">last</a>) <input type="radio" value="13" name="oldid" /><input type="radio" value="13" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=13" title="Main Page">00:00, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(71 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=12&amp;undo=13" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=12" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=12&amp;oldid=11" title="Main Page">last</a>) <input type="radio" value="12" name="oldid" /><input type="radio" value="12" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=12" title="Main Page">00:00, 17 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(54 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=11&amp;undo=12" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=11" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=11&amp;oldid=10" title="Main Page">last</a>) <input type="radio" value="11" name="oldid" /><input type="radio" value="11" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=11" title="Main Page">23:58, 16 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(48 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=10&amp;undo=11" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=10" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=10&amp;oldid=9" title="Main Page">last</a>) <input type="radio" value="10" name="oldid" /><input type="radio" value="10" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=10" title="Main Page">23:57, 16 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(87 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=9&amp;undo=10" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=9" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=9&amp;oldid=8" title="Main Page">last</a>) <input type="radio" value="9" name="oldid" /><input type="radio" value="9" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=9" title="Main Page">23:57, 16 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(68 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=8&amp;undo=9" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=8" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=8&amp;oldid=7" title="Main Page">last</a>) <input type="radio" value="8" name="oldid" /><input type="radio" value="8" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=8" title="Main Page">23:55, 16 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(103 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=7&amp;undo=8" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=7" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=7&amp;oldid=6" title="Main Page">last</a>) <input type="radio" value="7" name="oldid" /><input type="radio" value="7" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=7" title="Main Page">23:55, 16 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(62 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=6&amp;undo=7" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=6" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=6&amp;oldid=2" title="Main Page">last</a>) <input type="radio" value="6" name="oldid" /><input type="radio" value="6" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=6" title="Main Page">23:55, 16 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="history-size">(61 bytes)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=2&amp;undo=6" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=2" title="Main Page">cur</a>) (<a href="/index.php?title=Main_Page&amp;diff=2&amp;oldid=1" title="Main Page">last</a>) <input type="radio" value="2" name="oldid" /><input type="radio" value="2" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=2" title="Main Page">00:11, 16 December 2008</a> <span class='history-user'><a href="/index.php?title=User:Root&amp;action=edit&amp;redlink=1" class="new mw-userlink" title="User:Root (not yet written)">Root</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:Root&amp;action=edit&amp;redlink=1" class="new" title="User talk:Root (not yet written)">Talk</a> | <a href="/index.php/Special:Contributions/Root" title="Special:Contributions/Root">contribs</a> | <a href="/index.php/Special:Block/Root" title="Special:Block/Root">block</a>)</span></span> <span class="minor">m</span> <span class="history-size">(25 bytes)</span> <span class="comment">(Replacing page with &#39; == Test ==  <a href="/index.php/New_page" title="New page">New page</a>&#39;)</span> (<span class="mw-history-undo"><a href="/index.php?title=Main_Page&amp;action=edit&amp;undoafter=1&amp;undo=2" title="Main Page">undo</a></span>)</li>

<li>(<a href="/index.php?title=Main_Page&amp;diff=167&amp;oldid=1" title="Main Page">cur</a>) (last) <input type="radio" value="1" name="oldid" /><input type="radio" value="1" name="diff" /> <a href="/index.php?title=Main_Page&amp;oldid=1" title="Main Page">23:57, 15 December 2008</a> <span class='history-user'><a href="/index.php/Special:Contributions/MediaWiki_default" title="Special:Contributions/MediaWiki default" class="mw-userlink">MediaWiki default</a>  <span class="mw-usertoollinks">(<a href="/index.php?title=User_talk:MediaWiki_default&amp;action=edit&amp;redlink=1" class="new" title="User talk:MediaWiki default (not yet written)">Talk</a> | <a href="/index.php/Special:Block/MediaWiki_default" title="Special:Block/MediaWiki default">block</a>)</span></span> <span class="history-size">(449 bytes)</span></li>

</ul><input type="submit" value="Compare selected versions" class="historysubmit" accesskey="v" title="See the differences between the two selected versions of this page." /></form>(Latest | Earliest) View (newer 50) (older 50) (<a href="/index.php?title=Main_Page&amp;limit=20&amp;action=history" title="Main Page" class="mw-numlink">20</a> | <a href="/index.php?title=Main_Page&amp;limit=50&amp;action=history" title="Main Page" class="mw-numlink">50</a> | <a href="/index.php?title=Main_Page&amp;limit=100&amp;action=history" title="Main Page" class="mw-numlink">100</a> | <a href="/index.php?title=Main_Page&amp;limit=250&amp;action=history" title="Main Page" class="mw-numlink">250</a> | <a href="/index.php?title=Main_Page&amp;limit=500&amp;action=history" title="Main Page" class="mw-numlink">500</a>)<div class="printfooter">
Retrieved from "<a href="http://wiki.cawka.mine.nu/index.php/Main_Page">http://wiki.cawka.mine.nu/index.php/Main_Page</a>"</div>
