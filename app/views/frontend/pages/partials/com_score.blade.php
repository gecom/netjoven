<?php 
	$name_com_score = Helpers::getNameComScore();
?>

<!-- Begin comScore Inline Tag 1.1111.15 -->
<script type="text/javascript">
// <![CDATA[
function udm_(a){var b="comScore=",c=document,d=c.cookie,e="",f="indexOf",g="substring",h="length",i=2048,j,k="&ns_",l="&",m,n,o,p,q=window,r=q.encodeURIComponent||escape;if(d[f](b)+1)for(o=0,n=d.split(";"),p=n[h];o<p;o++)m=n[o][f](b),m+1&&(e=l+unescape(n[o][g](m+b[h])));a+=k+"_t="+ +(new Date)+k+"c="+(c.characterSet||c.defaultCharset||"")+"&c8="+r(c.title)+e+"&c7="+r(c.URL)+"&c9="+r(c.referrer),a[h]>i&&a[f](l)>0&&(j=a[g](0,i-8).lastIndexOf(l),a=(a[g](0,j)+k+"cut="+r(a[g](j+1)))[g](0,i)),c.images?(m=new Image,q.ns_p||(ns_p=m),m.src=a):c.write("<","p","><",'img src="',a,'" height="1" width="1" alt="*"',"><","/p",">")}
var crt = {w:(window.top || window),n:'[nocert]',t:780000};
if (!(crt.w.name.indexOf(crt.n)>=0)) udm_('http'+(document.location.href.charAt(4)=='s'?'s://sb':'://b')+'.scorecardresearch.com/b?c1=2&c2=6906625&ns_site=netjoven&name={{$name_com_score}}');
// ]]>
</script>
<noscript><p><img src="http://b.scorecardresearch.com/p?c1=2&amp;c2=6906625&amp;ns_site=netjoven&amp;name={{$name_com_score}}" height="1" width="1" alt="*"></p></noscript>
<!-- End comScore Inline Tag -->