
var sas_tmstp=Math.round(Math.random()*10000000000);sas_masterflag=1;
function SmartAdServer(sas_pageid,sas_formatid,sas_target) {
	 if (sas_masterflag==1) {
	 	sas_masterflag=0;sas_master='M';
	 } else {
	 	sas_master='S';
	 };

	 document.write('<scr'+'ipt src="http://www5.smartadserver.com/call/pubj/' + sas_pageid + '/' + sas_formatid + '/' + sas_master + '/' + sas_tmstp + '/' + escape(sas_target) + '?"></scr'+'ipt>');
}